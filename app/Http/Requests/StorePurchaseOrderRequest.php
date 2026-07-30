<?php

namespace App\Http\Requests;

use App\Models\PurchaseRequisition;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePurchaseOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'procurement';
    }

    public function rules(): array
    {
        return [
            'requisition_id' => [
                'required',
                'integer',
                Rule::exists('purchase_requisitions', 'id')->where('status', PurchaseRequisition::STATUS_APPROVED),
            ],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'order_date' => ['required', 'date'],
        ];
    }

    public function withValidator(ValidatorContract $validator): void
    {
        $validator->after(function (ValidatorContract $validator) {
            $requisitionId = $this->input('requisition_id');

            if ($requisitionId && PurchaseRequisition::whereKey($requisitionId)->whereHas('purchaseOrder')->exists()) {
                $validator->errors()->add('requisition_id', 'This requisition already has a purchase order.');
            }
        });
    }
}
