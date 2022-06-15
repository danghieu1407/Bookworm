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
        $postgre = Discount::select('book_id')->from('discount')->orderBy('discount_price','desc')->get();
  
        foreach ($postgre as $key => $value) {
            $book = $this->bookModel->where('id',$value->book_id)->with('Discount')->first();
            $book->discount = $value;
            $books[] = $book;
        }
  
        return  $books;
    }

    public function getTheMostRattingBoooks(){
        //querry select * from book,review where book.id = review.book_id order by review.rating desc limit 8
    }
    public function getTheMostReviewBooks(){
        //querry select * from book,order_item where book.id = order_item.book_id order by order_item.quantity desc limit 8
        // dd("gekko");
        // $list = $this->bookModel->with('Review')->select('book.*','review.rating')->join('review','book.id','=','review.book_id')->orderBy('review.rating','desc')->limit(8)->get();
     
        // return $list;

    }

}
