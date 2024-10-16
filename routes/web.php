<?php

use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\Admin\LevelsController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TechnicalsController;
use App\Http\Controllers\Client\OurTeamController;
use App\Http\Controllers\Admin\ProjectsController as AdminProjectsController;
use App\Http\Controllers\Client\projectsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
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

Route::get('/',[HomeController::class,'index'])->name('/');
Route::get('/single/{slug}',[HomeController::class,'single'])->name('single');
Route::get('/ourteam',[OurTeamController::class,'index'])->name('ourteam');
Route::get('/teamSingle/{id}',[OurTeamController::class,'single'])->name('teamSingle');
Route::get('/projects',[ProjectsController::class,'index'])->name('projects');
Route::post('/search',[ProjectsController::class,'search'])->name('search');

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/',[AdminHomeController::class,'index'])->name('admin.home');
    Route::prefix('banner')->group(function(){
        Route::get('/',[AdminBannerController::class,'index'])->name('admin.banner.index');
        Route::get('/create',[AdminBannerController::class,'create'])->name('admin.banner.create');
        Route::post('/create',[AdminBannerController::class,'store'])->name('admin.banner.store');
        Route::get('/edit/{id}',[AdminBannerController::class,'edit'])->name('admin.banner.edit');
        Route::post('/edit',[AdminBannerController::class,'update'])->name('admin.banner.update');
        Route::get('/delete/{ids}',[AdminBannerController::class,'delete'])->name('admin.banner.delete');
        Route::post('search',[AdminBannerController::class,'search'])->name('admin.banner.search');
    });
    Route::prefix('technicals')->group(function(){
        Route::get('/',[TechnicalsController::class,'index'])->name('admin.technicals.index');
        Route::get('/sortDeleteRecord',[TechnicalsController::class,'sortDelete'])->name('admin.technicals.sortDeleteRecord');
        Route::get('/sortDeleteRecord/restore/{id}',[TechnicalsController::class,'restore'])->name('admin.technicals.restore');
        Route::get('/create',[TechnicalsController::class,'create'])->name('admin.technicals.create');
        Route::post('/create',[TechnicalsController::class,'store'])->name('admin.technicals.store');
        Route::get('/edit/{id}',[TechnicalsController::class,'edit'])->name('admin.technicals.edit');
        Route::post('/edit',[TechnicalsController::class,'update'])->name('admin.technicals.update');
        Route::get('/delete/{ids}',[TechnicalsController::class,'delete'])->name('admin.technicals.delete');
        Route::post('search',[TechnicalsController::class,'search'])->name('admin.technicals.search');
        Route::post('searchDelete',[TechnicalsController::class,'searchSortDelete'])->name('admin.technicals.searchDelete');
    });
    Route::prefix('domain')->group(function(){
        Route::get('/',[DomainController::class,'index'])->name('admin.domain.index');
        Route::get('/sortDeleteRecord',[DomainController::class,'sortDelete'])->name('admin.domain.sortDeleteRecord');
        Route::get('/sortDeleteRecord/restore/{id}',[DomainController::class,'restore'])->name('admin.domain.restore');
        Route::get('/create',[DomainController::class,'create'])->name('admin.domain.create');
        Route::post('/create',[DomainController::class,'store'])->name('admin.domain.store');
        Route::get('/edit/{id}',[DomainController::class,'edit'])->name('admin.domain.edit');
        Route::post('/edit',[DomainController::class,'update'])->name('admin.domain.update');
        Route::get('/delete/{ids}',[DomainController::class,'delete'])->name('admin.domain.delete');
        Route::post('searchDelete',[DomainController::class,'searchSortDelete'])->name('admin.domain.searchDelete');
        Route::post('search',[DomainController::class,'search'])->name('admin.domain.search');
    });

    Route::prefix('levels')->group(function(){
        Route::get('/',[LevelsController::class,'index'])->name('admin.levels.index');
        Route::get('/sortDeleteRecord',[LevelsController::class,'sortDelete'])->name('admin.levels.sortDeleteRecord');
        Route::get('/sortDeleteRecord/restore/{id}',[LevelsController::class,'restore'])->name('levels.domain.restore');
        Route::get('/create',[LevelsController::class,'create'])->name('admin.levels.create');
        Route::post('/create',[LevelsController::class,'store'])->name('admin.levels.store');
        Route::get('/edit/{id}',[LevelsController::class,'edit'])->name('admin.levels.edit');
        Route::post('/edit',[LevelsController::class,'update'])->name('admin.levels.update');
        Route::get('/delete/{ids}',[LevelsController::class,'delete'])->name('admin.levels.delete');
        Route::post('searchDelete',[LevelsController::class,'searchSortDelete'])->name('admin.levels.searchDelete');
        Route::post('search',[LevelsController::class,'search'])->name('admin.levels.search');
    });

    Route::prefix('projects')->group(function(){
        Route::get('/',[AdminProjectsController::class,'index'])->name('admin.projects.index');
        Route::get('/sortDeleteRecord',[AdminProjectsController::class,'sortDelete'])->name('admin.projects.sortDeleteRecord');
        Route::get('/sortDeleteRecord/restore/{id}',[AdminProjectsController::class,'restore'])->name('admin.projects.restore');
        Route::get('/create',[AdminProjectsController::class,'create'])->name('admin.projects.create');
        Route::post('/create',[AdminProjectsController::class,'store'])->name('admin.projects.store');
        Route::get('/edit/{id}',[AdminProjectsController::class,'edit'])->name('admin.projects.edit');
        Route::post('/edit',[AdminProjectsController::class,'update'])->name('admin.projects.update');
        Route::get('/delete/{ids}',[AdminProjectsController::class,'delete'])->name('admin.projects.delete');
        Route::post('search',[AdminProjectsController::class,'search'])->name('admin.projects.search');
        Route::post('searchDelete',[AdminProjectsController::class,'searchSortDelete'])->name('admin.projects.searchDelete');
        Route::get('/deploy', [AdminProjectsController::class, 'deployFrom']);
        Route::post('/deploy', [AdminProjectsController::class, 'deploy'])->name('admin.projects.deploy');
    });

    Route::prefix('members')->group(function(){
        Route::get('/',[MemberController::class,'index'])->name('admin.members.index');
        Route::get('/sortDeleteRecord',[MemberController::class,'sortDelete'])->name('admin.members.sortDeleteRecord');
        Route::get('/sortDeleteRecord/restore/{id}',[MemberController::class,'restore'])->name('admin.members.restore');
        Route::get('/create',[MemberController::class,'create'])->name('admin.members.create');
        Route::post('/create',[MemberController::class,'store'])->name('admin.members.store');
        Route::get('/edit/{id}',[MemberController::class,'edit'])->name('admin.members.edit');
        Route::post('/edit',[MemberController::class,'update'])->name('admin.members.update');
        Route::get('/delete/{ids}',[MemberController::class,'delete'])->name('admin.members.delete');
        Route::post('search',[MemberController::class,'search'])->name('admin.members.search');
        Route::post('searchDelete',[MemberController::class,'searchSortDelete'])->name('admin.members.searchDelete');
    });


    Route::prefix('settings')->group(function(){
        Route::get('/',[SettingsController::class,'index'])->name('admin.settings.index');
        Route::get('/edit/{id}',[SettingsController::class,'edit'])->name('admin.settings.edit');
        Route::post('/edit',[SettingsController::class,'update'])->name('admin.settings.update');
        Route::post('search',[SettingsController::class,'search'])->name('admin.settings.search');
    });


});
Auth::routes(['register' => false,'reset' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
