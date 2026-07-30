<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Purchase Orders') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" action="{{ route('purchase-orders.index') }}" class="d-flex" role="search">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="PO Number, Supplier, or PR Number" style="min-width: 280px">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </form>
                <a href="{{ route('purchase-orders.create') }}" class="btn btn-primary text-nowrap ms-2">+ Create Purchase Order</a>
            </div>

            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>PO Number</th>
                                <th>Requisition</th>
                                <th>Supplier</th>
                                <th>Order Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->po_no }}</td>
                                    <td>{{ $order->requisition?->requisition_no }}</td>
                                    <td>{{ $order->supplier?->name }}</td>
                                    <td>{{ $order->order_date->format('Y-m-d') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('purchase-orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No purchase orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
