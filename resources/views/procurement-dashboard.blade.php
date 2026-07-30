<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Procurement Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Total Products</div>
                            <div class="display-6">{{ $stats['products'] }}</div>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Manage Products</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Total Suppliers</div>
                            <div class="display-6">{{ $stats['suppliers'] }}</div>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-primary">Manage Suppliers</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Pending PR</div>
                            <div class="display-6 text-warning">{{ $stats['pending_pr'] }}</div>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('requisitions.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning">View</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Approved PR</div>
                            <div class="display-6 text-success">{{ $stats['approved_pr'] }}</div>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('requisitions.index', ['status' => 'approved']) }}" class="btn btn-sm btn-outline-success">View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Quick Actions</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('purchase-orders.create') }}" class="btn btn-primary">New Purchase Order</a>
                                <a href="{{ route('suppliers.create') }}" class="btn btn-success">Add Supplier</a>
                                <a href="{{ route('products.create') }}" class="btn btn-info">Add Product</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Reports</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('requisitions.index') }}" class="btn btn-outline-primary">PR List</a>
                                <a href="{{ route('purchase-orders.index') }}" class="btn btn-outline-primary">PO List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
