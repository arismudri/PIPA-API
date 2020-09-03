<?php

namespace App\Http\Controllers;


use App\In;
use Illuminate\Http\Request;
use Validator;

class InsController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = ['message' => 'empty', 'values' => 'empty'];

        $in  = In::get();

        if (count($in) > 0) {
            $res = ['message' => 'success', 'values' => $in];
        }
        return response()->json($res, 200);
    }

    /**
     * Store a newly created resource in storage.
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
            $in = In::create($request->all());
    
            if ($in) {
                
                $res = ['message' => 'success input data', 'values' => $in];
            } else {
                $res = ['message' => 'input failed', 'values' => 'empty'];
            }
    
            return response()->json($res, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\In  $in
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $in = In::find($id);
        
        if (!is_null($in)) {
            $res = ['message' => 'success', 'values' => $in];
            return response()->json($res, 200);
        } else {
            $res = ['message' => 'empty', 'values' => 'empty'];
            return response()->json($res, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\In  $in
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->rule($request);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $in = In::find($id);
            
            if (!is_null($in) && $in->update($request->all())) {
                $res = ['message' => 'success updating data', 'values' => $in];
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
     * @param  \App\In  $in
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $in = In::find($id);

        if (!is_null($in) && $in->delete()) {
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
