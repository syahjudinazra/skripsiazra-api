<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diterima',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'serialnumber' => 'required',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dibuat',
            'data' => $product
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Data ditemukan',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'nama' => 'max:255',
        //     'serialnumber' => 'max:255',
        // ]);

        // $product = Product::findOrFail($id);

        // $product->update($request->all());

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Data berhasil diupdate.',
        //     'data' => $product
        // ], Response::HTTP_OK);

        //define validation rules

        $validated = $request->validate([
            'nama' => 'required|max:255',
            'serialnumber' => 'required',
        ]);

        $data = Product::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        $data->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully.',
            'data' => $data,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
            'data' => $product
        ]);
    }
}
