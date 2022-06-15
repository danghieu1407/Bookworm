<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Discount;



use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $bookModel;
    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function getTheMostDiscountBooks()
    {
        //querry select * from book,discount where book.id = discount.book_id order by discount.discount_price desc limit 10
        $postgre = Discount::select('book_id')->from('discount')->orderBy('discount_price','desc')->get();
  
        foreach ($postgre as $key => $value) {
            $book = $this->bookModel->where('id',$value->book_id)->with('Discount')->first();
            $book->discount = $value;
            $books[] = $book;
        }
  
        return  $books;
    }



}
