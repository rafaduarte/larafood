<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {   
        /*
        $inputValue = $request->all();

        validate**

        $arrayToString = implode(',', $request->input('name**'));
        $inputValue['name**] = $arrayToString;
        $this->repository->create($inputValue);
        */
        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        $tenant =  auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
                
            }

            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
            
        }
        
        $product->delete();

        return redirect()->route('products.index');
    }


    public function search(Request $request)
    {
        $filters = $request->only('filter');
 
        $products = $this->repository
                        ->where(function($query) use ($request){
                            if ($request->filter) {
                                $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                                $query->orWhere('title', "%{$request->filter}%");
                            }
                        })
                        ->latest()
                        ->paginate();
 
        return view('admin.pages.products.index', compact('products', 'filters'));
    }

    public function test(){

        return view('admin.test');
    }
}
