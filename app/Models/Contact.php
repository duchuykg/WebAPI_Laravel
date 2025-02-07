<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    
    protected $fillable = [
        'name',
        'address',
        'phone',
        'subject',
        'message'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}