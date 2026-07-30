<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name'];

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function purchaseRequisition(): HasMany
    {
        return $this->hasMany(PurchaseRequisition::class);
    }
}
