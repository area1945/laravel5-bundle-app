<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Faker\Factory as Faker;
use App\Product;
use App\Category;
use App\Brand;

class ProductController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        $categories = Category::where("id", "<>", 0)->orderBy("name")->get();
        $brands = Brand::where("id", "<>", 0)->orderBy("name")->get();
        return view('product.create')->with("categories", $categories)->with("brands", $brands);
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
                "image"=> $this->getImage($request),
                "code"=> $request->get("code"),
                "name"=> $request->get("name"),
                "description"=> $request->get("description"),
                "brand_id"=> $request->get("brand_id"),
                "stock"=> $request->get("stock"),
                "price"=> $request->get("price"),
            ];

            $model = Product::create($input);

            if($request->get("categories"))
            {
                $categories = $request->get("categories");
                $model->Categories()->sync($categories);
            }   

            return redirect()->route("product.show", ["id"=> $model->id])->with("success", "Data berhasil ditambahkan !!");
        }
    }

    public function show($id)
    {
        $model = Product::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        return view('product.show')->with('model', $model);
    }

    public function edit($id)
    {
        $model = Product::where("id", $id)->first();

        if(is_null($model))
        {
            return abort(404);
        }

        $categories = Category::where("id", "<>", 0)->orderBy("name")->get();
        $brands = Brand::where("id", "<>", 0)->orderBy("name")->get();
        $products_categories = $model->Categories->pluck("id")->toArray();
        return view('product.edit')->with('model', $model)->with("categories", $categories)->with("brands", $brands)->with("products_categories", $products_categories);
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
                "image"=> $this->getImage($request, $id),
                "code"=> $request->get("code"),
                "name"=> $request->get("name"),
                "description"=> $request->get("description"),
                "brand_id"=> $request->get("brand_id"),
                "stock"=> $request->get("stock"),
                "price"=> $request->get("price")
            ];

            Product::where("id", $id)->update($input);

            if($request->get("categories"))
            {
                $model = Product::where("id", $id)->first();
                $categories = $request->get("categories");
                $model->Categories()->sync($categories);
            }  

            return redirect()->route("product.show", ["id"=> $id])->with("success", "Data berhasil diperbaharui !!");
        }
    }

    public function destroy($id)
    {
        Product::where("id", $id)->delete();
        return response()->json(["ok"]);
    }

    private function getImage(Request $request, $id = null){

        $destinationPath = public_path('uploads/products');
        if(!is_dir($destinationPath)){
            @mkdir($destinationPath);
        }

        if($id){
            $model = Product::where("id", $id)->first();
            if($request->file('file_image')){
                $image_path = public_path($model->image);
                if(file_exists($image_path)){
                    @unlink($image_path);
                }
                $faker = Faker::create();
                $file_uuid = $faker->uuid;
                $file = $request->file('file_image');
                $imageName = $file_uuid.'.'.$file->getClientOriginalExtension();
                $imageName = strtolower($imageName);
                $file->move($destinationPath, $imageName);
                return 'uploads/products/'.$imageName;
            }else{
                return $model->image;
            }
        }else{
            if($request->file('file_image')){
                $faker = Faker::create();
                $file_uuid = $faker->uuid;
                $file = $request->file('file_image');
                $imageName = $file_uuid.'.'.$file->getClientOriginalExtension();
                $imageName = strtolower($imageName);
                $file->move($destinationPath, $imageName);
                return 'uploads/products/'.$imageName;
            }else{
                return NULL;
            }
        }
    }
}
