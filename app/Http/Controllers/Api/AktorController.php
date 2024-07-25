<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\actor;

class AktorController extends Controller
{
    public function index(){
        $aktor = actor::latest()->get();
        $response = [
            'success'=> true,
            'message'=> 'Data Aktor',
            'data'=> $aktor,
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_actor' => 'required|unique:actors',
            'bio' => 'required',
        ],[
            'nama_actor.required'=>'Masukan Aktor',
            'bio.required'=>'Masukan Biodata',
            'nama_actor.unique' => 'Aktor Sudah Di gunakan'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=> 'Silahkan Di isi Dengan Benar',
                'data' => $validator->errors(),
            ], 400);
        } else {
            $aktor = new actor;
            $aktor -> nama_actor = $request->nama_actor;
            $aktor -> bio = $request->bio;
            $aktor ->save();
        }
        if ($aktor) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Disimpan',
            ], 400);
        }
    }

    public function show($id)
    {
        $aktor = actor::find($id);
        if ($aktor) {
            return response()->json([
                'success' => true,
                'message' => 'Data Ditemukan',
                'data' => $aktor
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_actor' => 'required|unique:actors',
            'nama_actor' => 'required',
        ],[
            'nama_actor.required'=>'Masukan Aktor',
            'nama_actor.unique' => 'Aktor Sudah Di gunakan',
            'bio.required'=>'Masukan Biodata'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=> 'Silahkan Di isi Dengan Benar',
                'data' => $validator->errors(),
            ], 400);
        } else {
            $aktor = actor::find($id);
            $aktor -> nama_actor = $request->nama_actor;
            $aktor -> bio = $request->bio;
            $aktor ->save();
        }
        if ($aktor) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Disimpan',
            ], 400);
        }
    }

    public function destroy($id)
    {
        $aktor = actor::find($id);
        if ($aktor) {
            $aktor->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
        }
    }

}
