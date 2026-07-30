<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                Profile Information
                            </h5>
                            <p class="card-text">
                                <strong>Name:</strong> {{ Auth::user()->name }}<br>
                                <strong>Email:</strong> {{ Auth::user()->email }}<br>
                                <strong>Department:</strong> {{ Auth::user()->department->name ?? 'Not Assigned' }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                My Requisitions
                            </h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Submitted</span>
                                    <span class="badge bg-primary">{{ $stats['total'] }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Pending</span>
                                    <span class="badge bg-warning">{{ $stats['pending'] }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Approved</span>
                                    <span class="badge bg-success">{{ $stats['approved'] }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Rejected</span>
                                    <span class="badge bg-danger">{{ $stats['rejected'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('requisitions.index') }}" class="btn btn-sm btn-primary">View All</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                Quick Actions
                            </h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('requisitions.create') }}" class="btn btn-primary">New Requisition</a>
                                <a href="{{ route('requisitions.index') }}" class="btn btn-success">My Requisitions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
