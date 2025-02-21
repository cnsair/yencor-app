<?php

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardRendererController;
use App\Http\Controllers\Admin\AdminDashboardRendererController;
use App\Http\Controllers\Rider\RiderController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\VehicleController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestMessageController;
use App\Http\Controllers\TestimonialController;



//=======================================
//Guest/Homepage Routes
//=======================================

Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return view('home.home');
    })->name('home');

    Route::get('/about', function () {
        return view('home.about');
    })->name('about');

    Route::get('/blog', function () {
        return view('home.blog');
    })->name('blog');

    Route::get('/service', function () {
        return view('home.service');
    })->name('service');

    Route::get('/vehicle', function () {
        return view('home.vehicle');
    })->name('vehicle');

    Route::get('/package', function () {
        return view('home.package');
    })->name('package');

    Route::get('/contact-us', function () {
        return view('home.contact-us');
    })->name('contact');

    Route::get('/book-ride', function () {
        return view('home.book-ride');
    })->name('book-ride');

    Route::get('/testimonial-page', function () {
        return view('home.testimonial-page');
    })->name('testimonial');

    //Gerard
    Route::get('/add-testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::post('/add-testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
    // Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');

    Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');

});



//===================================================
//      AUTHENTICATION REDIRECTS
//==================================================

Route::group(['middleware' => 'auth'], function() {

    //Main Redirect Controller
    // Route::resource('redirects', RedirectController::class, 
    // ['only' => 'index']);
    
    Route::get('redirects', [RedirectController::class, 'index'])
    ->name('user.redirect');
   
    Route::group(['middleware' => 'rider'], function() {
        Route::prefix('rider')->group(function () {
            Route::name('rider.')->group(function () {

                //view analytics page
                Route::get('/dashboard', function () {
                    return view('rider.dashboard'); })
                    ->name('dashboard');

                //dashboard:view
                Route::get('/edit-profile', function () {
                    return view('rider.edit-profile'); })
                    ->name('edit-profile.edit');

                //view upload page
                Route::patch('/edit-profile', [ProfileController::class, 'update'])
                    ->name('edit-profile.update');

                //change password:view
                Route::get('/change-password', function () {
                    return view('rider.change-password'); })
                    ->name('change-password.edit');

                //update password page
                Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
                    ->name('change-password.update');

            });
        });
    });


    Route::group(['middleware' => 'driver'], function() {
      
        Route::prefix('driver')->group(function () {
            Route::name('driver.')->group(function () {

                //dashboard:view
                Route::get('/dashboard', [VehicleController::class, 'showAll'])
                    ->name('dashboard');

                // Edit Profile
                Route::get('/edit-profile', function () {
                    return view('driver.edit-profile'); })
                    ->name('edit-profile.edit');

                //view upload page
                Route::patch('/edit-profile', [ProfileController::class, 'update'])
                    ->name('edit-profile.update');

                //change password:view
                Route::get('/change-password', function () {
                    return view('driver.change-password'); })
                    ->name('change-password.edit');

                //update password page
                Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
                    ->name('change-password.update');
                
                //Register vehicle
                Route::get('/register-vehicle', [VehicleController::class, 'create'])
                    ->name('register-vehicle.create');
                
                //Delete vehicle record
                Route::delete('/dashboard/{vehicle}', [VehicleController::class, 'destroy'])
                    ->name('vehicle.destroy');

            });
        });
    });


    Route::group(['middleware' => 'admin'], function() {
        Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {

                Route::get('/dashboard', [AdminDashboardRendererController::class, 'dashboardRenderer'])
                    ->name('dashboard');

                    // Edit Profile
                Route::get('/edit-profile', function () {
                    return view('admin.edit-profile'); })
                    ->name('edit-profile.edit');
    
                //view upload page
                Route::patch('/edit-profile', [ProfileController::class, 'update'])
                    ->name('edit-profile.update');

                //change password:view
                Route::get('/change-password', function () {
                    return view('admin.change-password'); })
                    ->name('change-password.edit');

                //update password page
                Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
                    ->name('change-password.update');

            });
        });
    });


});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        // return view('redirects');
        return redirect()->route('user.redirect');
        // abort(403, 'Unauthorised action!');
    })->name('dashboard');

});

// Routes for guest messages
Route::get('/contact-us', function () {
    return view('home.contact-us');
})->name('home.contact');

Route::post('/contact-us', [GuestMessageController::class, 'store'])->name('contact-us.store');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/testimonials', [TestimonialController::class, 'adminIndex'])->name('admin.testimonials');
    Route::post('/admin/testimonials/{id}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::post('/admin/testimonials/{id}/reject', [TestimonialController::class, 'reject'])->name('testimonials.reject');
});

// Routes for admin to view messages
Route::middleware('auth')->group(function () {
    Route::get('/admin/guest-messages', [GuestMessageController::class, 'index'])->name('admin.guest-messages');
});

