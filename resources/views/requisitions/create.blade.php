<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('New Purchase Requisition') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('requisitions.store') }}">
                        @csrf
                        @php $initialItems = []; $submitLabel = 'Submit Requisition'; @endphp
                        @include('requisitions._item-form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
