<?php

namespace App\Models;

use App\Models\Base\Order as BaseOrder;

class Order extends BaseOrder
{
	protected $fillable = [
		'laundry_id',
		'customer_name',
		'status',
		'details',
		'code',
		'total_price'
	];
}
