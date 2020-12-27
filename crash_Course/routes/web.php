<?php

use App\Models\User;
use App\Models\Company;
use App\Models\PhoneNum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CustomersController;
use App\Models\Role;

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
    // dd(public_path());
    return view('home');
});

Route::get('/about', function () {
    return view('about');
})->name('about');




Route::get('/contact/create', [ContactUsController::class, 'create'])->name('contact.create');
// Route::get('/contact/create', [ContactUsController::class, 'create'])->middleware('test');

Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');




Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');

Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');

Route::get('/customers/{customer}', [CustomersController::class, 'show'])
    ->name('customers.show')
    ->middleware('can:view,customer');

Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');

Route::patch('/customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');

Route::delete('/customers/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');

Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');



// Route::resource('customers', CustomersController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* ******************************************************************************************** */
/* ******************************************************************************************** */
/* ******************************************************************************************** */
/* ******************************************************************************************** */
/* ******************************************************************************************** */
/* ******************************************************************************************** */
/* ******************************************************************************************** */
/* ******************************************************************************************** */
/* ******************************************************************************************** */

Route::get('/fetch', [App\Http\Controllers\HomeController::class, 'fetch']);

/* ******************************************************************************************** */
/* ********************************  RelationShips  ******************************************* */

Route::get('/userphone', function () {
    # One-To-One

    $user = User::factory()->create();

    /*
    $phonenum = new PhoneNum();
    $phonenum->phone  = '06-776-568-94';

    $user->phonenum()->save($phonenum);
    */

    $user->phonenum()->create([
        'phone' => '06-776-568-94'
    ]);
});


Route::get('/createcustomers', function () {
    # One-To-Many

    $company = Company::factory()->create();


    $company->customers()->create([
        'name' => 'Abbass mido',
        'email' => 'xxx@yyyy.zzz',
        'status' => 1,
    ]);

    $company->customers->first()->name = 'Zalom saho';
    $company->customers->first()->email = 'Shalom@adonay.com';

    $company->push();

    // return $company->customers->first();
});



Route::get('/roles', function () {
    # Many-To-Many (Pivot")

    // User::factory()->create();
    // dd(User::first());
    $user = User::first();

    /*

    Role::create([
        'name' => 'create',
    ]);

    Role::create([
        'name' => 'update',
    ]);

    Role::create([
        'name' => 'delete',
    ]);

    */

    // $roles = Role::all();
    // $user->roles()->attach($roles);
    # Or with Ids
    // $user->roles()->detach([1, 3]);
    # To avoid repetition of rows in the role_user table. use sync
    // $user->roles()->sync([1, 3]);
    // $user->roles()->syncWithoutDetaching([1, 3]);
    // $user->roles()->toggle([1, 3]);

    // $user->roles()->sync([
    //     1 => ['name' => 'Mourad EL CADI'],
    //     2 => ['name' => 'Mourad EL CADI'],
    // ]);

    // $role = Role::first();
    // $user->roles()->detach($role);
    // $role = Role::first();
    // $user->roles()->attach($role);

    # to be able to fetch the pivot '->withPivot()' should be applied to the relationship in the User model
    // dd($user->roles->first()->pivot->name);
    dump($user->roles->first()->pivot);
    dump($user->roles->first());
});