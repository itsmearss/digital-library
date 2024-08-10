<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBook implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //
        $books = Book::all();
        return view('pages.books.table', compact('books'));
    }
}
