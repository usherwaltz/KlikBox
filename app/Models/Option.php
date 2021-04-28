<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    /**
     * Method attribute
     *
     * @return void
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Method products
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany(Prouct::class);
    }
}
