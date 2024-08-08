<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Brand;

class BrandController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('brand.index');
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $id = 0;
        $rules = [
            'code' => 'required|unique:brands,code,' . $id,
            'name' => 'required|unique:brands,name,' . $id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
        {
            $input = [
                "code"=> $request->get("code"),
                "name"=> $request->get("name"),
                "description"=> $request->get("description"),
            ];

            $model = Brand::create($input);
            return redirect()->route("brand.show", ["id"=> $model->id])->with("success", "Data berhasil ditambahkan !!");
        }
    }

    public function show($id)
    {
        $model = Brand::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        return view('brand.show')->with('model', $model);
    }

    public function edit($id)
    {
        $model = Brand::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        return view('brand.edit')->with('model', $model);
    }

    public function update($id, Request $request)
    {
    
        $rules = [
            'code' => 'required|unique:brands,code,' . $id,
            'name' => 'required|unique:brands,name,' . $id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
        {
            $input = [
                "code"=> $request->get("code"),
                "name"=> $request->get("name"),
                "description"=> $request->get("description"),
            ];

            Brand::where("id", $id)->update($input);
            return redirect()->route("brand.show", ["id"=> $id])->with("success", "Data berhasil diperbaharui !!");
        }

    }

    public function destroy($id)
    {
        Brand::where("id", $id)->delete();
        return response()->json(["ok"]);
    }

}
