<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Method category
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Method attributes
     *
     * @return void
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute');
    }

    /**
     * Method blocks
     *
     * @return void
     */
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    /**
     * Method options
     *
     * @return void
     */
    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
}
