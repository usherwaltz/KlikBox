<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'string'
    ];

    /**
     * Method items
     *
     * @return void
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
