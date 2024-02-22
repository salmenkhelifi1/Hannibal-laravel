<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'available',
        'rate',
        'quantity',
        'sellerProduct',
        'img2',
        'img3',
        'img4',
    ];


public function seller()
{
    return $this->belongsTo(User::class, 'sellerProduct');
}}