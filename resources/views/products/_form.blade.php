@php $product = $product ?? null; @endphp

<div class="mb-3">
    <label for="sku" class="form-label">SKU</label>
    <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" required>
    @error('sku')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="unit" class="form-label">Unit</label>
    <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" placeholder="e.g. pcs, box, kg" value="{{ old('unit', $product->unit ?? '') }}" required>
    @error('unit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="current_stock" class="form-label">Current Stock</label>
    <input type="number" min="0" class="form-control @error('current_stock') is-invalid @enderror" id="current_stock" name="current_stock" value="{{ old('current_stock', $product->current_stock ?? 0) }}" required>
    @error('current_stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $product ? 'Update Product' : 'Create Product' }}</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
</div>
