<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Products') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" action="{{ route('products.index') }}" class="d-flex" role="search">
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Search by name or SKU">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </form>
                <a href="{{ route('products.create') }}" class="btn btn-primary text-nowrap ms-2">+ Add Product</a>
            </div>

            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Current Stock</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->unit }}</td>
                                    <td>{{ $product->current_stock }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
