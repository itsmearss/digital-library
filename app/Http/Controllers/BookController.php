<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Exports\ExportBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        $user = Auth::user();

        $books = Book::with('category');
        $categories = Category::all();

        if (!$user->hasRole('admin')) {
            $books->where('user_id', $user->id);
        }

        if ($category_id) {
            $books->where('category_id', $category_id);
        }

        $books = $books->paginate(10);

        return view('pages.books.index', compact(['books', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('pages.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'amount' => 'required|integer',
            'file' => 'required|file|mimes:pdf|max:20480',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // file upload
        $book = new Book();
        $book->title = $request->title;
        $book->user_id = $request->user_id;
        $book->category_id = $request->category_id;
        $book->description = $request->description;
        $book->amount = $request->amount;

        if ($request->hasFile('file')) {
            if ($book->file) {
                Storage::delete('public/books/' . $book->file);
            }

            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/books', $fileName);
            $book->file = $fileName;
        }

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::delete('public/covers/' . $book->cover);
            }

            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->storeAs('public/covers', $coverName);
            $book->cover = $coverName;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Berhasil menambah buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();

        if (Auth::user()->can('update-own-book') && $book->user_id == Auth::id() || Auth::user()->hasRole('admin')) {
            return view('pages.books.edit', compact(['book', 'categories']));
        } else {
            return redirect()->route('books.index')->with('error', 'Tidak bisa mengubah buku');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // validate
        $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'amount' => 'required|integer',
            'file' => 'nullable|file|mimes:pdf|max:20480',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // file upload
        $book->title = $request->title;
        $book->user_id = $request->user_id;
        $book->category_id = $request->category_id;
        $book->description = $request->description;
        $book->amount = $request->amount;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/books/', $fileName);
            $book->file = $fileName;
        }

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->storeAs('public/covers/', $coverName);
            $book->cover = $coverName;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Berhasil mengubah buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // delete
        if (Auth::user()->can('delete-own-book') && $book->user_id == Auth::id() || Auth::user()->hasRole('admin')) {
            if ($book->file) {
                Storage::delete('public/books/' . $book->file);
            }

            if ($book->cover) {
                Storage::delete('public/covers/' . $book->cover);
            }

            $book->delete();

        } else {
            return redirect()->route('pages.books.index')->with('error', 'Tidak bisa menghapus buku');
        }

        return redirect()->route('books.index')->with('success', 'Berhasil menghapus buku');
    }

    public function export_excel()
    {
        return Excel::download(new ExportBook, 'books.xlsx');
    }

}
