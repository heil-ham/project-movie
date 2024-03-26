<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

//import model product
use App\Models\Product;

//import return type view
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Http request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
//import facades storage
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index() : View {
        
        //get all products
        $products = Product::latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));
     }

     /**
      * create
      *
      * @return View
      */
      public function create(): View {
         return view('products.create');
      }

      /**
       * 
       * @param mixed $request
       * @return RedirectResponse
       */
      public function store(Request $request): RedirectResponse {

         //validate form
         $request->validate([
            'image'        => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'title'        => 'required|min:5',
            'description'  => 'required|min:10',
            'price'        => 'required|numeric',
            'stock'        => 'required|numeric'
         ]);

         //upload image
         $image = $request->file('image');
         $image->storeAs('public/products', $image->hashName());

         //create product
         Product::create([
            'image'        => $image->hashName(),
            'title'        => $request->title,
            'description'  => $request->description,
            'price'        => $request->price,
            'stock'        => $request->stock
         ]);
         //redirect to index
         return redirect()->route('products.index')->with(['success' => 'Data berhasil disimpan!']);
      }

      /**
       * show
       * @param mixed $id
       * @return View
       */

      public function show(string $id): View {
         // get product by ID
         $product = Product::findOrFail($id);

         // render view with product
         return view('products.show', compact('product'));
      }

      /**
       * edit
       * @param mixed @id
       * @return View
       */
      public function edit(string $id): View {

         //get product by ID
         $product = Product::findOrFail($id);

         //render view with product
         return view('products.edit', compact('product'));
      }

      /**
       * update
       * 
       * @param mixed $request
       * @param mixed $id
       * @param RedirectResponse
       */

       public function update(Request $request, $id): RedirectResponse {
         //validate form
         $request->validate([
            'image'        => 'image|mimes:jpeg,png,jpg|max:4096',
            'title'        => 'required|min:5',
            'description'  => 'required|min:10',
            'price'        => 'required|numeric',
            'stock'        => 'required|numeric'
         ]);

         //get product by id
         $product = Product::findOrFail($id);

         //check if image is uploaded
         if ($request->hasFile('image')) {
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //delete old image
            Storage::delete('public/products/' . $request->image);

            //update image with new image
            $product->update([
               'image'        => $image->hashName(),
               'title'        => $request->title,
               'description'  => $request->description,
               'stock'        => $request->stock,
               'price'        => $request->price
            ]);
         }
         else {
            $product->update([
               //update product without image
               'title'        => $request->title,
               'description'  => $request->description,
               'stock'        => $request->stock,
               'price'        => $request->price
            ]);
         }

         //redirect to index
         return redirect()->route('products.index')->with(['success' => 'Data berhasil disimpan!']);
       }

       /**
        * 
        * @param mixed $id
        * @return RedirectResponse
        */
       public function destroy($id): RedirectResponse {
         // get product by ID
         $product = Product::findOrFail($id);

         // delete image
         Storage::delete('public/products/' . $product->id);

         //delete product
         $product->delete();

         //redirect to index
         return redirect()->route('products.index')->with(['success' => 'Data berhasil disimpan!']);
       }
}
