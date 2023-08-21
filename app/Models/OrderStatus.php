<?php

namespace App\Models;

use App\Models\Base\OrderStatus as BaseOrderStatus;

class OrderStatus extends BaseOrderStatus
{

    public const OrderStatusPending = "Menunggu untuk diproses";
    public const OrderStatusProcessed = "Sedang diproses";
    public const OrderStatusDone = "Selesai";
    public const OrderStatusCanceled = "Dibatalkan";
    public const OrderStatusTaken = "Telah diambil";

	protected $fillable = [
		'order_id',
		'status'
	];
}
