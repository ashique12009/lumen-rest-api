<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(['status' => 'success', 'message' => $books]);
    }
    
    public function create(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $rules);
        
        $book = new Book;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->cover_image = $request->cover_image;
        $book->pdf = $request->pdf;
        $book->category_id = $request->category_id;
       
        $book->save();
        return response()->json(['status' => 'success', 'message' => 'Successfully book inserted']);
    }

    public function show($id)
    {
        $book = Book::find($id);
        return response()->json(['status' => 'success', 'message' => $book]);
    }
    
    public function update(Request $request, $id)
    { 
        $book = Book::find($id);
        
        $book->title = $request->title;
        $book->description = $request->description;
        $book->cover_image = $request->cover_image;
        $book->pdf = $request->pdf;
        $book->category_id = $request->category_id;
        $book->save();
        return response()->json(['status' => 'success', 'message' => $book]);
    }
    
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json(['status' => 'success', 'message' => 'book removed successfully']);
    }
}
