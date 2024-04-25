<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // listado  
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //formulario de registro
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre',
            'name.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripcion',
            'description.max' => 'La descripcion debe tener un maxino de 200 caracteres',
            'price.required' => 'Es necesario ingresar un precio',
            'price.numeric' => 'El precio debe ser mayor numerico',
            'price.min' => 'El precio debe ser mayor a 0 ',
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);

        //registra el nuevo producto en la bdd
        //dd($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); //Insert

        return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product')); //form de edicion
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validar
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre',
            'name.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripcion',
            'description.max' => 'La descripcion debe tener un maxino de 200 caracteres',
            'price.required' => 'Es necesario ingresar un precio',
            'price.numeric' => 'El precio debe ser mayor numerico',
            'price.min' => 'El precio debe ser mayor a 0 ',
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        //
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); //Update

        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /**
         *$product = Product::find($id);
         *$product->delete(); //Delete

         *return back();
         */

        $product = Product::find($id);

        // Eliminar las imágenes del producto primero
        foreach ($product->images as $image) {
            $image->delete();
        }

        // Ahora puedes eliminar el producto
        $product->delete();

        return back();
    }
}
