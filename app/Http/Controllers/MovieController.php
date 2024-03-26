<?php

namespace App\Http\Controllers;


//import model movie
use App\Models\Movie;

//import return type view
use Illuminate\View\View;

//import return type RedirectResponse
use Illuminate\Http\RedirectResponse;

//import Http request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

//import facades storage
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index() : View {
        
        //get all products
        $movies = Movie::latest()->paginate(10);

        //render view with products
        return view('movies.index', compact('movies'));
     }

     public function create(): View {
        return view('movies.create');
     }

     public function store(Request $request): RedirectResponse {

        //validate form
        $request->validate([
           'image'        => 'required|image|mimes:jpeg,png,jpg|max:4096',
           'title'        => 'required|min:2',
           'director'  => 'required|min:5',
           'year'        => 'required|numeric',
           'genre'        => 'required|min:5',
           'runtime'        => 'required|numeric',
           'rating'        => 'required|numeric|min:1|max:10',
           'review'        => 'required|min:5',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/movies', $image->hashName());

        //create movie
        Movie::create([
           'image'        => $image->hashName(),
           'title'        => $request->title,
           'director'  => $request->director,
           'year'        => $request->year,
           'genre'        => $request->genre,
           'runtime'        => $request->runtime,
           'rating'        => $request->rating,
           'review'        => $request->review,
        ]);
        //redirect to index
        return redirect()->route('movies.index')->with(['success' => 'Movie saved!']);
     }

     public function show(string $id): View {
        // get movie by ID
        $movie = Movie::findOrFail($id);

        // render view with movie
        return view('movies.show', compact('movie'));
     }

     public function edit(string $id): View {

        //get movie by ID
        $movie = Movie::findOrFail($id);

        //render view with movie
        return view('movies.edit', compact('movie'));
     }

     public function update(Request $request, $id): RedirectResponse {
        //validate form
        $request->validate([
           'image'        => 'image|mimes:jpeg,png,jpg|max:4096',
           'title'        => 'required|min:2',
           'director'  => 'required|min:5',
           'year'        => 'required|numeric',
           'genre'        => 'required|min:5',
           'runtime'        => 'required|numeric',
           'rating'        => 'required|numeric|min:1|max:10',
           'review'        => 'required|min:5',
        ]);

        //get movie by id
        $movie = Movie::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {
           //upload new image
           $image = $request->file('image');
           $image->storeAs('public/movies', $image->hashName());

           //delete old image
           Storage::delete('public/movies/' . $request->image);

           //update image with new image
           $movie->update([
              'image'        => $image->hashName(),
              'title'        => $request->title,
              'director'  => $request->director,
              'year'        => $request->year,
              'genre'        => $request->genre,
              'runtime'        => $request->runtime,
              'rating'        => $request->rating,
              'review'        => $request->review,
           ]);
        }
        else {
           $movie->update([
              //update movie without image
              'title'        => $request->title,
              'director'  => $request->director,
              'year'        => $request->year,
              'genre'        => $request->genre,
              'runtime'        => $request->runtime,
              'rating'        => $request->rating,
              'review'        => $request->review,
           ]);
        }

        //redirect to index
        return redirect()->route('movies.index')->with(['success' => 'Movie saved!']);
      }

      public function destroy($id): RedirectResponse {
        // get product by ID
        $movie = Movie::findOrFail($id);

        // delete image
        Storage::delete('public/movies/' . $movie->id);

        //delete movie
        $movie->delete();

        //redirect to index
        return redirect()->route('movies.index')->with(['success' => 'Movie deleted!']);
      }

}
