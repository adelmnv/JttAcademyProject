<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{HomeController, PostController, CoachController, PlayerController, PracticeController, TournamentController, AdminController, MembershipController, IndividualPracticeController, RentCourtController, GroupPracticeController};
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
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index'])->name('main');
Route::get('/about',[HomeController::class,'about'])->name('about');

Route::get('/login' ,[HomeController::class,'user_login'])->name('user.login');
Route::post('/login' ,[HomeController::class,'user_auth'])->name('user.auth');
Route::get('/logout' ,[HomeController::class,'user_logout'])->name('user.logout');

Route::get('/posts',[PostController::class,'posts'])->name('posts');
Route::get('/posts/{post_id?}/view/',[PostController::class,'view'])->name('posts.view')->where('post_id','[0-9]+');
Route::get('/posts/category/by_category/{category_id?}',[PostController::class,'posts_by_category'])->name('posts.by_category');
Route::get('/posts/{post_id?}/edit/',[PostController::class,'edit'])->name('posts.edit')->middleware('auth');
Route::post('/posts/{post_id?}/edit/',[PostController::class,'update'])->name('posts.update')->middleware('auth');
Route::get('/posts/create/',[PostController::class,'create'])->name('posts.create')->middleware('auth');
Route::post('/posts/create/',[PostController::class,'save'])->name('posts.save')->middleware('auth');

Route::get('/coaches',[CoachController::class,'coaches'])->name('coaches');
Route::get('/coaches/{coach_id?}/view/',[CoachController::class,'view'])->name('coaches.view')->where('coach_id','[0-9]+');
Route::get('/coaches/{coach_id?}/edit/',[CoachController::class,'edit'])->name('coaches.edit')->middleware('auth');
Route::post('/coaches/{coach_id?}/edit/',[CoachController::class,'update'])->name('coaches.update')->middleware('auth');
Route::get('/coaches/create/',[CoachController::class,'create'])->name('coaches.create')->middleware('auth');
Route::post('/coaches/create/',[CoachController::class,'save'])->name('coaches.save')->middleware('auth');

Route::get('/players',[PlayerController::class,'players'])->name('players');
Route::get('/players/{player_id?}/edit/',[PlayerController::class,'edit'])->name('players.edit')->middleware('auth');
Route::post('/players/{player_id?}/edit/',[PlayerController::class,'update'])->name('players.update')->middleware('auth');
Route::get('/players/create/',[PlayerController::class,'create'])->name('players.create')->middleware('auth');
Route::post('/players/create/',[PlayerController::class,'save'])->name('players.save')->middleware('auth');

Route::get('/practices', [PracticeController::class,'practices'])->name('practices');
Route::get('/practices/type/by_type/{type_id?}',[PracticeController::class,'practices_by_type'])->name('practices.by_type');
Route::get('/practices/{practice_id?}/type/{type_id?}/create_application/',[PracticeController::class,'create_application'])->name('practices.create_application');
Route::post('/practices/{practice_id?}/type/{type_id?}/store_application/',[PracticeController::class,'store_application'])->name('practices.store_application');
Route::get('/practices/{practice_id?}/edit/',[PracticeController::class,'edit'])->name('practices.edit')->middleware('auth');
Route::post('/practices/{practice_id?}/update/',[PracticeController::class,'update'])->name('practices.update')->middleware('auth');
Route::get('/practices/create/',[PracticeController::class,'create'])->name('practices.create')->middleware('auth');
Route::post('/practices/create/',[PracticeController::class,'save'])->name('practices.save')->middleware('auth');


