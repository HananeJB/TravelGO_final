<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PhotosController;

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


Auth::routes();

/** Frontend **/
    Route::get('/', function () {return redirect('/home');});
    Route::get('/home', [HomeController::class,"index"])->name('home');
    Route::get('/activities', [HomeController::class,"offers"]);
    Route::get('/activities/{city}', [HomeController::class,"offerscity"]);
    Route::get('/details/{id}', [HomeController::class,"showDetail"]);
    Route::get('/adventures', [HomeController::class,"adventure"]);
    Route::post('/send-message',[HomeController::class,"sendEmail"])->name('contact.send');
    Route::post('/addtolist',[HomeController::class,"addtolist"])->name('addtolist');
    Route::get('/payments/{id}', [BookingController::class,"showDetail"]);

    /** Contact **/
    Route::get("/contact", [MailerController::class, "contact"])->name("email");
    Route::post("/send-email", [MailerController::class, "composeEmail"])->name("send-email");

    /** Blog **/
    Route::get('/blog', [HomeController::class, 'BlogList']);
    Route::get('/blog/{id}', [HomeController::class, 'BlogSingle']);

    /** Others **/
    Route::get('/terms_and_conditions', [HomeController::class,"terms"]);
    Route::get('/about', [HomeController::class,"about"]);


/** Admin - Space **/
    /**
     * /admin -> Dashboard
     * /admin/users -> Usertable
     * /admin/profile -> profile      here we should update and edit
     * /admin/bookings -> bookings      here we should update and edit and delete
     * /admin/listing/ * -> ressources (cites, hotels, restaurants, activities)
     *
     *  Tools
     * /admin/tools/picture -> store picture
     * /admin/tools/picture/(picture-id) -> delete picture by id
     * /admin/tools/day -> store a day
     * /admin/tools/day/(day-id) -> delete day by id

    **/
Route::group(['middleware' => 'admin',], function () {

    Route::get('/admin', [AdminController::class,"dashboard"])->name('adminspace.route');
    Route::get('/admin/users', [AdminController::class,"users"]);
    Route::get('/admin/profile', [AdminController::class,"profile"]);
    Route::resource('/admin/activities', ActivityController::class);
    Route::resource('/admin/bookings', BookingController::class);
    //Route::resource('/admin/hotels', HotelsController::class);   CREATE NEW CONTROLLER
    //Route::resource('/admin/'restaurants', HotelsController::class);   CREATE NEW CONTROLLER
    Route::resource('/admin/cities', CityController::class);
    Route::resource('/admin/post', PostController::class);


    Route::post('/admin/day/store', [DayController::class,"store"])->name('day.add');
    Route::delete('/admin/day/{day}', [DayController::class,"destroy"])->name('days.destroy');

    Route::post('/admin/photos/store',[PhotosController::class,"store"])->name('photos/store');
    Route::delete('/admin/image/{image}',[PhotosController::class,'destroy'])->name('images.destroy');

    // doublons
    Route::put('/admin/update/{id}',[ActivityController::class,'update']);
});

/** User - Space **/ //CREATED NEW CONTROLLER FOR THIS SPACE
Route::group(['middleware' => 'auth',], function () {
    Route::get('/myaccount', [UserController::class,"dashboard"])->name('userspace.route'); /**->middleware('admin');**/
    Route::get('/myaccount/profile', [UserController::class,"profile"]);
    Route::get('/myaccount/bookings', [UserController::class,"reservations"]);
});

/** AdminController **/
/**
Route::get('/admin', [AdminController::class,"handleAdmin"])->name('admin.route')->middleware('admin');
Route::get('/users', [AdminController::class,"users"])->middleware('admin');
Route::post('/users/store', [DayController::class,"store"])->name('users.add');
Route::post('/day/store', [DayController::class,"store"])->name('day.add');
Route::delete('/day/{day}', [DayController::class,"destroy"])->name('days.destroy');
Route::delete('/user/{user}', [DayController::class,"destroy"])->name('users.destroy');
Route::post('/photos/store',[PhotosController::class,"store"])->name('photos/store');
Route::delete('/image/{image}',[PhotosController::class,'destroy'])->name('images.destroy');
Route::put('/update/{id}',[ActivityController::class,'update']);
Route::get('/profil', [AdminController::class,"profileadmin"])->middleware('admin');

//Route::resource('/admin/activities', [AdminController::class,"activities"]);
//Route::resource('/admin/users', [AdminController::class,"users"]);
//Route::resource('/admin/bookings', [AdminController::class,"bookings"]);
 **/

/** Resources
Route::resource('/activities', ActivityController::class)->middleware('admin');
Route::resource('/bookings', BookingController::class);
Route::resource('/cities', CityController::class);
**/


