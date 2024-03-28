<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getData($request, $produk)  
    {
        if ($request->satuan != "") {
            $produk->where('satuan_id', $request->satuan);
        }

        if ($request->kategori != "") {
            $produk->where('kategori_id', $request->kategori);
        }
    }

    public function index(Request $request)
    {
        $produk = Produk::with([' kategori', 'satuan', 'gambar']);

        if ($request->all()) {
            $produk = $produk->getData($request, $produk);
        }

        $produk = $produk->get();

        return view('pages.produk.index', compact('produk'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
