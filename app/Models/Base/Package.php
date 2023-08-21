<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Laundry;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Package
 * 
 * @property int $id
 * @property int $laundry_id
 * @property string $name
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Laundry $laundry
 *
 * @package App\Models\Base
 */
class Package extends Model
{
	protected $table = 'packages';

	protected $casts = [
		'laundry_id' => 'int',
		'price' => 'float'
	];

	public function laundry()
	{
		return $this->belongsTo(Laundry::class);
	}
}
