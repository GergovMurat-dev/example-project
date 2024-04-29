<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property string $title
 * @property string $description
 * @property float $price
 */
class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    protected $casts = [
        'price' => 'float'
    ];
}