Route::get('/tournaments',[TournamentController::class,'tournaments'])->name('tournaments');
Route::get('/tournaments/{tournament_id?}/view/',[TournamentController::class,'view'])->name('tournaments.view')->where('tournament_id','[0-9]+');
Route::get('/tournaments/{tournament_id?}/create_registration/',[TournamentController::class,'create_registration'])->name('tournaments.create_registration');
Route::post('/tournaments/{tournament_id?}/store_registration/',[TournamentController::class,'store_registration'])->name('tournaments.store_registration');
Route::get('/tournaments/{tournament_id?}/edit/',[TournamentController::class,'edit'])->name('tournaments.edit')->middleware('auth');
Route::post('/tournaments/{tournament_id?}/update/',[TournamentController::class,'update'])->name('tournaments.update')->middleware('auth');
Route::get('/tournaments/create/',[TournamentController::class,'create'])->name('tournaments.create')->middleware('auth');
Route::post('/tournaments/create/',[TournamentController::class,'save'])->name('tournaments.save')->middleware('auth');
Route::post('tournaments/remove/{participant_id}', [TournamentController::class,'remove_participant'])->name('tournaments.remove')->middleware('auth');
Route::get('tournaments/edit/{participant_id}', [TournamentController::class,'edit_participant'])->name('tournaments.edit_participant')->middleware('auth');
Route::post('tournaments/update/{participant_id}', [TournamentController::class,'update_participant'])->name('tournaments.update_participant')->middleware('auth');

//Route::get('/dash',[AdminController::class,'admin_dash'])->name('admin.dash')->middleware('auth');
Route::get('/dash/applications',[AdminController::class,'applications'])->name('admin.applications')->middleware('auth');
Route::post('/dash/applications/edit/{id}', [AdminController::class, 'application_edit_status'])->name('admin.application_edit_status')->middleware('auth');
Route::get('/dash/schedule',[AdminController::class,'schedule'])->name('admin.schedule')->middleware('auth');
Route::get('/dash/menu',[AdminController::class,'menu'])->name('admin.menu')->middleware('auth');

Route::get('/dash/memberships',[MembershipController::class,'memberships'])->name('memberships')->middleware('auth');
Route::get('/dash/memberships/{membership_id?}/view', [MembershipController::class, 'view'])->name('memberships.view')->middleware('auth');
Route::get('/dash/memberships/{membership_id?}/edit/',[MembershipController::class,'edit'])->name('memberships.edit')->middleware('auth');
Route::post('/dash/memberships/{membership_id?}/update/',[MembershipController::class,'update'])->name('memberships.update')->middleware('auth');
Route::get('/dash/memberships/create/{id?}',[MembershipController::class,'create'])->name('memberships.create')->middleware('auth');
Route::post('/dash/memberships/create/',[MembershipController::class,'save'])->name('memberships.save')->middleware('auth');

Route::get('/dash/individuals/{id?}/view', [IndividualPracticeController::class, 'view'])->name('individual_practices.view')->middleware('auth');
Route::get('/dash/individuals/{id?}/edit/',[IndividualPracticeController::class,'edit'])->name('individual_practices.edit')->middleware('auth');
Route::post('/dash/individuals/{id?}/update/',[IndividualPracticeController::class,'update'])->name('individual_practices.update')->middleware('auth');
Route::get('/dash/individuals/create/{id?}',[IndividualPracticeController::class,'create'])->name('individual_practices.create')->middleware('auth');
Route::post('/dash/individuals/create/',[IndividualPracticeController::class,'save'])->name('individual_practices.save')->middleware('auth');

Route::get('/dash/rent/{id?}/view', [RentCourtController::class, 'view'])->name('rent_courts.view')->middleware('auth');
Route::get('/dash/rent/{id?}/edit/',[RentCourtController::class,'edit'])->name('rent_courts.edit')->middleware('auth');
Route::post('/dash/rent/{id?}/update/',[RentCourtController::class,'update'])->name('rent_courts.update')->middleware('auth');
Route::get('/dash/rent/create/{id?}',[RentCourtController::class,'create'])->name('rent_courts.create')->middleware('auth');
Route::post('/dash/rent/create/',[RentCourtController::class,'save'])->name('rent_courts.save')->middleware('auth');

Route::get('/dash/groups/{id?}/view', [GroupPracticeController::class, 'view'])->name('group_practices.view')->middleware('auth');
Route::get('/dash/groups/create/',[GroupPracticeController::class,'create'])->name('group_practices.create')->middleware('auth');
Route::post('/dash/groups/create/',[GroupPracticeController::class,'save'])->name('group_practices.save')->middleware('auth');
