<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $id = 0;
        $rules = [
            'code' => 'required|unique:categories,code,' . $id,
            'name' => 'required|unique:categories,name,' . $id,
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

            $model = Category::create($input);
            return redirect()->route("category.show", ["id"=> $model->id])->with("success", "Data berhasil ditambahkan !!");
        }
    }

    public function show($id)
    {
        $model = Category::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        return view('category.show')->with('model', $model);
    }

    public function edit($id)
    {
        $model = Category::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        return view('category.edit')->with('model', $model);
    }

    public function update($id, Request $request)
    {
    
        $rules = [
            'code' => 'required|unique:categories,code,' . $id,
            'name' => 'required|unique:categories,name,' . $id,
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

            Category::where("id", $id)->update($input);
            return redirect()->route("category.show", ["id"=> $id])->with("success", "Data berhasil diperbaharui !!");
        }

    }

    public function destroy($id)
    {
        Category::where("id", $id)->delete();
        return response()->json(["ok"]);
    }

}
