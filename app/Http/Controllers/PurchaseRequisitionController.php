<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovePurchaseRequisitionRequest;
use App\Http\Requests\RejectPurchaseRequisitionRequest;
use App\Http\Requests\StorePurchaseRequisitionRequest;
use App\Http\Requests\UpdatePurchaseRequisitionRequest;
use App\Models\Product;
use App\Models\PurchaseRequisition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseRequisitionController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $requisitions = PurchaseRequisition::query()
            ->with(['employee', 'department', 'purchaseOrder'])
            ->when($user->role === 'employee', fn ($q) => $q->where('employee_id', $user->id))
            ->when($request->filled('q'), function ($q) use ($request) {
                $search = $request->q;
                $q->where(function ($q) use ($search) {
                    $q->where('requisition_no', 'like', "%{$search}%")
                        ->orWhereHas('employee', fn ($eq) => $eq->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('department', fn ($dq) => $dq->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('requisitions.index', compact('requisitions'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()->role === 'employee', 403);

        $products = Product::orderBy('name')->get();

        return view('requisitions.create', compact('products'));
    }

    public function store(StorePurchaseRequisitionRequest $request): RedirectResponse
    {
        $requisition = DB::transaction(function () use ($request) {
            $requisition = PurchaseRequisition::create([
                'employee_id' => $request->user()->id,
                'department_id' => $request->user()->department_id,
                'status' => PurchaseRequisition::STATUS_PENDING,
            ]);

            $requisition->update([
                'requisition_no' => 'PR-'.str_pad($requisition->id, 5, '0', STR_PAD_LEFT),
            ]);

            foreach ($request->validated('items') as $item) {
                $requisition->items()->create($item);
            }

            return $requisition;
        });

        return redirect()->route('requisitions.show', $requisition)->with('success', 'Requisition submitted successfully.');
    }

    public function show(Request $request, PurchaseRequisition $requisition): View
    {
        $user = $request->user();

        abort_unless(
            $user->role !== 'employee' || $requisition->employee_id === $user->id,
            403
        );

        $requisition->load(['employee', 'department', 'items.product', 'purchaseOrder.supplier', 'approvedBy']);

        return view('requisitions.show', compact('requisition'));
    }

    public function edit(Request $request, PurchaseRequisition $requisition): View
    {
        abort_unless(
            $requisition->employee_id === $request->user()->id && $requisition->isPending(),
            403
        );

        $requisition->load('items');
        $products = Product::orderBy('name')->get();

        return view('requisitions.edit', compact('requisition', 'products'));
    }

    public function update(UpdatePurchaseRequisitionRequest $request, PurchaseRequisition $requisition): RedirectResponse
    {
        DB::transaction(function () use ($request, $requisition) {
            $requisition->items()->delete();

            foreach ($request->validated('items') as $item) {
                $requisition->items()->create($item);
            }
        });

        return redirect()->route('requisitions.show', $requisition)->with('success', 'Requisition updated successfully.');
    }

    public function destroy(Request $request, PurchaseRequisition $requisition): RedirectResponse
    {
        abort_unless(
            $requisition->employee_id === $request->user()->id && $requisition->isPending(),
            403
        );

        $requisition->delete();

        return redirect()->route('requisitions.index')->with('success', 'Requisition deleted successfully.');
    }

    public function approve(ApprovePurchaseRequisitionRequest $request, PurchaseRequisition $requisition): RedirectResponse
    {
        $requisition->update([
            'status' => PurchaseRequisition::STATUS_APPROVED,
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', "Requisition {$requisition->requisition_no} approved.");
    }

    public function reject(RejectPurchaseRequisitionRequest $request, PurchaseRequisition $requisition): RedirectResponse
    {
        $requisition->update([
            'status' => PurchaseRequisition::STATUS_REJECTED,
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
            'rejection_reason' => $request->validated('rejection_reason'),
        ]);

        return back()->with('success', "Requisition {$requisition->requisition_no} rejected.");
    }
}
