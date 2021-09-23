<?php

namespace App\Observers;

use Illuminate\Support\Str;

use App\Models\Product;

class ProductObserver
{
   /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->flag = Str::kebab($product->title);
        $product->uuid = Str::uuid();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $product->flag = Str::kebab($product->title);
    }
}
