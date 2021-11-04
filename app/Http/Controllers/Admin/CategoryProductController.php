<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;

   public function __construct(Product $product, Category $category)
   {
        $this->product = $product;
        $this->category = $category;
        
        $this->middleware(['can:products']);
   }


   public function categories($idProduct)
   {
    $product = $this->product->with('categories')->find($idProduct);

    if (!$product) {
        return redirect()->back();
    }
    $categories = $product->categories()->paginate();

    return view('admin.pages.products.categories.categories', compact('product', 'categories'));
   }


   public function products($idcategory)
   {
    $category = $this->category->with('products')->find($idcategory);

    if (!$category) {
        return redirect()->back();
    }
    $products = $category->products()->paginate();

    return view('admin.pages.categories.products.products', compact('category', 'products'));
   }


   public function categoriesAvailable(Request $request, $idProduct)
   {    
    $product = $this->product->find($idProduct);
       if (!$product) {
        return redirect()->back();
    }

    $filters = $request->except('_token');
    //dd($request->filter); // filter nome do campo
    $categories = $product->categoriesAvailable($request->filter);
    //1 $categories = $this->category->paginate();

    return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));

   }


   public function attachCategoriesProduct(Request $request, $idProduct)
   {
       if (!$product = $this->product->find($idProduct)) {
           return redirect()->back();
       }

       if (!$request->categories || count($request->categories) == 0) {
           return redirect()
                       ->back()
                       ->with('info', 'Precisa escolher pelo menos uma permissão');
       }

       $product->categories()->attach($request->categories);

       return redirect()->route('products.categories', $product->id);
   }


   public function detachCategoryProduct($idProduct, $idcategory)
   {
       $product = $this->product->find($idProduct);
       $category = $this->category->find($idcategory);

       if (!$product || !$category) {
        return redirect()->back();
    }

       $product->categories()->detach($category);

       return redirect()->route('products.categories', $product->id);
   }
}
