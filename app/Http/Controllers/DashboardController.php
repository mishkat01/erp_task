<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseRequisition;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function employee(Request $request): View
    {
        $employeeId = $request->user()->id;

        $stats = [
            'total' => PurchaseRequisition::where('employee_id', $employeeId)->count(),
            'pending' => PurchaseRequisition::where('employee_id', $employeeId)->where('status', PurchaseRequisition::STATUS_PENDING)->count(),
            'approved' => PurchaseRequisition::where('employee_id', $employeeId)->where('status', PurchaseRequisition::STATUS_APPROVED)->count(),
            'rejected' => PurchaseRequisition::where('employee_id', $employeeId)->where('status', PurchaseRequisition::STATUS_REJECTED)->count(),
        ];

        return view('dashboard', compact('stats'));
    }

    public function procurement(): View
    {
        $stats = [
            'products' => Product::count(),
            'suppliers' => Supplier::count(),
            'pending_pr' => PurchaseRequisition::where('status', PurchaseRequisition::STATUS_PENDING)->count(),
            'approved_pr' => PurchaseRequisition::where('status', PurchaseRequisition::STATUS_APPROVED)->count(),
        ];

        return view('procurement-dashboard', compact('stats'));
    }

    public function manager(): View
    {
        $stats = [
            'pending' => PurchaseRequisition::where('status', PurchaseRequisition::STATUS_PENDING)->count(),
            'approved' => PurchaseRequisition::where('status', PurchaseRequisition::STATUS_APPROVED)->count(),
            'rejected' => PurchaseRequisition::where('status', PurchaseRequisition::STATUS_REJECTED)->count(),
        ];

        return view('manager-dashboard', compact('stats'));
    }
}
