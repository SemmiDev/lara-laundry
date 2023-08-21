<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LaundryController extends Controller
{
    public function index(Request $request): View
    {
        $userLatitude = $request->input('user_latitude', 0);
        $userLongitude = $request->input('user_longitude', 0);

        $laundries = auth()->user()->laundries()->latest()->get();

        if ($userLongitude == 0 || $userLongitude == 0) {
            return view('laundries.index', ['laundries' => $laundries]);
        }

        $sortedLaundries = $this->searchNearestLaundries($laundries, $userLatitude, $userLongitude);

        return view('laundries.index', ['laundries' => $sortedLaundries]);
    }

    private function searchNearestLaundries($laundries, $userLatitude, $userLongitude)
    {
        foreach ($laundries as $laundry) {
            $laundryLatitude = $laundry->latitude;
            $laundryLongitude = $laundry->longitude;
            $distance = $this->haversine($userLatitude, $userLongitude, $laundryLatitude, $laundryLongitude);
            $laundry->distance = $distance;
        }

        return $laundries->sortBy('distance');
    }

    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        // Radius bumi dalam kilometer
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

    public function create() : View
    {
        return view('laundries.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $attr = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'name.required' => 'Nama laundry harus diisi',
            'address.required' => 'Alamat harus diisi',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'phone_number.regex' => 'Nomor telepon tidak valid',
            'latitude.required' => 'Latitude harus diisi',
            'longitude.required' => 'Longitude harus diisi',
        ]);

        $user = auth()->user();
        $user->laundries()->create($attr);

        return redirect()->route('laundries.index')->with('toast_success', 'Laundry berhasil ditambahkan');
    }

    public function show(Laundry $laundry) : View
    {
        // show the orders and price lists of the laundry with pagination
        $price_lists = $laundry->price_lists()->latest()->paginate(5);
        $orders = $laundry->orders()->latest()->paginate(5);

        return view('laundries.show', [
            'laundry' => $laundry,
            'price_lists' => $price_lists,
            'orders' => $orders,
        ]);
    }

    public function edit(Laundry $laundry) : View
    {
        return view('laundries.edit', compact('laundry'));
    }

    public function update(Request $request, Laundry $laundry) : RedirectResponse
    {
        $attr = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'name.required' => 'Nama laundry harus diisi',
            'address.required' => 'Alamat harus diisi',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'phone_number.regex' => 'Nomor telepon tidak valid',
            'latitude.required' => 'Latitude harus diisi',
            'longitude.required' => 'Longitude harus diisi',
        ]);

        $laundry->update($attr);

        return redirect()->route('laundries.index')->with('toast_success', 'Laundry berhasil di edit');
    }

    public function destroy(Laundry $laundry) : RedirectResponse
    {
        $laundry->delete();
        return redirect()->route('laundries.index')->with('toast_success', 'Laundry berhasil dihapus');
    }
}
