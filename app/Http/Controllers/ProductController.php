<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // $section=DB::table('sections')->where('id',$id)->first();
        $sections = Section::all();
        return view('products.products', compact('products', 'sections'));
    }
    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'unique:products,product_name',
        ], [
            'product_name.unique' => 'اسم المنتج موجود بالفعل'
        ]);
        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_name,
        ]);
        return redirect()->back();
    }
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $sections = Section::all();
        $section = DB::table('sections')->where('id', $id)->first();
        return view('products.edit', compact('product', 'sections', 'section'));
    }
    public function update(Request $request, $id)
    {
        DB::table('products')->where('id', '=', $id)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_name
        ]);
        return redirect()->route('products');
    }
    public function delete1($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return view('products.delete', compact('product'));
    }
    public function delete2($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products');
    }

}
