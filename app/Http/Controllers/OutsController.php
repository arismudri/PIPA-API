<?php

namespace App\Http\Controllers;


use App\Out;
use Illuminate\Http\Request;
use Validator;

class OutsController extends Controller

{
    /**
     * Display a listoutg of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = ['message' => 'empty', 'values' => 'empty'];

        $out  = Out::get();

        if (count($out) > 0) {
            $res = ['message' => 'success', 'values' => $out];
        }
        return response()->json($res, 200);
    }

    /**
     * Store a newly created resource out storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->rule($request);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $out = Out::create($request->all());
    
            if ($out) {
                $res = ['message' => 'success input data', 'values' => $out];
            } else {
                $res = ['message' => 'input failed', 'values' => 'empty'];
            }
    
            return response()->json($res, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $out = Out::find($id);
        
        if (!is_null($out)) {
            $res = ['message' => 'success', 'values' => $out];
            return response()->json($res, 200);
        } else {
            $res = ['message' => 'empty', 'values' => 'empty'];
            return response()->json($res, 404);
        }
    }

    /**
     * Update the specified resource out storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->rule($request);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $out = Out::find($id);
            
            if (!is_null($out) && $out->update($request->all())) {
                $res = ['message' => 'success updating data', 'values' => $out];
                return response()->json($res, 200);
            } else {
                $res = ['message' => 'update failed', 'values' => 'empty'];
                return response()->json($res, 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $out = Out::find($id);

        if (!is_null($out) && $out->delete()) {
            $res = ['message' => 'success delete data'];
            return response()->json($res, 200);
        } else {
            $res = ['message' => 'delete failed'];
            return response()->json($res, 404);
        }
    }

    function rule($request)
    {
        $rules = [
            'item_id' =>  'required|exists:App\Item,id|integer|digits_between:1,20',
            'jumlah' =>  'required|integer|digits_between:1,11',
            'keterangan'  =>  'required|string|between:1,225',
        ];

        return Validator::make($request->all(), $rules);
    }

}
