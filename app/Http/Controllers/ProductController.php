<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('products.create', compact('categories'));
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
            'code' => 'required|string|max:10|unique:products',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $photo = null;

            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $product = Product::create($request->all());
            $product->photo = $photo;
            $product->save();

            return redirect(route('products.index'))->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        $image_name = str_slug($name) . time() . '.' .$photo->getClientOriginalExtension();

        $path = public_path('uploads/product');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($photo)->save($path. '/' . $image_name);

        return $image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
