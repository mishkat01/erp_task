<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
        /**
     * Get the employee for the spesific department.
     */
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function purchaseRequisition(): HasMany
    {
        return $this->hasMany(PurchaseRequisition::class);
    }

}
