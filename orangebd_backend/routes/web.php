<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategotyController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\isAdminorisAuthor;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 
    Route::group(['middleware' => ['isAdmin']], function () {
    // admin-only routes
        //Users :
    Route::get('/users', [UserController::class, 'view'])->name('users');
    Route::get('/userAdd', [UserController::class, 'addUser'])->name('userAdd');
    Route::post('/usersAdd', [UserController::class, 'postaddUser']);
    Route::get('/userEdit', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/usersEdit', [UserController::class, 'postedit']);

    //Categories :
    Route::get('/categories', [CategotyController::class, 'view'])->name('categories');
    Route::get('/categoryAdd', [CategotyController::class, 'addCategory'])->name('categoryAdd');
    Route::post('/categoriesAdd', [CategotyController::class, 'postaddCategory']);
    Route::get('/categoryDelete/{id}', [CategotyController::class, 'delete'])->name('categoryDelete');
    Route::get('/categoryEdit', [CategotyController::class, 'edit'])->name('categoryEdit');
    Route::post('/categoriesEdit', [CategotyController::class, 'postedit']);

    //POsts :
    Route::get('/postAdd', [PostController::class, 'add'])->name('postAdd');
    Route::post('/postsAdd', [PostController::class, 'postadd']);
    Route::get('/postDelete/{id}', [PostController::class, 'delete'])->name('postDelete');
    Route::get('/postEdit', [PostController::class, 'edit'])->name('postEdit');
    Route::post('/postsEdit', [PostController::class, 'postedit']);
    });
    

    Route::group(['middleware' => ['isAuthor']], function () {
    // author-only routes
    Route::get('/authorposts', [PostController::class, 'authorview'])->name('authorposts');
    Route::get('/authorpostAdd', [PostController::class, 'authoradd'])->name('authorpostAdd');
    Route::post('/authorpostsAdd', [PostController::class, 'authorpostadd']);
    Route::get('/authorpostEdit', [PostController::class, 'authoredit'])->name('authorpostEdit');
    Route::post('/authorpostsEdit', [PostController::class, 'authorpostsedit']); 
    Route::post('/authorpostsFilter', [PostController::class, 'authorpostsfilter']);
    Route::get('/authorpostDetails', [PostController::class, 'authorpostdetails'])->name('authorpostDetails');
    });

    
    Route::group(['middleware' => ['isAdminorisAuthororisUser']], function () {
     // common routes of admin , user , author
        Route::get('/posts', [PostController::class, 'view'])->name('posts');
        Route::get('/postDetails', [PostController::class, 'postdetails'])->name('postDetails');
        Route::post('/postsFilter', [PostController::class, 'postsfilter']);
    });

    // //Posts :
    // Route::get('/posts', [PostController::class, 'view'])->name('posts');
    // Route::get('/postDetails', [PostController::class, 'postdetails'])->name('postDetails');
    // Route::get('/postAdd', [PostController::class, 'add'])->name('postAdd');
    // Route::post('/postsAdd', [PostController::class, 'postadd']);
    // Route::get('/postDelete/{id}', [PostController::class, 'delete'])->name('postDelete');
    // Route::get('/postEdit', [PostController::class, 'edit'])->name('postEdit');
    // Route::post('/postsEdit', [PostController::class, 'postedit']);
    // Route::post('/postsFilter', [PostController::class, 'postsfilter']);
    // Route::get('/authorposts', [PostController::class, 'authorview'])->name('authorposts');
    // Route::get('/authorpostAdd', [PostController::class, 'authoradd'])->name('authorpostAdd');
    // Route::post('/authorpostsAdd', [PostController::class, 'authorpostadd']);
    // Route::get('/authorpostEdit', [PostController::class, 'authoredit'])->name('postEdit');
    // Route::post('/authorpostsEdit', [PostController::class, 'authorpostedit']); 
    // Route::post('/authorpostsFilter', [PostController::class, 'authorpostsfilter']);
    // Route::get('/authorpostDetails', [PostController::class, 'authorpostdetails'])->name('authorpostDetails');
    
});

require __DIR__.'/auth.php';
