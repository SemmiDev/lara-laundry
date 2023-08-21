<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\TrackingCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Laundry $laundry)
    {
        $orders = $laundry->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders', 'laundry'));
    }

    public function create(Laundry $laundry)
    {
        $price_list = $laundry->price_lists;
        $package_list = $laundry->packages;

        return view('orders.create', [
            'laundry' => $laundry,
            'price_list' => $price_list,
            'package_list' => $package_list
        ]);
    }

    public function store(Request $request, Laundry $laundry)
    {
        $customerName = $request->input('customer_name');
        $selectedPackages = $request->input('packages', []);
        $selectedPrices = $request->input('price_lists', []);

        $packages = [];
        $totalPackagesPrice = 0;

        foreach ($selectedPackages as $packageId) {
            $package = $laundry->packages()->find($packageId);

            $totalPackagesPrice += $package->price;
            $packages[] = [
                'package_name' => $package->name,
                'package_price' => $package->price,
            ];
        }

        $priceList = [];
        $totalPriceListsPrice = 0;

        foreach ($selectedPrices as $priceId => $data) {
            $price = $laundry->price_lists()->find($priceId);
            $quantity = $data['quantity'];
            if (!$quantity) {
                continue;
            }

            $totalPriceListsPrice += $price->price * $quantity;
            $priceList[] = [
                'price_list_name' => $price->name,
                'price_list_price' => $price->price,
                'price_list_unit' => $price->unit,
                'quantity' => $quantity,
                'total_price' => $price->price * $quantity
            ];
        }

        $orderDetails = [
            'customer_name' => $customerName,
            'packages' => $packages,
            'total_packages_price' => $totalPackagesPrice,
            'price_list' => $priceList,
            'total_price_lists_price' => $totalPriceListsPrice,
            'total_price' => $totalPackagesPrice + $totalPriceListsPrice
        ];

        $request->session()->put('order_details', $orderDetails);
        return redirect()->route('orders.confirm', ['laundry' => $laundry]);
    }

    public function confirm(Laundry $laundry)
    {
        $orderDetails = session('order_details');
        return view('orders.confirm', compact('orderDetails', 'laundry'));
    }

    public function confirmStore(Laundry $laundry)
    {
        try {
            return DB::transaction(function () use ($laundry) {
                $orderDetails = session('order_details');

                // Anda dapat memeriksa $orderDetails di sini jika perlu

                $order = new Order();
                $order->fill([
                    'customer_name' => $orderDetails['customer_name'],
                    'total_price' => $orderDetails['total_price'],
                    'status' => OrderStatus::OrderStatusPending,
                    'details' => json_encode($orderDetails), // Ubah ke JSON saat menyimpan
                    'code' => TrackingCode::Generate()
                ]);
                $order->laundry()->associate($laundry);
                $order->save();

                OrderStatus::create([
                    'order_id' => $order->id,
                    'status' => OrderStatus::OrderStatusPending
                ]);

                session()->forget('order_details');
                return redirect()->route('orders.index', ['laundry' => $laundry])->with('toast_success', 'Order berhasil dibuat');
            });
        } catch (\Throwable $e) {
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Laundry $laundry, Order $order)
    {
        $status = $request->input('status');
        $order->status = $status;
        $order->save();

        OrderStatus::create([
            'order_id' => $order->id,
            'status' => $status
        ]);

        return redirect()->route('orders.index', [
            'laundry' => $laundry
        ])->with('toast_success', 'Order berhasil diubah');
    }

    public function destroy(Laundry $laundry, Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('toast_success', 'Order berhasil dihapus');
    }

    public function tracking(Request $request)
    {
        $code = $request->input('code');
        if (!$code) {
            return view('orders.tracking');
        }

        $order = Order::where('code', $code)->first();
        if (!$order) {
            return redirect()->back()->with('toast_error', 'Kode order tidak ditemukan');
        }

        $orderStatuses = OrderStatus::select('status', 'created_at')
            ->where('order_id', $order->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.tracking', compact('order', 'orderStatuses'));
    }
}
