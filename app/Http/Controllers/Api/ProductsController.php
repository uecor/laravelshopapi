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


      $products = $query->paginate(20);

      return $this->response->paginator($products, new ProductTransformer());
    }
}
