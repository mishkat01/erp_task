<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <!-- Card 1: Team Overview -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                👥 Team Overview
                            </h5>
                            <p class="card-text">
                                <strong>Total Employees:</strong> 24<br>
                                <strong>Present Today:</strong> 22<br>
                                <strong>On Leave:</strong> 2
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="#" class="btn btn-sm btn-primary">View Team</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Performance Metrics -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                📈 Performance Metrics
                            </h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tasks Completed</span>
                                    <span class="badge bg-success">89%</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Projects On Track</span>
                                    <span class="badge bg-primary">95%</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Team Satisfaction</span>
                                    <span class="badge bg-info">4.2/5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Manager Actions -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                ⚡ Quick Actions
                            </h5>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button">📋 Assign Tasks</button>
                                <button class="btn btn-success" type="button">📊 View Reports</button>
                                <button class="btn btn-info" type="button">💬 Team Chat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
