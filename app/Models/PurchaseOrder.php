<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
       public function requisitionItem(): HasMany
    {
        return $this->hasMany(RequisitionItem::class);
    }

       public function supplier(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }
}
