<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ShopController extends Controller
{   
    //pagination
    const LIMIT_DEFAULT = 12;
    const PAGE_INDEX_DEFAULT = 1;


    protected $bookModel;
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
    

}
