<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
  protected $availableIncludes = ['category'];

  public function transform(Product $product)
  {
      return [
          'id' => $product->id,
          'title' => $product->title,
          'description' => $product->description,
          'image' => $product->image,
          'on_sale' => $product->on_sale,
          'rating' => $product->rating,
          'sold_count' => $product->sold_count,
          'review_count' => $product->review_count,
          'price' => $product->price,
          'created_at' => $product->created_at->toDateTimeString(),
          'updated_at' => $product->updated_at->toDateTimeString(),
      ];
  }

  public function includeCategory(Product $product)
  {
      return $this->item($product->category, new CategoryTransformer());
  }

}
