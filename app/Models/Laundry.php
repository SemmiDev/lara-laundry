<?php

namespace App\Models;

use App\Models\Base\Laundry as BaseLaundry;

class Laundry extends BaseLaundry
{
	protected $fillable = [
		'user_id',
		'name',
		'address',
		'latitude',
		'longitude',
		'phone_number'
	];
}
