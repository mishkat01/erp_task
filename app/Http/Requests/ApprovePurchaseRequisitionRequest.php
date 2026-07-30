<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApprovePurchaseRequisitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'manager'
            && $this->route('requisition')->isPending();
    }

    public function rules(): array
    {
        return [];
    }
}
