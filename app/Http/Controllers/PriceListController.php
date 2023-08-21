<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\PriceList;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    public function index(Laundry $laundry)
    {
        $price_lists = $laundry->price_lists()->get();
        return view('price_lists.index', compact('laundry', 'price_lists'));
    }

    public function create(Laundry $laundry)
    {
        return view('price_lists.create', compact('laundry'));
    }

    public function store(Request $request, Laundry $laundry)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'unit' => 'required|in:kg,pcs,meter,set,lembar',
            'price' => 'required|numeric'
        ], [
            'name.required' => 'Nama layanan harus diisi',
            'price.required' => 'Harga harus diisi',
            'unit.required' => 'Satuan harus diisi',
            'unit.in' => 'Satuan tidak valid',
            'price.numeric' => 'Harga harus berupa angka',
        ]);

        $laundry->price_lists()->create($attributes);

        return redirect()->route('price_lists.index', $laundry)->with('toast_success', 'Harga berhasil ditambahkan');
    }

    public function edit(Laundry $laundry, PriceList $price_list)
    {
        return view('price_lists.edit', compact('laundry', 'price_list'));
    }

    public function update(Request $request, Laundry $laundry, PriceList $price_list)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'unit' => 'required|in:kg,pcs,meter,set,lembar',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'Nama layanan harus diisi',
            'price.required' => 'Harga harus diisi',
            'unit.required' => 'Satuan harus diisi',
            'unit.in' => 'Satuan tidak valid',
            'price.numeric' => 'Harga harus berupa angka',
        ]);

        $price_list->update($attributes);

        return redirect()->route('price_lists.index', $laundry)->with('toast_success', 'Harga berhasil diperbarui');
    }

    public function destroy(Laundry $laundry, PriceList $price_list)
    {
        $price_list->delete();
        return redirect()->route('price_lists.index', $laundry)->with('toast_success', 'Harga berhasil dihapus');
    }
}
