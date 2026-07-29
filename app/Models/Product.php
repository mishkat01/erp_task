<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
       public function requisitionItem(): HasMany
    {
        return $this->hasMany(RequisitionItem::class);
    }
}
