<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Order;
use App\Models\Package;
use App\Models\PriceList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Laundry
 * 
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 * @property string $phone_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Order[] $orders
 * @property Collection|Package[] $packages
 * @property Collection|PriceList[] $price_lists
 *
 * @package App\Models\Base
 */
class Laundry extends Model
{
	protected $table = 'laundries';

	protected $casts = [
		'user_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function packages()
	{
		return $this->hasMany(Package::class);
	}

	public function price_lists()
	{
		return $this->hasMany(PriceList::class);
	}
}
