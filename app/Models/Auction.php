<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'id',
        'name',
        'condition',
        'category',
        'price',
        'endDate',
        'photo',
        'isSold'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;
}