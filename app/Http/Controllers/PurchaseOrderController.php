<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseOrderRequest;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequisition;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseOrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = PurchaseOrder::query()
            ->with(['requisition', 'supplier'])
            ->when($request->filled('q'), function ($q) use ($request) {
                $search = $request->q;
                $q->where('po_no', 'like', "%{$search}%")
                    ->orWhereHas('supplier', fn ($sq) => $sq->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('requisition', fn ($rq) => $rq->where('requisition_no', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('purchase-orders.index', compact('orders'));
    }

    public function create(): View
    {
        $eligibleRequisitions = PurchaseRequisition::query()
            ->where('status', PurchaseRequisition::STATUS_APPROVED)
            ->whereDoesntHave('purchaseOrder')
            ->with('employee')
            ->get();

        $suppliers = Supplier::orderBy('name')->get();

        return view('purchase-orders.create', compact('eligibleRequisitions', 'suppliers'));
    }

    public function store(StorePurchaseOrderRequest $request): RedirectResponse
    {
        $order = DB::transaction(function () use ($request) {
            $order = PurchaseOrder::create([
                'requisition_id' => $request->validated('requisition_id'),
                'supplier_id' => $request->validated('supplier_id'),
                'order_date' => $request->validated('order_date'),
                'created_by' => $request->user()->id,
            ]);

            $order->update([
                'po_no' => 'PO-'.str_pad($order->id, 5, '0', STR_PAD_LEFT),
            ]);

            return $order;
        });

        return redirect()->route('purchase-orders.show', $order)->with('success', 'Purchase order created successfully.');
    }

    public function show(PurchaseOrder $purchaseOrder): View
    {
        $purchaseOrder->load(['requisition.items.product', 'requisition.employee', 'requisition.department', 'supplier', 'createdBy']);

        return view('purchase-orders.show', compact('purchaseOrder'));
    }
}
