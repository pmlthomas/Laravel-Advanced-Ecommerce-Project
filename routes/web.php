<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeSliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\frontend\LanguageController;
use App\Http\Controllers\frontend\ReviewController;
use Illuminate\Support\Facades\Route;

//! Admin Routes
Route::middleware(['auth', 'isAdmin'])->group(function(){

    //? Admin Dashboard
        Route::get('/admin/dashboard', [AdminController::class, 'Index'])->name('admin.dashboard');

    //? Admin Profile
    Route::controller(AdminProfileController::class)->group(function(){
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::get('/admin/profile/edit', 'EditProfilePage')->name('admin.profile.edit');
        Route::post('/admin/profile/update', 'UpdateProfile')->name('admin.profile.update');

        Route::get('/admin/password/edit', 'EditPasswordPage')->name('admin.password.edit');
        Route::post('/admin/password/update', 'UpdatePassword')->name('admin.password.update');
    });

    //? Logout
    Route::controller(AdminController::class)->group(function(){
        Route::get('/logout', 'destroy')->name('logout');
    });

    //? Brand
    Route::controller(BrandController::class)->group(function(){
        Route::get('/admin/brand', 'BrandView')->name('admin.brand');
        Route::get('/admin/brand/add', 'AddBrandPage')->name('admin.brand.add');
        Route::post('/admin/brand/store', 'StoreBrand')->name('admin.brand.store');
        Route::get('/admin/brand/delete/{id}', 'DeleteBrand')->name('admin.brand.delete');
    });

    //? Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/category', 'CategoryView')->name('admin.category');
        Route::get('/admin/category/add', 'AddCategoryPage')->name('admin.category.add');
        Route::post('/admin/category/store', 'StoreCategory')->name('admin.category.store');
        Route::get('/admin/category/edit/{id}', 'EditCategoryPage')->name('admin.category.edit');
        Route::post('/admin/category/update', 'UpdateCategory')->name('admin.category.update');
        Route::get('/admin/category/delete/{id}', 'DeleteCategory')->name('admin.category.delete');
    });
    
    //? SubCategory
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/sub-category', 'SubCategoryView')->name('admin.sub_category');
        Route::get('/admin/sub-category/add', 'AddSubCategoryPage')->name('admin.sub_category.add');
        Route::post('/admin/sub-category/store', 'StoreSubCategory')->name('admin.sub_category.store');
        Route::get('/admin/sub-category/edit/{id}', 'EditSubCategoryPage')->name('admin.sub_category.edit');
        Route::post('/admin/sub-category/update', 'UpdateSubCategory')->name('admin.sub_category.update');
        Route::get('/admin/sub-category/delete/{id}', 'DeleteSubCategory')->name('admin.sub_category.delete');
    });

    //? SubSubCategory
    Route::controller(SubSubCategoryController::class)->group(function(){
        Route::get('/admin/sub-sub-category', 'SubSubCategoryView')->name('admin.sub_sub_category');
        Route::get('/admin/sub-sub-category/add', 'AddSubSubCategoryPage')->name('admin.sub_sub_category.add');
        Route::post('/admin/sub-sub-category/store', 'StoreSubSubCategory')->name('admin.sub_sub_category.store');
        Route::get('/admin/sub-sub-category/edit/{id}', 'EditSubSubCategoryPage')->name('admin.sub_sub_category.edit');
        Route::post('/admin/sub-sub-category/update', 'UpdateSubSubCategory')->name('admin.sub_sub_category.update');
        Route::get('/admin/sub-sub-category/delete/{id}', 'DeleteSubSubCategory')->name('admin.sub_sub_category.delete');
    });

    //? Product
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/product', 'ProductView')->name('admin.product');
        Route::get('/admin/product/add', 'AddProductPage')->name('admin.product.add');
        Route::post('/admin/product/store', 'StoreProduct')->name('admin.product.store');
        Route::get('/admin/product/edit/{id}', 'EditProductPage')->name('admin.product.edit');
        Route::post('/admin/product/update', 'UpdateProduct')->name('admin.product.update');
        Route::get('/admin/product/delete/{id}', 'DeleteProduct')->name('admin.product.delete');

        Route::get('admin/multi-image/delete/{id}', 'DeleteMultiImg')->name('admin.multi_img.delete');
        Route::post('admin/multi-image/update/{id}', 'UpdateMultiImg')->name('admin.multi_img.update');
    
        Route::get('admin/product/active/{id}', 'ActivateProduct')->name('admin.product.active');
        Route::get('admin/product/inactive/{id}', 'InactivateProduct')->name('admin.product.inactive');
        
        Route::get('/product/details/{id}', 'ProductDetailsView')->name('product.details');
    });

    //? Home Slider
    Route::controller(HomeSliderController::class)->group(function(){
        Route::get('/admin/sliders', 'SliderView')->name('admin.slider');
        Route::get('/admin/slider/add', 'AddSliderPage')->name('admin.slider.add');
        Route::post('/admin/slider/store', 'StoreSlider')->name('admin.slider.store');
        Route::get('/admin/slider/edit/{id}', 'EditSliderPage')->name('admin.slider.edit');
        Route::post('/admin/slider/update', 'UpdateSlider')->name('admin.slider.update');
        Route::get('/admin/slider/delete/{id}', 'DeleteSlider')->name('admin.slider.delete');

        Route::get('admin/slider/active/{id}', 'ActivateSlider')->name('admin.slider.active');
        Route::get('admin/slider/inactive/{id}', 'InactivateSlider')->name('admin.slider.inactive');
    });
});

//! Frontend Routes
    Route::controller(IndexController::class)->group(function(){
        //? Homepage
        Route::get('/', 'Index')->name('homepage');

        //? Authentication and Profile
        Route::get('/connexion', 'AuthForms')->name('auth.forms');

        Route::get('/mon-compte', 'UserProfile')->name('user.profile');
        Route::get('/mon-compte/modifier', 'EditUserProfilePage')->name('user.profile.edit');
        Route::post('/mon-compte/update', 'UpdateUserProfile')->name('user.profile.update');

        Route::get('/mot-de-passe/modifier', 'EditPasswordPage')->name('user.password.edit');
        Route::post('/mot-de-passe/update', 'UpdatePassword')->name('user.password.update');
    });

    //? Language
    Route::controller(LanguageController::class)->group(function(){
        Route::get('language/french', 'French')->name('language.french');
        Route::get('language/english', 'English')->name('language.english');
    });

    //? Reviews
    Route::controller(ReviewController::class)->group(function(){
        Route::post('/review/store', 'StoreReview')->name('review.store');
    });
    

