<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderStatus
 * 
 * @property int $id
 * @property int $order_id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 *
 * @package App\Models\Base
 */
class OrderStatus extends Model
{
	protected $table = 'order_statuses';

	protected $casts = [
		'order_id' => 'int'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
