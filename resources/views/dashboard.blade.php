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
                                Statistics
                            </h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Tasks</span>
                                    <span class="badge bg-primary">12</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Completed</span>
                                    <span class="badge bg-success">8</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Pending</span>
                                    <span class="badge bg-warning">4</span>
                                </div>
                            </div>
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
                                <button class="btn btn-primary" type="button">New Task</button>
                                <button class="btn btn-success" type="button">View Reports</button>
                                <button class="btn btn-info" type="button">Messages</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
