<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'street_address',
    	'country',
    	'city',
    	'contact_phone',
    	'contact_email'
    ];

    public function matches($street_address, $country, $city, $contact_phone , $contact_email) {
        return $this->street_address == $street_address && $this->country == $country && $this->city == $city && $this->contact_phone == $contact_phone && $this->contact_email == $contact_email;
    }

    // Relations

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
