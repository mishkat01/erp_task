<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Purchase Order') }} {{ $purchaseOrder->po_no }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="text-muted small">Requisition</div>
                            <div>{{ $purchaseOrder->requisition?->requisition_no }}</div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Requested By</div>
                            <div>{{ $purchaseOrder->requisition?->employee?->name }} ({{ $purchaseOrder->requisition?->department?->name }})</div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Supplier</div>
                            <div>{{ $purchaseOrder->supplier?->name }}</div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Order Date</div>
                            <div>{{ $purchaseOrder->order_date->format('Y-m-d') }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="text-muted small">Created By</div>
                            <div>{{ $purchaseOrder->createdBy?->name ?? '—' }}</div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Supplier Phone</div>
                            <div>{{ $purchaseOrder->supplier?->phone }}</div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-muted small">Supplier Email</div>
                            <div>{{ $purchaseOrder->supplier?->email ?? '—' }}</div>
                        </div>
                    </div>

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
                            @foreach ($purchaseOrder->requisition->items as $item)
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
                        <a href="{{ route('purchase-orders.index') }}" class="btn btn-secondary">Back to List</a>
                        <a href="{{ route('requisitions.show', $purchaseOrder->requisition) }}" class="btn btn-outline-primary">View Requisition</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
