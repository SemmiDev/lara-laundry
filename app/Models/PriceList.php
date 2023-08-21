<?php

namespace App\Models;

use App\Models\Base\PriceList as BasePriceList;

class PriceList extends BasePriceList
{
	protected $fillable = [
		'laundry_id',
		'name',
		'price',
		'unit'
	];
}
