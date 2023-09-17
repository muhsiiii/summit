<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminSubjectsController;
use App\Http\Controllers\AdminTopicsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\AdminAffairsController;
use App\Http\Controllers\AdminOthersController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminArticlesController;
use App\Http\Controllers\AdminDownloadsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminGalleryCategoryController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminToppersController;
use App\Http\Controllers\AdminReviewsController;


/***********************************************************************************************************************************/
/************************************************************* USER SIDE **********************************************************/
/***********************************************************************************************************************************/

  /****************************************************** User Home Controls *****************************************************/
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/aboutus', [HomeController::class, 'aboutUs']);
    Route::get('/article/{id}', [HomeController::class, 'article'])->where('id', '[0-9]+');

    Route::get('/courses', [HomeController::class, 'courses']);
    Route::get('/course/{id}', [HomeController::class, 'course'])->where('id', '[0-9]+');

    Route::get('/affairs', [HomeController::class, 'affairs']);
    Route::get('/affair/{id}', [HomeController::class, 'affair'])->where('id', '[0-9]+');

    Route::get('/downloads', [HomeController::class, 'downloads']);
    Route::get('/downloads/{id}', [HomeController::class, 'download'])->where('id', '[0-9]+');
    Route::get('/downloads/files/{id}', [HomeController::class, 'files'])->where('id', '[0-9]+');

    Route::get('/contactus', [HomeController::class, 'contactUs']);
    Route::post('/contactus', [HomeController::class, 'saveContactUs']);

    Route::get('/quiz', [HomeController::class, 'quiz']);
    Route::get('/toppers', [HomeController::class, 'toppers']);
    Route::get('/gallery', [HomeController::class, 'gallery']);
    
    Route::post('/get-in-touch', [HomeController::class, 'getInTouch']);



