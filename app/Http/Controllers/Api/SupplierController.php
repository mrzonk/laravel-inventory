<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::latest()->paginate(10);
        return response()->json([
            'success' => true,
            'supplier'    =>$suppliers
        ],200);
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
        //

        $input=$request->all();
        $validator= Validator::make($input,
        [
            'name'=> 'required|max:30',
            'address'=> 'required',
            'email'=> 'required|email',
            'number'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $supplier= Supplier::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'email'=>$request->email,
            'number'=>$request->number,
        ]);
        if($supplier){
            return response()->json([
                'success'=>true,
                'supplier'=>$supplier,
            ],201);
        }
        return response()->json([
            'success'=>false,
        ],409);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $supplier=Supplier::find($id);
        return response()->json([
            'success'=>true,
            'supplier'=>$supplier,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id )
    {
        //
        
     
        $input=$request->all();
        $validator= Validator::make($input,
        [
            'name'=> 'required|max:30',
            'address'=> 'required',
            'email'=> 'required|email',
            'number'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }else{
           $supplier=Supplier::find($id);
            $supplier->name=$request->name;
            $supplier->address=$request->address;
            $supplier->email=$request->email;
            $supplier->number=$request->number;
            $supplier->save();

           
            return response()->json([
                'success'=>true,
                'supplier'=>$supplier,
            ],200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $supplier=Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json([
            'success'=>true,
            'info'=>"Berhasil Menghapus",
        ],200);
    }
    public function __invoke(Request $request)
    {
       /*
        $suppliers = Supplier::latest()->paginate(10);
        return response()->json([
            'success' => true,
            'supplier'    =>$suppliers
        ],200);
    */
    }
}
