@php $initialItems = $initialItems ?? []; @endphp

<div x-data="requisitionForm(@js($initialItems))">
    <table class="table align-middle">
        <thead>
            <tr>
                <th style="width: 40%">Product</th>
                <th style="width: 20%">Quantity</th>
                <th>Remarks</th>
                <th class="text-end">Remove</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(item, index) in items" :key="index">
                <tr>
                    <td>
                        <select class="form-select" :name="`items[${index}][product_id]`" x-model.number="item.product_id" required>
                            <option value="">Select a product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" min="1" class="form-control" :name="`items[${index}][quantity]`" x-model.number="item.quantity" required>
                    </td>
                    <td>
                        <input type="text" class="form-control" :name="`items[${index}][remarks]`" x-model="item.remarks" placeholder="Optional">
                    </td>
                    <td class="text-end">
                        <button type="button" class="btn btn-sm btn-outline-danger" @click="removeItem(index)" x-show="items.length > 1">✕</button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <button type="button" class="btn btn-sm btn-outline-primary mb-3" @click="addItem()">+ Add Item</button>

    @error('items')
        <div class="text-danger small mb-3">{{ $message }}</div>
    @enderror

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
        <a href="{{ route('requisitions.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>