/***********************************************************************************************************************************/
/************************************************************* ADMIN SIDE **********************************************************/
/***********************************************************************************************************************************/

  /****************************************************** Admin Login Controls *****************************************************/
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/login', [AdminController::class, 'login']);
    Route::post('/admin/login', [AdminController::class, 'check']);
    Route::get('/admin/logout', [AdminController::class, 'logout']);


  /***************************************************** Admin Banners Controls ****************************************************/
    Route::get('/admin/banners', [AdminBannerController::class, 'index']);
    Route::post('/admin/banners/create', [AdminBannerController::class, 'create']);
    Route::post('/admin/banners/update', [AdminBannerController::class, 'update']);
    Route::post('/admin/banners/delete/{id}', [AdminBannerController::class, 'destroy'])->where('id', '[0-9]+');

  /**************************************************** Admin Category Controls ****************************************************/
    Route::get('/admin/category', [AdminCategoryController::class, 'index']);
    Route::post('/admin/category/create', [AdminCategoryController::class, 'create']);
    Route::post('/admin/category/update', [AdminCategoryController::class, 'update']);
    Route::post('/admin/category/delete/{id}', [AdminCategoryController::class, 'destroy'])->where('id', '[0-9]+');

  /**************************************************** Admin Courses Controls *****************************************************/
    Route::resource('/admin/courses', AdminCourseController::class);
    Route::post('/admin/courses/delete/{id}', [AdminCourseController::class, 'destroy'])->where('id', '[0-9]+');

    Route::get('/admin/courses/{id}/highlights', [AdminCourseController::class, 'highlights'])->where('id', '[0-9]+');
    Route::post('/admin/courses/{id}/highlights/create', [AdminCourseController::class, 'createHighlights'])->where('id', '[0-9]+');
    Route::post('/admin/courses/{id}/highlights/update/{hid}', [AdminCourseController::class, 'updateHighlights'])->where('id', '[0-9]+');
    Route::post('/admin/courses/{id}/highlights/delete/{hid}', [AdminCourseController::class, 'destroyHighlights'])->where('id', '[0-9]+');

  /**************************************************** Admin Toppers Controls *****************************************************/
    Route::resource('/admin/toppers', AdminToppersController::class);
    Route::post('/admin/toppers/delete/{id}', [AdminToppersController::class, 'destroy'])->where('id', '[0-9]+');
    Route::post('/admin/toppers/image', [AdminToppersController::class, 'toppersImages'])->name('toppersImages');

  /**************************************************** Admin Reviews Controls *****************************************************/
    Route::resource('/admin/reviews', AdminReviewsController::class);
    Route::post('/admin/reviews/delete/{id}', [AdminReviewsController::class, 'destroy'])->where('id', '[0-9]+');

  /**************************************************** Admin Sujects Controls *****************************************************/
    Route::get('/admin/subjects', [AdminSubjectsController::class, 'index']);
    Route::post('/admin/subjects/create', [AdminSubjectsController::class, 'store']);
    Route::post('/admin/subjects/update', [AdminSubjectsController::class, 'update']);
    Route::post('/admin/subjects/delete/{id}',  [AdminSubjectsController::class, 'destroy'])->where('id', '[0-9]+');

  /****************************************************** Admin Topics Controls ****************************************************/
    Route::get('/admin/topics', [AdminTopicsController::class, 'index']);
    Route::post('/admin/topics/create', [AdminTopicsController::class, 'store']);
    Route::post('/admin/topics/update', [AdminTopicsController::class, 'update']);
    Route::get('/admin/topics/contents/{id}', [AdminTopicsController::class, 'contents'])->where('id', '[0-9]+');
    Route::get('/admin/topics/contents/{id}/create', [AdminTopicsController::class, 'createContents'])->where('id', '[0-9]+');
    Route::post('/admin/topics/delete/{id}',  [AdminTopicsController::class, 'destroy'])->where('id', '[0-9]+');

    Route::post('/admin/topics/contents/{id}/store', [AdminTopicsController::class, 'storeContents'])->where('id', '[0-9]+');
    Route::post('/admin/topics/contents/{id}/update', [AdminTopicsController::class, 'updateContents'])->where('id', '[0-9]+');
    Route::get('/admin/topics/contents/{id}/delete/{did}', [AdminTopicsController::class, 'deleteContents'])->where('id', '[0-9]+');

  /****************************************************** Admin User Controls ******************************************************/
    Route::resource('/admin/users', AdminUserController::class);
    Route::post('/admin/users/change', [AdminUserController::class, 'change']);
    Route::get('/admin/users/assign/{id}', [AdminUserController::class, 'assign'])->where('id', '[0-9]+');
    Route::get('/admin/users/assign/{id}/create', [AdminUserController::class, 'createUserCourse'])->where('id', '[0-9]+');
    Route::post('/admin/users/assign/{id}/save', [AdminUserController::class, 'saveUserCourse'])->where('id', '[0-9]+');
    Route::get('/admin/users/assign/{id}/delete/{did}', [AdminUserController::class, 'deleteUserCourse'])->where('id', '[0-9]+');

  /****************************************************** Admin Customer Controls **************************************************/
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index']);
    Route::post('/admin/notifications/create', [AdminNotificationController::class, 'create']);
    Route::post('/admin/notifications/delete/{id}', [AdminNotificationController::class, 'destroy']);

  /**************************************************** Admin Affairs Controls ****************************************************/
    Route::resource('/admin/affairs', AdminAffairsController::class);
    Route::post('/admin/affairs/delete/{id}', [AdminAffairsController::class, 'destroy'])->where('id', '[0-9]+');

  /**************************************************** Admin Articles Controls ****************************************************/
    Route::resource('/admin/articles', AdminArticlesController::class);
    Route::post('/admin/articles/delete/{id}', [AdminArticlesController::class, 'destroy'])->where('id', '[0-9]+');

  /**************************************************** Admin Downloads Controls ****************************************************/
    Route::get('/admin/downloads', [AdminDownloadsController::class, 'index']);
    Route::get('/admin/downloads/0', [AdminDownloadsController::class, 'index']);
    Route::get('/admin/downloads/create', [AdminDownloadsController::class, 'create']);
    Route::post('/admin/downloads/create', [AdminDownloadsController::class, 'store']);
    Route::get('/admin/downloads/show/{id}', [AdminDownloadsController::class, 'show'])->where('id', '[0-9]+');
    Route::post('/admin/downloads/update/{id}', [AdminDownloadsController::class, 'update'])->where('id', '[0-9]+');
    Route::get('/admin/downloads/delete/{id}', [AdminDownloadsController::class, 'destroy'])->where('id', '[0-9]+');

    Route::get('/admin/downloads/{id}', [AdminDownloadsController::class, 'folder'])->where('id', '[0-9]+');
    Route::get('/admin/downloads/create/{id}', [AdminDownloadsController::class, 'createFolder']);
    Route::post('/admin/downloads/create/{id}', [AdminDownloadsController::class, 'storeFolder']);
    Route::get('/admin/downloads/delete/folder/{id}/{fid}', [AdminDownloadsController::class, 'destroyFolder'])->where('id', '[0-9]+');

    Route::get('/admin/downloads/files/{id}', [AdminDownloadsController::class, 'files'])->where('id', '[0-9]+');
    Route::get('/admin/downloads/files/create/{id}', [AdminDownloadsController::class, 'createFiles'])->where('id', '[0-9]+');
    Route::post('/admin/downloads/files/create/{id}', [AdminDownloadsController::class, 'storeFiles'])->where('id', '[0-9]+');
    Route::get('/admin/downloads/files/delete/{id}/{fid}', [AdminDownloadsController::class, 'destroyFile'])->where('id', '[0-9]+');

  /************************************************ Admin Gallery Category Controls ************************************************/
    Route::get('/admin/gallery/category', [AdminGalleryCategoryController::class, 'index']);
    Route::post('/admin/gallery/category/create', [AdminGalleryCategoryController::class, 'create']);
    Route::post('/admin/gallery/category/update', [AdminGalleryCategoryController::class, 'update']);
    Route::post('/admin/gallery/category/delete/{id}', [AdminGalleryCategoryController::class, 'destroy'])->where('id', '[0-9]+');

  /**************************************************** Admin Gallery Controls *****************************************************/
    Route::get('/admin/gallery', [AdminGalleryController::class, 'index']);
    Route::post('/admin/gallery/create', [AdminGalleryController::class, 'create']);
    Route::post('/admin/gallery/update', [AdminGalleryController::class, 'update']);
    Route::post('/admin/gallery/delete/{id}', [AdminGalleryController::class, 'destroy'])->where('id', '[0-9]+');

  /**************************************************** Admin Others Controls ****************************************************/
    Route::get('/admin/getintouch', [AdminOthersController::class, 'touch']);
    Route::get('/admin/contactus', [AdminOthersController::class, 'contactus']);

  /**************************************************** Admin Settings Controls ****************************************************/
    Route::get('/admin/settings/general', [AdminSettingsController::class, 'general']);
    Route::post('/admin/settings/general', [AdminSettingsController::class, 'saveGeneral']);

    Route::get('/admin/settings/seo', [AdminSettingsController::class, 'seo']);
    Route::post('/admin/settings/seo', [AdminSettingsController::class, 'saveSeo']);


