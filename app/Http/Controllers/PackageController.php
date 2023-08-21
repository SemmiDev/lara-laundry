<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Package;
use App\Models\PriceList;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Laundry $laundry)
    {
        $packages = $laundry->packages()->get();
        return view('packages.index', compact('laundry', 'packages'));
    }

    public function create(Laundry $laundry)
    {
        return view('packages.create', compact('laundry'));
    }

    public function store(Request $request, Laundry $laundry)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ], [
            'name.required' => 'Nama layanan harus diisi',
            'price.required' => 'Paket harus diisi',
            'price.numeric' => 'Paket harus berupa angka',
        ]);

        $laundry->packages()->create($attributes);

        return redirect()->route('packages.index', $laundry)->with('toast_success', 'Paket berhasil ditambahkan');
    }

    public function edit(Laundry $laundry, Package $package)
    {
        return view('packages.edit', compact('laundry', 'package'));
    }

    public function update(Request $request, Laundry $laundry, Package $package)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'Nama layanan harus diisi',
            'price.required' => 'Paket harus diisi',
            'price.numeric' => 'Paket harus berupa angka',
        ]);

        $package->update($attributes);

        return redirect()->route('packages.index', $laundry)->with('toast_success', 'Paket berhasil diperbarui');
    }

    public function destroy(Laundry $laundry, Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index', $laundry)->with('toast_success', 'Paket berhasil dihapus');
    }
}
