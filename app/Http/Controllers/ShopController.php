<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ShopController extends Controller
{
    protected $bookModel;
    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function listingBooks()
    {
        dd('hgello');
        $books = $this->bookModel->with('Category')->get();
        
        return $books;
    }
    

}
