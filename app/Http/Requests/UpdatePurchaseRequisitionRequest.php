<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequisitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        $requisition = $this->route('requisition');

        return $this->user()->id === $requisition->employee_id
            && $requisition->isPending();
    }

    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function withValidator(ValidatorContract $validator): void
    {
        $validator->after(function (ValidatorContract $validator) {
            $productIds = collect($this->input('items', []))->pluck('product_id')->filter();

            if ($productIds->count() !== $productIds->unique()->count()) {
                $validator->errors()->add('items', 'A requisition cannot contain the same product more than once.');
            }
        });
    }
}
