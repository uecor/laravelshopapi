<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Transformers\ProductTransformer;

class ProductsController extends Controller
{
    public function index(Request $request, Product $product)
    {
      $query = $product->query();

      if ($productId = $request->product_id) {
          $query->where('product_id', $productId);
      }

      if ($categoryId = $request->category_id) {
          $query->where('category_id', $categoryId);
      }

      $products = $query->paginate(20);

      return $this->response->paginator($products, new ProductTransformer());
    }

    public function show($id)
    {
    // https://laravelacademy.org/post/3836.html
    // Laravel & Lumen RESTFul API 扩展包：Dingo API（三） —— Response（响应）
      $product = Product::findOrFail($id);
      return $this->response->item($product, new ProductTransformer());
    }


}
