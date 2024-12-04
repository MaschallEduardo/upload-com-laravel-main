<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index',[
            'products' => DB::table('products')->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file_name = rand(0,999999) . '-' . $request->file('product_file_name')->getClientOriginalName();
        $path = $request->file('product_file_name')->storeAs('uploads', $file_name);

        $data = $request->all();
        $data['product_file_name'] = $path;

        Product::create($data);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Deletar o arquivo do servidor
        $filePath = storage_path('app/' . $product->product_file_name);
        if (file_exists($filePath)) {
            unlink($filePath); // Exclui o arquivo do sistema de arquivos
        }
    
        // Excluir o produto do banco de dados
        $product->delete();
    
        return response()->json(['success' => true]);
    }
}
