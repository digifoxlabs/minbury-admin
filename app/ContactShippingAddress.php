<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactShippingAddress extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function contact()
    {
        return $this->belongsTo(\App\Contact::class);
    }
}
