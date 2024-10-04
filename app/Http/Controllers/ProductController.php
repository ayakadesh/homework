<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\product;

class ProductController extends Controller
{
    
    public function index()
    {
        $products=Product::all();
        return ProductResource($products);
    }

    
    public function store(Request $request)
    {
        Product::create($request->all());
        if ($request->has('tags')) {
            $product->tags()->attach($request->tags);
        }
        else "This product does not have any tags ye";
        
        return $this->returnSuccess("tag has been created suuccessfuly",200); 
    }

    //اول براميترين اذا كان للمنتج خواص والثالث اذا لاء
    public function show(Request $request,Product $product ,string $id)
    {
        //اذا موجود خواص للمنتج لح يحملها ويعرضها مع المنتج
        if ($request->has('tags')) {
            $data=$product->load('tags') ;
            return new ProductResource($data);}
            //اذا مافي بيبحث عن idالخاص بالمنتج موجود بيعرضه مع رسالة ما موجود يعرض رسالة ثانية
        else{
            $product = Product::find($id);
            if(!$product){
                return $this->returnError("product not found",404);
            }
            return $this->returnData("product",new ProductResource($product),"successed opertation",200);
        }
    }

   
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if(!$product){
            return $this->returnError("product not found",404);
    
        }

        $product->update($request->all());
        return $this->returnData("product",new ProductResource($tag),"Product updated successfuly",200);

    }

    
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if(!$product){
            return $this->returnError("product not found",404);
    
        }

        $tag->delete();
        return $this->returnSuccess("Product deleted successfuly",200);
    
    }
}
