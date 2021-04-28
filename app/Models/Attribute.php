<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    /**
     * Method options
     *
     * @return void
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * Method products
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
