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
        if ($product->count() > 0) {

            return response()->json([
                'status' => 200,
                'message' => 'Data ditemukan',
                'product' => $product
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serialnumber' => 'required',
            'nama' => 'required|max:255',
            'ram' => 'required',
            'android' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {

            $product = Product::create([
                'serialnumber' => $request->serialnumber,
                'nama' => $request->nama,
                'ram' => $request->ram,
                'android' => $request->android,
            ]);

            if ($product) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil dibuat',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Ada yang harus diperbaiki!!',
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'serialnumber' => 'required',
            'nama' => 'required|max:255',
            'ram' => 'required',
            'android' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {

            $product = Product::find($id);

            if ($product) {
                $product->update([
                    'serialnumber' => $request->serialnumber,
                    'nama' => $request->nama,
                    'ram' => $request->ram,
                    'android' => $request->android,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak ditemukan!',
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }
    }
}
