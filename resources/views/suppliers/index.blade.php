<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Suppliers') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" action="{{ route('suppliers.index') }}" class="d-flex" role="search">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Search by name">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </form>
                <a href="{{ route('suppliers.create') }}" class="btn btn-primary text-nowrap ms-2">+ Add Supplier</a>
            </div>

            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->email ?? '—' }}</td>
                                    <td>{{ $supplier->address ?? '—' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this supplier?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No suppliers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
