<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Pending Approval</div>
                            <div class="display-6 text-warning">{{ $stats['pending'] }}</div>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('requisitions.index', ['status' => 'pending']) }}" class="btn btn-sm btn-warning">Review Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Approved</div>
                            <div class="display-6 text-success">{{ $stats['approved'] }}</div>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('requisitions.index', ['status' => 'approved']) }}" class="btn btn-sm btn-outline-success">View</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-muted small mb-1">Rejected</div>
                            <div class="display-6 text-danger">{{ $stats['rejected'] }}</div>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <a href="{{ route('requisitions.index', ['status' => 'rejected']) }}" class="btn btn-sm btn-outline-danger">View</a>
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
                                <a href="{{ route('requisitions.index') }}" class="btn btn-primary">All Requisitions</a>
                                <a href="{{ route('requisitions.index', ['status' => 'pending']) }}" class="btn btn-warning">Pending Approvals</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
