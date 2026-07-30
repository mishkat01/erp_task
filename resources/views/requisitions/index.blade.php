@php
    $statusColors = ['pending' => 'warning', 'approved' => 'success', 'rejected' => 'danger'];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Purchase Requisitions') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <form method="GET" action="{{ route('requisitions.index') }}" class="d-flex gap-2 flex-wrap">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="PR Number, Employee, or Department" style="min-width: 260px">
                    <select name="status" class="form-select" style="width: auto">
                        <option value="">All Statuses</option>
                        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                        <option value="approved" @selected(request('status') === 'approved')>Approved</option>
                        <option value="rejected" @selected(request('status') === 'rejected')>Rejected</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                    @if (request()->hasAny(['q', 'status']))
                        <a href="{{ route('requisitions.index') }}" class="btn btn-outline-secondary">Clear</a>
                    @endif
                </form>

                @if (Auth::user()->role === 'employee')
                    <a href="{{ route('requisitions.create') }}" class="btn btn-primary text-nowrap">+ New Requisition</a>
                @endif
            </div>

            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>PR Number</th>
                                <th>Employee</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requisitions as $requisition)
                                <tr>
                                    <td>{{ $requisition->requisition_no }}</td>
                                    <td>{{ $requisition->employee?->name ?? '—' }}</td>
                                    <td>{{ $requisition->department?->name ?? '—' }}</td>
                                    <td><span class="badge bg-{{ $statusColors[$requisition->status] }}">{{ ucfirst($requisition->status) }}</span></td>
                                    <td>{{ $requisition->created_at->format('Y-m-d') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('requisitions.show', $requisition) }}" class="btn btn-sm btn-outline-secondary">View</a>

                                        @if (Auth::user()->role === 'employee' && $requisition->employee_id === Auth::id() && $requisition->isPending())
                                            <a href="{{ route('requisitions.edit', $requisition) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('requisitions.destroy', $requisition) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this requisition?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        @endif

                                        @if (Auth::user()->role === 'manager' && $requisition->isPending())
                                            <form action="{{ route('requisitions.approve', $requisition) }}" method="POST" class="d-inline" onsubmit="return confirm('Approve this requisition?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $requisition->id }}">Reject</button>

                                            <div class="modal fade" id="rejectModal{{ $requisition->id }}" tabindex="-1" aria-hidden="true">
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
                                                                <label for="rejection_reason{{ $requisition->id }}" class="form-label">Reason for rejection</label>
                                                                <textarea id="rejection_reason{{ $requisition->id }}" name="rejection_reason" class="form-control" required></textarea>
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

                                        @if (Auth::user()->role === 'procurement' && $requisition->status === 'approved' && ! $requisition->purchaseOrder)
                                            <a href="{{ route('purchase-orders.create') }}" class="btn btn-sm btn-outline-success">Create PO</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No requisitions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $requisitions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
