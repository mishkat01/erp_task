<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Requisition') }} {{ $requisition->requisition_no }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('requisitions.update', $requisition) }}">
                        @csrf
                        @method('PUT')
                        @php
                            $initialItems = $requisition->items->map(fn ($item) => [
                                'product_id' => $item->product_id,
                                'quantity' => $item->quantity,
                                'remarks' => $item->remarks,
                            ])->values()->all();
                            $submitLabel = 'Update Requisition';
                        @endphp
                        @include('requisitions._item-form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
