<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBook implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //
        $user = Auth::user();
        $books = Book::all();

        if (!$user->hasRole('admin')) {
            $books = Book::where('user_id', $user->id)->get();
        }

        return view('pages.books.table', compact('books'));
    }
}
