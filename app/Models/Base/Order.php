<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Laundry;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $laundry_id
 * @property string $customer_name
 * @property string $status
 * @property string $details
 * @property string $code
 * @property float $total_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Laundry $laundry
 * @property Collection|OrderStatus[] $order_statuses
 *
 * @package App\Models\Base
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'laundry_id' => 'int',
		'total_price' => 'float'
	];

	public function laundry()
	{
		return $this->belongsTo(Laundry::class);
	}

	public function order_statuses()
	{
		return $this->hasMany(OrderStatus::class);
	}
}
