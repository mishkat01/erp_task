<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create Purchase Order') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($eligibleRequisitions->isEmpty())
                                <p class="text-muted mb-0">There are no approved requisitions awaiting a purchase order.</p>
                            @else
                                <form method="POST" action="{{ route('purchase-orders.store') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="requisition_id" class="form-label">Approved Requisition</label>
                                        <select class="form-select @error('requisition_id') is-invalid @enderror" id="requisition_id" name="requisition_id" required>
                                            <option value="">Select a requisition</option>
                                            @foreach ($eligibleRequisitions as $requisition)
                                                <option value="{{ $requisition->id }}" @selected(old('requisition_id') == $requisition->id)>
                                                    {{ $requisition->requisition_no }} — {{ $requisition->employee?->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('requisition_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="supplier_id" class="form-label">Supplier</label>
                                        <select class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id" required>
                                            <option value="">Select a supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="order_date" class="form-label">Order Date</label>
                                        <input type="date" class="form-control @error('order_date') is-invalid @enderror" id="order_date" name="order_date" value="{{ old('order_date', now()->toDateString()) }}" required>
                                        @error('order_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Create Purchase Order</button>
                                        <a href="{{ route('purchase-orders.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
