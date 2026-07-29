<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Procurement Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <!-- Card 1: Purchase Orders -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                📦 Purchase Orders
                            </h5>
                            <p class="card-text">
                                <strong>Total Orders:</strong> 45<br>
                                <strong>Pending:</strong> 12<br>
                                <strong>Delivered:</strong> 33
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="#" class="btn btn-sm btn-primary">View Orders</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Suppliers -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                🏢 Suppliers
                            </h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Active Suppliers</span>
                                    <span class="badge bg-primary">18</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>New Requests</span>
                                    <span class="badge bg-warning">5</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Verified</span>
                                    <span class="badge bg-success">15</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Procurement Actions -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                ⚡ Quick Actions
                            </h5>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button">➕ New Purchase Order</button>
                                <button class="btn btn-success" type="button">🏢 Manage Suppliers</button>
                                <button class="btn btn-info" type="button">📊 Generate Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
