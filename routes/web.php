<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\mainMenuController;
use App\Http\Controllers\guestController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\adminGuestController;

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

// Route::get('/', function () {
//     return view('Frontend.Layouts.home');
// });

Route::get('/',[homeController::class,'index']);

Route::get('/latest',[homeController::class,'latest']);


Route::get('/news_detail/{id}',[homeController::class,'news_single']);


Route::get('/menu_news/{id}',[homeController::class,'menu_news']);
Route::get('/sub_menu_news/{id}',[homeController::class,'sub_menu_news']);
Route::get('/categorey_news/{id}',[homeController::class,'categorey_news']);
Route::get('/view_photo/{id}',[homeController::class,'view_photo']);
Route::get('/about_us',[homeController::class,'about_us']);
Route::get('/privacy_policy',[homeController::class,'privacy_policy']);

Route::get('/guestLogin',[guestController::class,'index']);
Route::get('/guestRegister',[guestController::class,'register']);
Route::post('/guestStore',[guestController::class,'guestStore']);
Route::post('/guestLoginAttempt',[guestController::class,'guestLoginAttempt']);
Route::post('/guestEdit/{id}',[guestController::class,'guestEdit']);

Route::get('guestLogout',[guestController::class,'logout']);

Route::get('/edit_profile',[guestController::class,'edit_profile']);
Route::get('/pass_reset',[guestController::class,'pass_reset']);
Route::post('/passwordReset/{id}',[guestController::class,'passwordReset']);
Route::get('/addToFav/{news_id}/{guest_id}',[guestController::class,'addToFav']);
Route::get('/removeFromFav/{news_id}/{guest_id}',[guestController::class,'removeFromFav']);
Route::get('/my_comments/{id}',[guestController::class,'my_comments']);
Route::get('/favourite_news/{id}',[guestController::class,'favourite_news']);

Route::get('guestDashboard',[guestController::class,'guestDashboard'])->middleware('guests');



Route::post('/getHomeDistrict',[homeController::class,'getHomeDistrict']);
Route::post('/getHomeUpzaila',[homeController::class,'getHomeUpzaila']);
Route::post('/filter_news',[homeController::class,'filter_news']);

//comment araea
Route::post('/postComment',[commentController::class,'store']);
Route::post('/getComment',[commentController::class,'getComment']);
Route::get('/delete_comment/{id}',[commentController::class,'delete_comment']);
Route::post('/countComment',[commentController::class,'countComment']);

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\BackendController::class, 'index'])->name('dashboard');

// main menu
Route::get('/addMainMenu', [App\Http\Controllers\mainMenuController::class, 'index']);
Route::post('/mainMenuStore', [App\Http\Controllers\mainMenuController::class, 'store']);
Route::get('/viewMainMenu', [App\Http\Controllers\mainMenuController::class, 'view']);
Route::get('/editMainMenu/{id}', [App\Http\Controllers\mainMenuController::class, 'edit']);
Route::post('/mainMenuUpdate/{id}', [App\Http\Controllers\mainMenuController::class, 'update']);
Route::get('/deleteMainMenu/{id}', [App\Http\Controllers\mainMenuController::class, 'delete']);

// sub_menu
Route::get('/addSubMenu', [App\Http\Controllers\subMenuController::class, 'index']);
Route::post('/subMenuStore', [App\Http\Controllers\subMenuController::class, 'store']);
Route::get('/viewSubMenu', [App\Http\Controllers\subMenuController::class, 'view']);
Route::get('/editSubMenu/{id}', [App\Http\Controllers\subMenuController::class, 'edit']);
Route::post('/subMenuUpdate/{id}', [App\Http\Controllers\subMenuController::class, 'update']);
Route::get('/deleteSubMenu/{id}', [App\Http\Controllers\subMenuController::class, 'delete']);

