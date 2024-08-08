<?php

namespace App\Http\Controllers;

use Datatables;
use App\Brand;
use App\Category;
use App\Contact;
use App\Product;

class DatatableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function contact()
    {
        $data = Contact::where("id", "<>", 0);
        return DataTables::eloquent($data)->make(true);
    }

    public function category()
    {
        $data = Category::where("id", "<>", 0);
        return DataTables::eloquent($data)->make(true);
    }

    public function brand()
    {
        $data = Brand::where("id", "<>", 0);
        return DataTables::eloquent($data)->make(true);
    }

    public function product()
    {
        $data = Product::where("id", "<>", 0);
        return DataTables::eloquent($data)->make(true);
    }
}