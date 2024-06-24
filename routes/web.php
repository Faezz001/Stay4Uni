<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//User Frontend
Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');

    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');


     // User WishlistAll Route
    Route::controller(WishlistController::class)->group(function(){

    Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
    Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
    Route::get('/get-wishlist-property', 'GetWishlistProperty');
    Route::get('/get-wishlist-property', 'GetWishlistProperty');
    Route::get('/wishlist-remove/{id}', 'WishlistRemove');


});
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

});

Route::middleware(['auth','role:agent'])->group(function(){

    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');

    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');

    Route::post('/agent/profile/store', [AgentController::class, 'AgentProfileStore'])->name('agent.profile.store');

    Route::get('/agent/change/password', [AgentController::class, 'AgentChangePassword'])->name('agent.change.password');

    Route::post('/agent/update/password', [AgentController::class, 'AgentUpdatePassword'])->name('agent.update.password');
});

Route::post('/user/register', [UserController::class, 'UserRegister'])->name('user.register');

Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);

Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth','role:admin'])->group(function(){

    Route::controller(PropertyTypeController::class)->group(function(){

        Route::get('/all/type', 'AllType')->name('all.type');
        Route::get('/add/type', 'AddType')->name('add.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });

    Route::controller(PropertyTypeController::class)->group(function(){

        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
        Route::get('/add/amenities', 'AddAmenities')->name('add.amenities');
        Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}', 'EditAmenities')->name('edit.amenities');
        Route::post('/update/amenities', 'UpdateAmenities')->name('update.amenities');
        Route::get('/delete/amenities/{id}', 'DeleteAmenities')->name('delete.amenities');
    });

    Route::controller(PropertyController::class)->group(function(){

        Route::get('/all/property', 'AllProperty')->name('all.property');
        Route::get('/add/property', 'AddProperty')->name('add.property');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/update/property/multiimage', 'UpdatePropertyMultiimage')->name('update.property.multiimage');
        Route::get('/property/multiimg/delete/{id}', 'PropertyMultiImageDelete')->name('property.multiimg.delete');
        Route::post('/store/new/multiimage', 'StoreNewMultiimage')->name('store.new.multiimage');
        Route::post('/update/property/facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
        Route::get('/admin/property/complaint/', 'AdminPropertyComplaint')->name('admin.property.complaint');
   });

 // Agent All Route from admin
 Route::controller(AdminController::class)->group(function(){

    Route::get('/all/agent', 'AllAgent')->name('all.agent');
    Route::get('/edit/agent/{id}', 'EditAgent')->name('edit.agent');
    Route::post('/update/agent', 'UpdateAgent')->name('update.agent');
    Route::get('/delete/agent/{id}', 'DeleteAgent')->name('delete.agent');
    Route::get('/changeStatus', 'changeStatus');

});

});

Route::controller(AdminController::class)->group(function(){

    Route::get('/all/user', 'AllUser')->name('all.user');
    Route::get('/edit/user/{id}', 'EditUser')->name('edit.user');
    Route::post('/update/user', 'UpdateUser')->name('update.user');
    Route::get('/delete/user/{id}', 'DeleteUser')->name('delete.user');

});


 /// Agent Group Middleware
 Route::middleware(['auth','role:agent'])->group(function(){

    // Agent All Property
Route::controller(AgentPropertyController::class)->group(function(){

   Route::get('/agent/all/property', 'AgentAllProperty')->name('agent.all.property');
   Route::get('/agent/all/property', 'AgentAllProperty')->name('agent.all.property');
   Route::get('/agent/add/property', 'AgentAddProperty')->name('agent.add.property');
   Route::post('/agent/store/property', 'AgentStoreProperty')->name('agent.store.property');
   Route::get('/agent/edit/property/{id}', 'AgentEditProperty')->name('agent.edit.property');
    Route::post('/agent/update/property', 'AgentUpdateProperty')->name('agent.update.property');
    Route::post('/agent/update/property/thumbnail', 'AgentUpdatePropertyThumbnail')->name('agent.update.property.thumbnail');
    Route::post('/agent/update/property/multiimage', 'AgentUpdatePropertyMultiimage')->name('agent.update.property.multiimage');
    Route::get('/agent/property/multiimg/delete/{id}', 'AgentPropertyMultiimgDelete')->name('agent.property.multiimg.delete');
    Route::get('/agent/delete/property/{id}', 'AgentDeleteProperty')->name('agent.delete.property');
    Route::post('/agent/update/property/facilities', 'AgentUpdatePropertyFacilities')->name('agent.update.property.facilities');
    Route::post('/agent/store/new/multiimage', 'AgentStoreNewMultiimage')->name('agent.store.new.multiimage');

});

// Frontend Property Details All Route

});

// Frontend Property Details All Route
Route::get('/property/details/{id}/{slug}', [IndexController::class, 'PropertyDetails']);

// Wishlist Add Route
  Route::post('/add-to-wishList/{property_id}', [WishlistController::class, 'AddToWishList']);

// Agent Details Page in Frontend
Route::get('/agent/details/{id}', [IndexController::class, 'AgentDetails'])->name('agent.details');

// Get Listing Property
Route::get('/listing/property', [IndexController::class, 'ListingProperty'])->name('listing.property');

// All Property Seach Option
Route::post('/property/search', [IndexController::class, 'search'])->name('all.property.search');

 // Send Complaint Form from Property Details Page
 Route::post('/property/complaint-form', [IndexController::class, 'ComplaintForm'])->name('property.complaint');





