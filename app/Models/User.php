<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'password',
        'email',
        'phoneNumber',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    public function auctions(): HasMany
    {
        return $this->hasMany(Auction::class);
    }

    public $timestamps = false;
}
