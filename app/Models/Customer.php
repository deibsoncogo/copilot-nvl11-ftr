<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        "name",
        "email",
        "phone",
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