// admin info
Route::get('/createAdmin',[App\Http\Controllers\adminController::class, 'index']);
Route::post('/registerAdmin',[App\Http\Controllers\adminController::class, 'store']);
Route::get('/viewAdmin',[App\Http\Controllers\adminController::class, 'view']);
Route::get('/editAdmin/{id}',[App\Http\Controllers\adminController::class, 'edit']);
Route::post('/updateAdmin/{id}',[App\Http\Controllers\adminController::class, 'update']);
Route::get('/deleteAdmin/{id}',[App\Http\Controllers\adminController::class, 'delete']);


// news cat
Route::get('/addNewsCat',[App\Http\Controllers\newsCat::class, 'index']);
Route::post('/newsCatStore',[App\Http\Controllers\newsCat::class, 'store']);
Route::get('/viewNewsCat',[App\Http\Controllers\newsCat::class, 'view']);
Route::get('/editNewsCat/{id}',[App\Http\Controllers\newsCat::class, 'edit']);
Route::post('/newsCatUpdate/{id}',[App\Http\Controllers\newsCat::class, 'update']);
Route::get('/deleteNewsCat/{id}',[App\Http\Controllers\newsCat::class, 'delete']);


// home_pagemenu
Route::get('/addHomeMain',[App\Http\Controllers\newsMenu::class, 'index']);
Route::post('/newsMenuStore',[App\Http\Controllers\newsMenu::class, 'store']);
Route::get('/viewNewsMenu',[App\Http\Controllers\newsMenu::class, 'view']);
Route::get('/editNewsMenu/{id}',[App\Http\Controllers\newsMenu::class, 'edit']);
Route::post('/newsMenuUpdate/{id}',[App\Http\Controllers\newsMenu::class, 'update']);
Route::get('/delteNewsMenu/{id}',[App\Http\Controllers\newsMenu::class, 'delete']);



Route::get('/addNewsSubmenu',[App\Http\Controllers\newsSubMenu::class, 'index']);
Route::post('/newsSubmenuStore',[App\Http\Controllers\newsSubMenu::class, 'store']);
Route::get('/viewnewsSubmenu',[App\Http\Controllers\newsSubMenu::class, 'view']);
Route::get('/editNewsSubmenu/{id}',[App\Http\Controllers\newsSubMenu::class, 'edit']);
Route::post('/newsSubmenuUpdate/{id}',[App\Http\Controllers\newsSubMenu::class, 'update']);
Route::get('/deleteNewsSubmenu/{id}',[App\Http\Controllers\newsSubMenu::class, 'delete']);

//country information
Route::get('/addCountry',[App\Http\Controllers\countryController::class, 'index']);
Route::post('/countryStore',[App\Http\Controllers\countryController::class, 'store']);
Route::get('/viewCountry',[App\Http\Controllers\countryController::class, 'view']);
Route::get('/editCountry/{id}',[App\Http\Controllers\countryController::class, 'edit']);
Route::post('/countryUpdate/{id}',[App\Http\Controllers\countryController::class, 'update']);
Route::get('/deleteCountry/{id}',[App\Http\Controllers\countryController::class, 'delete']);

//divsion information
Route::get('/addDivision',[App\Http\Controllers\divisionController::class, 'index']);
Route::post('/divisonStore',[App\Http\Controllers\divisionController::class, 'store']);
Route::get('/viewDivision',[App\Http\Controllers\divisionController::class, 'view']);
Route::get('/editDivision/{id}',[App\Http\Controllers\divisionController::class, 'edit']);
Route::post('/divisonUpdate/{id}',[App\Http\Controllers\divisionController::class, 'update']);
Route::get('/deleteDivision/{id}',[App\Http\Controllers\divisionController::class, 'delete']);

//district informaiton
Route::get('/addDistrict',[App\Http\Controllers\districtController::class, 'index']);
Route::post('/getDivision',[App\Http\Controllers\districtController::class, 'getDivision']);
Route::post('/districtStore',[App\Http\Controllers\districtController::class, 'store']);
Route::get('/viewDistrict',[App\Http\Controllers\districtController::class, 'view']);
Route::get('/editDistrict/{id}',[App\Http\Controllers\districtController::class, 'edit']);
Route::post('/districtUpdate/{id}',[App\Http\Controllers\districtController::class, 'update']);
Route::get('/deleteDistrict/{id}',[App\Http\Controllers\districtController::class, 'delete']);


