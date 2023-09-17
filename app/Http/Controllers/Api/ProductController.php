<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    use apiResponseTrait;
    public function insert(Request $request)
    {
        try {
            $this->validate($request, [
                'product_name' => 'unique:products,product_name',
            ]);
            $product = Product::create(
                [
                    'product_name' => $request->product_name,
                    'description' => $request->description,
                    'section_id' => $request->section_name,
                ]
            );
            return $this->apiResponseTrait($product, 'insert product success', 200);
        } catch (ValidationException $exception) {
            return response()->json([
                'product_name' => 'اسم المنتج موجود بالفعل',
                'section_id' => 'null',
                'description' => 'null',
            ], 422);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'product_name' => 'unique:products,product_name',
            ]);
            $product = DB::table('products')->where('id', $id)->update([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'section_id' => $request->section_name
            ]);
            if ($product) {
                return $this->apiResponseTrait($product, 'تم تعديل المنتج بنجاح', 200);
            } else
                return $this->apiResponseTrait($product, 'المنتج غير موجود', 422);
        } catch (ValidationException $exception) {
            return response()->json([
                'product_name' => 'اسم المنتج موجود بالفعل',
                'section_id' => 'null',
                'description' => 'null',
            ], 422);
        }
    }
    public function delete($id){
        $products=DB::table('products')->where('id',$id)->delete();
        if($products){
            return $this->apiResponseTrait($products,'تم حذف المنتج بنجاح',200);
        }else{
            return $this->apiResponseTrait($products,'هذا المنتج غير موجود',404);
        }
    }
}
