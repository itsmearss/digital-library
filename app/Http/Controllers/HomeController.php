<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $books = Book::all();
        $categories = Category::all();

        $admin_count = User::role('admin')->count();
        $user_count = User::role('user')->count();
        $book_count = $books->count();
        $your_book_count = $books->where('user_id', auth()->user()->id)->count();
        $category_count = $categories->count();

        return view('pages.dashboard.dashboard', [
            'type_menu' => 'dashboard',
            'admin_count' => $admin_count,
            'user_count' => $user_count,
            'book_count' => $book_count,
            'your_book_count' => $your_book_count,
            'category_count' => $category_count
        ]);
    }

    public function home(Request $request)
    {
        $category_id = $request->input('category_id');
        $title = $request->input('title');

        $books = Book::with('category', 'user');
        $categories = Category::all();

        if ($title) {
            $books->where('title', 'like', '%' . $title . '%');
        }

        if ($category_id) {
            $books->where('category_id', $category_id);
        }

        $books = $books->paginate(6);

        return view('pages.landingpage.books', compact(['books', 'categories']));
    }
}