//upazila information
Route::get('/addUpazila',[App\Http\Controllers\upazilaController::class, 'index']);
Route::post('/getDistrict',[App\Http\Controllers\upazilaController::class, 'getDistrict']);
Route::post('/upazilaStore',[App\Http\Controllers\upazilaController::class, 'store']);
Route::get('/viewUpazila',[App\Http\Controllers\upazilaController::class, 'view']);
Route::get('/editUpazila/{id}',[App\Http\Controllers\upazilaController::class, 'edit']);
Route::post('/upazilaUpdate/{id}',[App\Http\Controllers\upazilaController::class, 'update']);
Route::get('/deleteUpazila/{id}',[App\Http\Controllers\upazilaController::class, 'delete']);

//publish news
Route::get('/publishNews',[App\Http\Controllers\newsController::class, 'index']);
Route::post('/loadPubDistrict',[App\Http\Controllers\newsController::class, 'loadPubDistrict']);
Route::post('/loadPubUpazila',[App\Http\Controllers\newsController::class, 'loadPubUpazila']);
Route::post('/loadSubMenu',[App\Http\Controllers\newsController::class, 'loadSubMenu']);
Route::post('/newsStore',[App\Http\Controllers\newsController::class, 'store']);
Route::get('/viewNews',[App\Http\Controllers\newsController::class, 'view']);
Route::get('/editNews/{id}',[App\Http\Controllers\newsController::class, 'edit']);
Route::post('/newsUpdate/{id}',[App\Http\Controllers\newsController::class, 'update']);
Route::get('/deleteNews/{id}',[App\Http\Controllers\newsController::class, 'delete']);
Route::post('/filterNews',[App\Http\Controllers\newsController::class, 'filterNews']);

//image_info
Route::get('/addImage',[App\Http\Controllers\imageUploadController::class, 'index']);
Route::post('/uploadCurrentImage',[App\Http\Controllers\imageUploadController::class, 'uploadCurrentImage']);
Route::post('/loadCurrentImage',[App\Http\Controllers\imageUploadController::class, 'loadCurrentImage']);
Route::post('/deleteCurrentImage',[App\Http\Controllers\imageUploadController::class, 'deleteCurrentImage']);
Route::post('/imageStore',[App\Http\Controllers\imageUploadController::class, 'store']);
Route::get('/viewImage',[App\Http\Controllers\imageUploadController::class, 'view']);
Route::get('/editImage/{id}',[App\Http\Controllers\imageUploadController::class, 'edit']);
Route::post('/imageUpdate/{id}',[App\Http\Controllers\imageUploadController::class, 'update']);
Route::get('/deleteImage/{id}',[App\Http\Controllers\imageUploadController::class, 'delete']);


// vedio controller
Route::get('/addVedio',[App\Http\Controllers\vedioController::class, 'index']);
Route::post('/vedioStore',[App\Http\Controllers\vedioController::class, 'store']);
Route::get('/viewVedio',[App\Http\Controllers\vedioController::class, 'view']);
Route::get('/editVedio/{id}',[App\Http\Controllers\vedioController::class, 'edit']);
Route::post('/vedioUpdate/{id}',[App\Http\Controllers\vedioController::class, 'update']);

// settings
Route::get('/settings',[App\Http\Controllers\settingsController::class, 'index']);
Route::post('/settingsStore',[App\Http\Controllers\settingsController::class, 'store']);
Route::get('/addAboutUs',[App\Http\Controllers\settingsController::class, 'addAboutUs']);
Route::post('/aboutUsStore',[App\Http\Controllers\settingsController::class, 'aboutUsStore']);
Route::get('/addPrivacyPolicy',[App\Http\Controllers\settingsController::class, 'addPrivacyPolicy']);
Route::post('/privacyPolicyStore',[App\Http\Controllers\settingsController::class, 'privacyPolicyStore']);


//guest
Route::get('/viewGuest',[adminGuestController::class,'viewGuest']);
Route::get('/delete_guest/{id}',[adminGuestController::class,'delete_guest']);


