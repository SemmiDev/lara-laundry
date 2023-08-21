<?php

namespace App\Models;

use App\Models\Base\Package as BasePackage;

class Package extends BasePackage
{
	protected $fillable = [
		'laundry_id',
		'name',
		'price'
	];
}
