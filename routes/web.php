<?php

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admloginController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/mido', function () {
// 	$res=array();
// 	for($i=1;$i<=5;$i++){
// 		$res['nbf'.$i.'@2022'] = Hash::make('nbf'.$i.'@2022');
// 	}
// 	$res['nbfuser@2022'] = Hash::make('nbfuser@2022');
	
//     dd($res);
// });







Auth::routes();


Route::group(['middleware' => ['auth']], function () { 
Route::get('/home', 'HomeController@index')->name('/home');
Route::get('home/dashTableRecord', 'HomeController@dashTableRecord')->name('home.dashTableRecord');
Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');





Route::resource('admlogins', 'admloginController');

Route::resource('genres', 'genreController');

Route::resource('sgenres', 'sgenreController');

Route::resource('languages', 'languageController');

////////////User Resgitration controller//////////


Route::post('newuserstore','UserRegsitrationController@submit')->name('store-user');





Route::resource('materials', 'materialController');



//Route::resource('materialUploads', 'material_uploadController');

Route::resource('carousels', 'carouselController');

Route::resource('advertisements', 'advertisementController');

Route::resource('userfavs', 'userfavController');

Route::resource('flagedGenres', 'flaged_genreController');

Route::resource('ratings', 'ratingController');

Route::resource('genresorts', 'genresortController');

Route::resource('books', 'bookController');

Route::resource('classNotes', 'class_noteController');

Route::resource('videos', 'videoController');

Route::resource('audioBooks', 'audio_bookController');

Route::resource('appMaterials', 'app_materialController');
Route::post('appmaterialuploads','app_materialController@uploadCsv');

Route::resource('appDepartments', 'app_departmentController');

Route::resource('appSubjects', 'app_subjectController');

Route::resource('genreHighlights', 'genre_highlightController');

Route::resource('appPublishers', 'app_publisherController');

Route::resource('appAdvs', 'app_advController');

Route::resource('appUsers', 'app_userController');

Route::resource('adminAccesses', 'admin_accessController');

Route::resource('accessRoles', 'access_roleController');

Route::resource('bookPublishers', 'book_publisherController');

Route::resource('cmsPages', 'cms_pageController');

Route::resource('region', 'RegionController');

// Customer Feedback
Route::resource('customer_feedback', 'CustomerFeedbackController');


// School & student management
Route::resource('schools', 'SchoolController');
Route::resource('prescribedReadingLists', 'PrescribedReadingListController');
Route::resource('teacherReadingList', 'teacherReadingListController');
Route::resource('manageschools', 'SchoolController');

Route::get('show','RegistrationtokenController@schooluser')->name('show');
Route::get('{schoolid}/managetokens','RegistrationtokenController@manageTokens')->name('managetokens');
Route::get('{schoolid}/createtokens','RegistrationtokenController@createTokens')->name('createtokens');
Route::get('{readingListId}/managetoken','teacherReadingListController@manageTokens');
Route::get('{readingListId}/createtoken','teacherReadingListController@createToken')->name('createtoken');
Route::get('getpatokenbatch/{id}','teacherReadingListController@downloadTokenBatch');
Route::get('gettokenbatch/{id}','RegistrationtokenController@downloadTokenBatch')->name('tokenbatchdl');
Route::get('/students', 'teacherReadingListController@getusesby')->name('students');

Route::post('submit','RegistrationtokenController@store')->name('submit');
Route::get('schooltokens','RegistrationtokenController@listtoken')->name('list');
Route::get('edit/status/{id}','RegistrationtokenController@schooledit')->name('edit');
Route::get('delete/{id}','RegistrationtokenController@delete')->name('delete');
Route::post('update-token','RegistrationtokenController@update')->name('update-token');
Route::get('changeStatus', 'RegistrationtokenController@changeStatus')->name('changeStatus');
Route::get('changetoken', 'RegistrationtokenController@changetoken')->name('changetoken');




});

Route::post('approved','TeacherDetailController@teacherReqApprove')->name('approved');
Route::get('{id}/get-token-modal', 'TeacherDetailController@getTokenModal')->name('get_token_modal');
Route::get('register','UserRegsitrationController@registration')->name('registration-form');
// auth routes end

Route::get('profiledetails/{id}', 'PrescribedReadingListController@getDetails');


Route::get('publisher-books', 'app_materialController@getpublisherbooks');
Route::get('teacher-books','app_materialController@getteacherbooks');


Route::resource('subscriptions', 'SubscriptionController');

Route::resource('subscriptionPlans', 'Subscription_planController');
Route::get('add_subscriptionPlans', 'Subscription_planController@add_subscriptionPlans');

Route::resource('subscribers', 'SubscriberController');
Route::resource('transaction','TransactionController');
Route::resource('order','orderController');
Route::resource('appLogos', 'app_logosController');
Route::resource('coupon_codes','CouponcodesController');

Route::resource('externalApps', 'ExternalAppController');

Route::resource('teacherDetails', 'TeacherDetailController');
Route::post('teacherdetailuploads','TeacherDetailController@uploadCsv');

Route::resource('teacherDetails', 'TeacherDetailController');

// Route::get('use-data-overview', 'HomeController@UserDataOverview');
Route::get('user-data-overview', [HomeController::class, 'UserDataOverview'])->name('user.data.overview');

//change-passwod
Route::get('change-passwod', [admloginController::class, 'changePasswod'])->name('change.passwod');
Route::put('change-passwod-action', [admloginController::class, 'changePasswodAction'])->name('change.passwod.action');



// School & student management

Route::post('material-upload', 'material_uploadController@uploadCsv');

Route::prefix('csv')->group(function () {
    Route::get('material', 'materialController@downloadSampleCsv');
    Route::get('teacher', 'TeacherDetailController@downloadSampleCsv');
	Route::get('book', 'materialController@downloadBookSample');
});

//generate unique slug
Route::post('/generate-slug', 'app_materialController@generateSlug')->name('generate.slug');

//Ai Integration Routes 
Route::get('/ai-integration', 'app_materialController@ShowResourcesForAI')->name('ai.integration.index');
Route::post('/ai-integration/update-ai-integration', 'app_materialController@toggleAIIntegration')->name('update-ai-integration');

