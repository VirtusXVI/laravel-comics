<?php

use Illuminate\Support\Facades\Route;

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
    $comics_array = config('comics');
    $data = [
        'comics_array' => $comics_array
    ];
    return view('home', $data);
});

Route::get('/comics-details/{id}', function ($id) {
    $comics_array = config('comics');

    $current_comic = [];
    foreach($comics_array as $comic) {
        if($comic['id'] == $id) {
            $current_comic = $comic;
        }
    }

    // Se non ho trovato il comic con l'id richiesto torno 404
    if(empty($current_comic)) {
        abort('404');
    }

    // Abbiamo trovato il fumetto, passiamo i dettagli alla view
    $data = [
        'current_comic' => $current_comic
    ];

    return view('comic', $data);
})->name('comic');