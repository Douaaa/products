<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
//https://www.itsolutionstuff.com/post/laravel-9-user-roles-and-permissions-tutorialexample.html
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        $pageInfo['title'] ='';
        return view('products.index',compact('products','pageInfo'));
    }
    public function add()
    {

        $pageInfo['title'] ='';
        return view('products.add',compact('pageInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'name' => 'required|string',
          'image' => 'required',
          'description' => 'required',

      ]);
      $dataIn = Array(
        'name'=>$request->name,
        'description'=>$request->description,

      );
      $file= $request->file('image');
      if($request->hasFile('image')){
      $request->file('image')->store('/images');
      $name = "product-" . rand(0, 1000000) . '.' . $file->getClientOriginalExtension();
      $path = '/images/'. $name;
      $file->move(public_path() . '/images/', $name);
      chmod(public_path() . '/images/'. $name , '775');
      $dataIn['image']=$name;
    }
      $product = Product::create($dataIn);


      return response()->json([
          'status' => 'success',
          'message' => 'Product created successfully',
          'user' => $product,

      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
