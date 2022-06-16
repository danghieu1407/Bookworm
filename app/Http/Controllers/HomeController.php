<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Discount;
use App\Models\Review;


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
        // $postgre = Discount::select('book_id')->from('discount')->orderBy('discount_price','desc')->limit(10)->get();
  
        // foreach ($postgre as $key => $value) {
        //     $book = $this->bookModel->where('id',$value->book_id)->with('Discount')->first();
        //     $book->discount = $value;
        //     $books[] = $book;
        // }

        $books =$this->bookModel
        ->join('discount','book.id','=','discount.book_id')
        ->select('book.*','discount.*')
        ->orderBy('discount.discount_price','desc')
        ->limit(10)
        ->get();
        return  $books;
    }

    public function getTheMostRattingBoooks(){
        //get the most ratting books order by review.ratting desc limit 8
        $books = $this->bookModel
        ->join('review','book.id','=','review.book_id')
        ->select('book.*','review.rating_star')
        ->orderBy('review.rating_star','desc')
        ->limit(8)
        ->get();
        return $books;

    }
    public function getTheMostReviewBooks(){
        // get top 8 books with most reviews - total number review of a book and lowest final price



    }

}
