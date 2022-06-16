<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Discount;


class ShopController extends Controller
{   
    //pagination
    const LIMIT_DEFAULT = 5;
    const PAGE_INDEX_DEFAULT = 1;


    protected Book $bookModel;
    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function listingBooks(Request $params)
    {
        //pagination
        $pageIndex = $params['pageIndex'] ?? self::PAGE_INDEX_DEFAULT;

        $limit = $params['limit'] ?? self::LIMIT_DEFAULT;
        $offset = ($pageIndex - 1) * $limit;
        //querry
        $books = $this->bookModel->with('Category')->get();
        $items = $books->slice($offset, $limit);
        return [
            'items' => $items,
            'total' => $books->count(),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
        ];
    }

    public function sortByOnSales(Request $params){
        //pagination
        $pageIndex = $params['pageIndex'] ?? self::PAGE_INDEX_DEFAULT;

        $limit = $params['limit'] ?? self::LIMIT_DEFAULT;
        $offset = ($pageIndex - 1) * $limit;

        $books =$this->bookModel
        ->join('discount','book.id','=','discount.book_id')
        ->select('book.*','discount.*')
        ->orderBy('discount.discount_price','desc')
        ->get();

        $items = $books->slice($offset, $limit);
        
        return [
            'items' => $items,
            'total' => $books->count(),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
        ];
    }

    public function sortByPopularity(){
        
        

    }

    public function sortByLowtoHigh(){
        $book = $this->bookModel->orderBy('book_price','asc')->get();
        return $book;
    }

    public function sortByHightoLow(){
        $book = $this->bookModel->orderBy('book_price','desc')->get();
        return $book;
    }
    
    public function sortByCategoryName(Request $params){
        //pagination
        $pageIndex = $params['pageIndex'] ?? self::PAGE_INDEX_DEFAULT;

        $limit = $params['limit'] ?? self::LIMIT_DEFAULT;
        $offset = ($pageIndex - 1) * $limit;

        $category_name = $params['category_name'];
        $books = $this->bookModel
        ->join('category','book.category_id','=','category.id')
        ->select('book.*','category.category_name')
        ->where('category.category_name','=',$category_name)
        ->get();
         
        $items = $books->slice($offset, $limit);
        
        return [
            'items' => $items,
            'total' => $books->count(),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
        ];

    }

    public function sortByAuthor( Request $params){
        //pagination
        $pageIndex = $params['pageIndex'] ?? self::PAGE_INDEX_DEFAULT;

        $limit = $params['limit'] ?? self::LIMIT_DEFAULT;
        $offset = ($pageIndex - 1) * $limit;

        $author = $params['author'];
        $books = $this->bookModel
        ->join('author','book.author_id','=','author.id')
        ->select('book.*','author.author_name')
        ->where('author.author_name','=',$author)
        ->get();
        
        $items = $books->slice($offset, $limit);
        
        return [
            'items' => $items,
            'total' => $books->count(),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
        ];
    }



    public function sortByRatingReview( Request $params){
        //pagination
        $pageIndex = $params['pageIndex'] ?? self::PAGE_INDEX_DEFAULT;

        $limit = $params['limit'] ?? self::LIMIT_DEFAULT;
        $offset = ($pageIndex - 1) * $limit;

        $books = $this->bookModel
        ->join('review','book.id','=','review.book_id')
        ->select('book.*','review.rating_star')
        ->where('review.rating_star','=',$params['rating_star'])
        ->get();
       
        $items = $books->slice($offset, $limit);
        
        return [
            'items' => $items,
            'total' => $books->count(),
            'pageIndex' => $pageIndex,
            'limit' => $limit,
        ];
    }
        

}
