@php
    $statusColors = ['pending' => 'warning', 'approved' => 'success', 'rejected' => 'danger'];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Requisition') }} {{ $requisition->requisition_no }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="text-muted small">Status</div>
                            <span class="badge bg-{{ $statusColors[$requisition->status] }} fs-6">{{ ucfirst($requisition->status) }}</span>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Employee</div>
                            <div>{{ $requisition->employee?->name ?? '—' }}</div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Department</div>
                            <div>{{ $requisition->department?->name ?? '—' }}</div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Submitted</div>
                            <div>{{ $requisition->created_at->format('Y-m-d H:i') }}</div>
                        </div>
                    </div>

                    @if ($requisition->status !== 'pending')
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="text-muted small">{{ ucfirst($requisition->status) }} By</div>
                                <div>{{ $requisition->approvedBy?->name ?? '—' }}</div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-muted small">{{ ucfirst($requisition->status) }} At</div>
                                <div>{{ $requisition->approved_at?->format('Y-m-d H:i') }}</div>
                            </div>
                            @if ($requisition->status === 'rejected')
                                <div class="col-md-6">
                                    <div class="text-muted small">Rejection Reason</div>
                                    <div>{{ $requisition->rejection_reason }}</div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requisition->items as $item)
                                <tr>
                                    <td>{{ $item->product?->name }}</td>
                                    <td>{{ $item->product?->sku }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->remarks ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex gap-2">
                        <a href="{{ route('requisitions.index') }}" class="btn btn-secondary">Back to List</a>

                        @if (Auth::user()->role === 'employee' && $requisition->employee_id === Auth::id() && $requisition->isPending())
                            <a href="{{ route('requisitions.edit', $requisition) }}" class="btn btn-primary">Edit</a>
                        @endif

                        @if (Auth::user()->role === 'manager' && $requisition->isPending())
                            <form action="{{ route('requisitions.approve', $requisition) }}" method="POST" onsubmit="return confirm('Approve this requisition?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
                        @endif

                        @if (Auth::user()->role === 'procurement' && $requisition->status === 'approved' && ! $requisition->purchaseOrder)
                            <a href="{{ route('purchase-orders.create') }}" class="btn btn-outline-success">Create Purchase Order</a>
                        @endif
                    </div>
                </div>
            </div>

            @if ($requisition->purchaseOrder)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Linked Purchase Order</h5>
                        <p class="mb-2">
                            <strong>{{ $requisition->purchaseOrder->po_no }}</strong>
                            — Supplier: {{ $requisition->purchaseOrder->supplier?->name }}
                            — Order Date: {{ $requisition->purchaseOrder->order_date->format('Y-m-d') }}
                        </p>
                        <a href="{{ route('purchase-orders.show', $requisition->purchaseOrder) }}" class="btn btn-sm btn-outline-primary">View Purchase Order</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (Auth::user()->role === 'manager' && $requisition->isPending())
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('requisitions.reject', $requisition) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <h5 class="modal-title">Reject {{ $requisition->requisition_no }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="rejection_reason" class="form-label">Reason for rejection</label>
                            <textarea id="rejection_reason" name="rejection_reason" class="form-control" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Reject Requisition</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
