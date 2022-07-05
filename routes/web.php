<?php

use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\ArrayKey;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.welcome');
});


Route::view('contact-me', 'pages.contact', [
    'page_name' => "contact me",
    'page_description' => "this is my page
    "
]);
Route::get('about-me', function () {
    return view('pages.about');
});
Route::get('catogories/{id}/name=/{name}', function ($id,$name) {
    $cats = [
        "1" => "Games",
        "2" => "books",
        "3" => "stars",

    ];
    return view('pages.catogories', [
        "this_id" => $id ?? "this id is not found",
        "this_name" => $cats[$name] ?? "this name is not found"
    ]);
});
