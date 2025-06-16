<?php

use App\Http\Controllers\Admin\AdminDashboardRendererController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\VehicleVerificationController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\GuestMessageController;
use App\Http\Controllers\HomeRendererController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\TeamRendererController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

//=======================================
// Guest/Homepage Routes
//=======================================
Route::middleware('guest')->group(function () {
    Route::get('/', [HomeRendererController::class, 'index'])->name('home');
    Route::get('/about', [TeamRendererController::class, 'index'])->name('about');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
    
    Route::get('/service', function () {
        return view('home.service');
    })->name('service');
    
    Route::get('/vehicle', function () {
        return view('home.vehicle');
    })->name('vehicle');
    
    Route::get('/package', function () {
        return view('home.package');
    })->name('package');
    
    Route::get('/book-ride', function () {
        return view('home.book-ride');
    })->name('book-ride');
    
    Route::get('/buy-yencoin', function () {
        return view('home.buy-yencoin');
    })->name('buy-yencoin');
    
    Route::get('/contact-us', [GuestMessageController::class, 'create'])->name('contact');
    Route::post('/contact-us', [GuestMessageController::class, 'store'])->name('contact.store');
    
    Route::get('/testimonial', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
});

//===================================================
// Authenticated Routes
//===================================================
Route::middleware(['auth', 'audit-trail'])->group(function() {
    // Main Redirect Controller
    Route::get('redirects', [RedirectController::class, 'index'])->name('user.redirect');

    //========================================================
    // Rider Routes
    //========================================================
    Route::middleware(['check.role:rider'])->prefix('rider')->name('rider.')->group(function () {
        Route::get('/dashboard', function () {
            return view('rider.dashboard');
        })->name('dashboard');

        Route::get('/edit-profile', function () {
            return view('rider.edit-profile');
        })->name('edit-profile.edit');
        
        Route::patch('/edit-profile', [ProfileController::class, 'update'])
            ->name('edit-profile.update');

        Route::get('/change-password', function () {
            return view('rider.change-password');
        })->name('change-password.edit');
        
        Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
            ->name('change-password.update');
    });

    //========================================================
    // Driver Routes
    //========================================================
    Route::middleware(['check.role:driver'])->prefix('driver')->name('driver.')->group(function () {
        Route::get('/dashboard', [VehicleController::class, 'index'])->name('dashboard');

        Route::get('/edit-profile', function () {
            return view('driver.edit-profile');
        })->name('edit-profile.edit');
        
        Route::patch('/edit-profile', [ProfileController::class, 'update'])
            ->name('edit-profile.update');

        Route::get('/change-password', function () {
            return view('driver.change-password');
        })->name('change-password.edit');
        
        Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
            ->name('change-password.update');
        
        Route::get('/register-vehicle', [VehicleController::class, 'create'])
            ->name('register-vehicle.create');
        
        Route::delete('/dashboard/{vehicle}', [VehicleController::class, 'destroy'])
            ->name('vehicle.destroy');
    });

    //========================================================
    // Admin Routes
    //========================================================
    Route::middleware(['check.role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardRendererController::class, 'dashboardRenderer'])
            ->name('dashboard');

        // Profile
        Route::get('/edit-profile', function () {
            return view('admin.edit-profile');
        })->name('edit-profile.edit');
        
        Route::patch('/edit-profile', [ProfileController::class, 'update'])
            ->name('edit-profile.update');

        // Password
        Route::get('/change-password', function () {
            return view('admin.change-password');
        })->name('change-password.edit');
        
        Route::patch('/change-password', [ChangePasswordController::class, 'updatePassword'])
            ->name('change-password.update');

        // Audit Trail
        Route::get('/audit-trail', [AuditTrailController::class, 'index'])
            ->name('audit-trail.index');

        // Guest Messages
        Route::get('/guest-msg', [GuestMessageController::class, 'index'])
            ->name('guest-msg.index');
        
        Route::get('/{message}/read-guest-msg', [GuestMessageController::class, 'show'])
            ->name('guest-msg.show');
        
        Route::delete('/{message}/guest-msg', [GuestMessageController::class, 'destroy'])
            ->name('guest-msg.destroy');
        
        Route::put('/guest-msg/{message}/toggle', [GuestMessageController::class, 'toggleRead'])
            ->name('guest-msg.toggle');

        // Users
        Route::post('/users/{id}/update-status', [UserController::class, 'updateStatus'])
            ->name('users.update-status');

        // Testimonials
        Route::get('/testimonial', [TestimonialController::class, 'adminIndex'])
            ->name('testimonial');
        
        Route::get('/{testimonial}/read-testimony', [TestimonialController::class, 'show'])
            ->name('testimonial.show');
        
        Route::put('/{testimonial}/toggle', [TestimonialController::class, 'toggleApprove'])
            ->name('testimonial.toggle');
        
        Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])
            ->name('testimonial.destroy');

        // Blog
        Route::get('/blogs', [BlogController::class, 'adminIndex'])
            ->name('blogs');
        
        Route::get('/create-blog', [BlogController::class, 'create'])
            ->name('create-blog');
        
        Route::post('/blogs', [BlogController::class, 'store'])
            ->name('blogs.store');
        
        Route::get('/blogs/{id}', [BlogController::class, 'showAdmin'])
            ->name('blogs.show');
        
        Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])
            ->name('blog-edit');
        
        Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])
            ->name('blogs.destroy');
        
        Route::put('/blogs/{id}', [BlogController::class, 'update'])
            ->name('blogs.update');

        // Vehicle Verifications
        Route::prefix('vehicle-verifications')->name('admin.vehicle-verifications.')->group(function () {
            Route::get('/', [VehicleVerificationController::class, 'index'])
                ->name('index');
            
            Route::get('/{vehicle}/documents/{document}', [VehicleVerificationController::class, 'viewDocument'])
                ->name('view-document')
                ->where('document', 'vehicle_photo|insurance_document|registration_document');
            
            Route::get('/{vehicle}', [VehicleVerificationController::class, 'show'])
                ->name('show');
            
            Route::patch('/{vehicle}/approve', [VehicleVerificationController::class, 'approve'])
                ->name('approve');
            
            Route::patch('/{vehicle}/reject', [VehicleVerificationController::class, 'reject'])
                ->name('reject');
            
            Route::patch('/{vehicle}/request-changes', [VehicleVerificationController::class, 'requestChanges'])
                ->name('request-changes');
        });
    });
});

// Jetstream/Fortify Verified Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('user.redirect');
    })->name('dashboard');
});