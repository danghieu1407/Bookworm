<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', 'HomeController@getTheMostDiscountBooks');
Route::get('books1', 'HomeController@getTheMostReviewBooks');
Route::get('books2', 'HomeController@getTheMostRattingBoooks');

Route::get('shopbooks', 'ShopController@listingBooks');
Route::get('sortByOnSales', 'ShopController@sortByOnSales');
Route::get('sortByLowtoHigh', 'ShopController@sortByLowtoHigh');
Route::get('sortByCategoryName', 'ShopController@sortByCategoryName');
Route::get('sortByAuthor', 'ShopController@sortByAuthor');
Route::get('sortByRatingReview', 'ShopController@sortByRatingReview');












