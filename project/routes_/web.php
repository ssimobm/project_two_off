<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
// function GetVisitor($Request,$data,$type,$type_id)
// {
//   $Visitor = new \App\Models\Visitor ;
//   $check = $Visitor->where('session_id', session()->getId());
//   $check = $check->where('type', $type)->where('type_id', $type_id)->first();
//   if (!isset($check)) {
//     $data->visitor = $Visitor->where('type', $type)->where('type_id', $type_id)->count() ;
//     $data->save();
//     $Visitor->session_id =session()->getId() ;
//     $Visitor->type = $type ;
//     $Visitor->type_id = $type_id ;
//     $Visitor->visitor = 1 ;
//     $Visitor->ip = $Request->getClientIp() ;
//     $Visitor->Agent = $Request->header('User-Agent') ;
//     $Visitor->referrer = request()->headers->get('referer') ;
//     $Visitor->save();
//   }else {
//     $check->visitor++ ;
//     $check->save();
//   }
// }
// Route::get('/simo', function(Request $Request){
// //session_id
// //type
// //type_id
// //visitor
// //id
// //ip adress
// //user userAgent
// //referrer
// //date
// echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
//
// $browser = get_browser(null, true);
// print_r($browser);
// dd($browser);
// dd(GetVisitor($Request,"movies","5"));
//
// dd(request()->headers->get('referer'),$Request->getClientIp(),$Request->header('User-Agent'),date('H:i:s'),Carbon::now()->toDateString());
//
// });

Route::group(['middleware'=>'HtmlMinifier'], function(){







  Route::group(['prefix' => 'admincp','namespace' => 'AdminCp'], function() {

   Route::get('/stats', 'Admin\StatisticController@Today')->name('index');


    Route::group(['prefix' => 'autofix','namespace' => 'autofix'], function() {
      Route::get('/recent_tvshows/{page}', 'TvShowsController@recent_tvshows')->name('recent_tvshows');
      Route::get('/tvshows/{page}', 'TvShowsController@tvshows')->name('tvshows');
      Route::get('/seasons/{page}/{pagenm}/{sea}/{ep}', 'TvShowsController@seasons')->name('seasons');
      Route::get('/movies/{page}', 'TvShowsController@movies')->name('movies');
    });
  //Start prefix Slug Categorys
  Route::group(['prefix' => 'Categorys','namespace' => 'Admin\Settings'], function() {

    Route::get('/', 'CategorysController@index')->name('index');
    Route::post('/add', 'CategorysController@store')->name('store');
    Route::get('/add', 'CategorysController@create')->name('create');
    Route::get('/edit/{id}', 'CategorysController@edit')->name('edit');
    Route::post('/edit/{id}', 'CategorysController@update')->name('update');
    Route::get('/deletes', 'CategorysController@showdalet')->name('showdalet');
    Route::get('/delet/{id}', 'CategorysController@delete')->name('delete');
    Route::get('/restore/{id}', 'CategorysController@restore')->name('restore');
    Route::get('/destroy/{id}', 'CategorysController@destroy')->name('destroy');
  });
  Route::group(['prefix' => 'quality','namespace' => 'Admin\Settings'], function() {

    Route::get('/', 'QualityController@index')->name('index');
    Route::post('/add', 'QualityController@store')->name('store');
    Route::get('/add', 'QualityController@create')->name('create');
    Route::get('/edit/{id}', 'QualityController@edit')->name('edit');
    Route::post('/edit/{id}', 'QualityController@update')->name('update');
    Route::get('/deletes', 'QualityController@showdalet')->name('showdalet');
    Route::get('/delet/{id}', 'QualityController@delete')->name('delete');
    Route::get('/restore/{id}', 'QualityController@restore')->name('restore');
    Route::get('/destroy/{id}', 'QualityController@destroy')->name('destroy');
  });
  //End prefix Slug Categorys
  Route::group(['prefix' => 'autofixes','namespace' => 'Admin\Data\autofixes'], function() {
    Route::post('/season/couper', 'SeasonAutoFixe@search_cute')->name('search_cute');
    Route::get('/seasons/{id}', 'SeasonAutoFixe@index')->name('index');
    Route::post('/season', 'SeasonAutoFixe@update')->name('update');
    Route::get('/episodes/{id}', 'EpisodeAutoFixe@index')->name('index');
    Route::post('/episodes', 'EpisodeAutoFixe@update')->name('update');
    Route::post('/tvshows', 'TvshowAutoFixe@update')->name('update');
    Route::get('/tvshows/post/{id}', 'TvshowAutoFixe@index')->name('index');
  });

  //Start prefix Slug Episodes
  Route::group(['prefix' => 'episodes','namespace' => 'Admin\Data'], function() {



    Route::get('/', 'EpisodesControl@index')->name('index');
    Route::get('/edit/{episode}', 'EpisodesControl@edit')->name('edit');
    Route::post('/edit/{season}/{ep}', 'EpisodesControl@update')->name('update');
    Route::get('/deletes', 'EpisodesControl@showdalet')->name('showdalet');
    Route::get('/delet/{episode}', 'EpisodesControl@delete')->name('delete');
    Route::get('/restore/{episode}', 'EpisodesControl@restore')->name('restore');
    Route::get('/destroy/{episode}', 'EpisodesControl@destroy')->name('destroy');
    Route::get('/{tv}/{episode}/Add', 'EpisodesControl@create')->name('create');
    Route::post('/{tv}/{episode}/Add', 'EpisodesControl@store')->name('store');
    Route::post('/add/apiauto/{tv}/{episode}', 'ApiAllControl@episodes')->name('store');

    Route::post('server/delet/{id}', 'EpisodesControl@server_delet')->name('delet');


  });
  //End prefix Slug Episodes


  //Start prefix Slug Seasons
  Route::group(['prefix' => 'seasons','namespace' => 'Admin\Data'], function() {

    Route::get('/', 'SeasonsController@index')->name('index');
    Route::get('/edit/{season}', 'SeasonsController@edit')->name('edit');
    Route::get('/deletes', 'SeasonsController@showdalet')->name('showdalet');
    Route::post('/edit/{season}', 'SeasonsController@update')->name('update');
    Route::get('/delet/{season}', 'SeasonsController@delete')->name('delete');
    Route::get('/restore/{season}', 'SeasonsController@restore')->name('restore');
    Route::get('/destroy/{season}', 'SeasonsController@destroy')->name('destroy');
    Route::get('/{seasons}/Add', 'SeasonsController@create')->name('create');
    Route::post('/{seasons}/Add', 'SeasonsController@store')->name('store');
    Route::post('/add/apiauto/{tv}', 'ApiAllControl@seasons')->name('store');


  });
  //End prefix Slug Seasons


  //Start prefix Slug Tvshows

  Route::group(['prefix' => 'tvshows','namespace' => 'Admin\Data'], function() {

    Route::get('/', 'TVGetController@index')->name('index');
    Route::get('/Add', 'TVGetController@create')->name('create');
    Route::post('/add/save', 'TVGetController@store')->name('store');
    Route::post('/add/apiauto', 'ApiAllControl@tvshows')->name('store');
    Route::get('/edit/{tvshows}', 'TVGetController@edit')->name('edit');
    Route::post('/edit/{tvshows}', 'TVGetController@update')->name('update');
    Route::get('/delet/{tvshows}', 'TVGetController@delete')->name('delete');
    Route::get('/restore/{tvshows}', 'TVGetController@restore')->name('restore');
    Route::get('/destroy/{tvshows}', 'TVGetController@destroy')->name('destroy');
    Route::get('/destroy/all/all', 'TVGetController@alldestroy')->name('alldestroy');
    Route::get('/deletes', 'TVGetController@showdalet')->name('showdalet');

  });

  //Start prefix Slug Movies
  Route::group(['prefix' => 'movies','namespace' => 'Admin\Data'], function() {

    Route::get('/', 'MoviesController@index')->name('index');
    Route::get('/Add', 'MoviesController@create')->name('create');
    Route::post('/add/save', 'MoviesController@store')->name('store');
    Route::post('/add/apiauto', 'ApiAllControl@movies')->name('store');
    Route::get('/edit/{movies}', 'MoviesController@edit')->name('edit');
    Route::post('/edit/{movies}', 'MoviesController@update')->name('update');
    Route::get('/delet/{movies}', 'MoviesController@delete')->name('delete');
    Route::get('/restore/{movies}', 'MoviesController@restore')->name('restore');
    Route::get('/destroy/{movies}', 'MoviesController@destroy')->name('destroy');
    Route::get('/destroy/all/all', 'MoviesController@alldestroy')->name('alldestroy');
    Route::get('/deletes', 'MoviesController@showdalet')->name('showdalet');

  });
  //End prefix Slug Movies
  //Start prefix Slug options
  // beta
   Route::group(['prefix' => 'options','namespace' => 'Options'], function() {
     Route::get('settings', 'SettingsController@index')->name('edit');
     Route::post('settings', 'SettingsController@update')->name('update');
     Route::get('seo', 'SeoController@index')->name('edit');
     Route::post('seo', 'SeoController@update')->name('update');

     Route::get('api', 'OptionsApiController@index')->name('edit');
     Route::get('/api', 'ApiTmdbControl@index')->name('index');
     Route::post('api/update', 'ApiTmdbControl@update')->name('update');
     Route::get('roles/permissions', 'PermissionsController@index')->name('index');
     Route::get('roles/permissions/edit/{ids}', 'RolesController@edit')->name('edit');
     Route::post('roles/permissions/edit/{ids}', 'RolesController@update')->name('update');

     Route::get('roles', 'RolesController@index')->name('index');
     Route::get('roles/edit/{ids}', 'RolesController@edit')->name('edit');
     Route::post('roles/edit/{ids}', 'RolesController@update')->name('update');


     Route::get('users', 'UsersController@index')->name('index');
     Route::get('users/add', 'UsersController@create')->name('create');
     Route::post('users/add', 'UsersController@store')->name('store');
     Route::get('users/edit/{ids}', 'UsersController@edit')->name('edit');
     Route::post('users/edit/{ids}', 'UsersController@update')->name('update');
     Route::post('users/error', 'UsersController@error')->name('error');
     Route::get('users/delet/{id}', 'UsersController@delet')->name('delet');
     Route::get('users/trached', 'UsersController@delet_index')->name('delet_index');
     Route::get('users/restore/{id}', 'UsersController@restore_get')->name('restore_get');
     Route::get('users/remove/{id}/{new_id}', 'UsersController@remove_get')->name('remove_get');
     Route::get('users/trached/vidall', 'UsersController@vidall')->name('vidall');


        Route::get('users/pass/{id}', 'adminUserPassController@index')->name('index');
        Route::post('users/pass/{id}', 'adminUserPassController@update')->name('update');
        Route::post('users/error/pass', 'adminUserPassController@error')->name('error');




   });
  //End prefix Slug options
  //Start prefix Slug options
   Route::group(['prefix' => '/data/movies','namespace' => 'Admin\Api'], function() {

     Route::get('/', 'ApiMovieController@index')->name('index');
     Route::get('ADD/{id}', 'ApiMovieController@store1')->name('store1');
     Route::post('ADD/{id}', 'ApiMovieController@store')->name('store');
     Route::post('ajax/{id}', 'MoviesController@indexajax')->name('indexajax');


   });
  //End prefix Slug options
  ///////////////////////////////////////////////////////////
  // prefix Controller Api All server
  ///////////////////////////////////////////////////////////
  Route::group(['prefix' => '/data','namespace' => 'Admin'], function() {

           // start store api data
           Route::post('/movies/post/{id}', 'Data\ApiAllControl@movies')->name('store');
           Route::post('/tvshows/post/{id}', 'Data\ApiAllControl@tvshows')->name('store');
           Route::post('/seasons/post/{tv}/', 'Data\ApiAllControl@seasons')->name('store');
           Route::post('/episodes/post/{tv}/{season}/{ep}', 'Data\ApiAllControl@episodes')->name('store1');
           Route::post('/episodes/post/{tv}/{season}', 'Data\ApiAllControl@episodes')->name('store');
           //Route::post('/episodes/post/{tv}/{season}', 'Data\ApiAllControl@episodes')->name('update_update');
           // end store api data

           Route::group(['prefix' => '/movies','namespace' => 'Api'], function() {
              Route::get('/', 'ApiGetAjaxControl@movies_ajax')->name('index');
              Route::get('/edit', 'ApiGetAjaxControl@movies_ajax_edit')->name('index');
              Route::post('/ajax/{id}', 'ApiGetAjaxControl@movies_ajax')->name('index_ajax');
            });

           Route::group(['prefix' => '/tvshows','namespace' => 'Api'], function() {
              Route::get('/', 'ApiGetAjaxControl@tvshows_ajax')->name('index');
              Route::get('/edit', 'ApiGetAjaxControl@tvshows_ajax_edit')->name('index');
              Route::post('/ajax/{id}', 'ApiGetAjaxControl@tvshows_ajax')->name('index_ajax');
            });

           Route::group(['prefix' => '/episodes','namespace' => 'Api'], function() {
              Route::get('/', 'ApiGetAjaxControl@episodes_ajax')->name('index');
              Route::get('/{tv}/{season}', 'ApiGetAjaxControl@episodes_ajax')->name('index_ajax');
              Route::get('/{tv}/{season}/edit', 'ApiGetAjaxControl@episodes_ajax_edit')->name('episodes_ajax_edit');
            });

           Route::group(['prefix' => '/seasonss','namespace' => 'Api'], function() {
              Route::get('/', 'ApiGetAjaxControl@seasons_ajax')->name('index');
              Route::get('/{tv}', 'ApiGetAjaxControl@seasons_ajax')->name('index_ajax');
              Route::get('/{tv}/edit', 'ApiGetAjaxControl@seasons_ajax_edit')->name('index_ajax');
            });

  });
});

//end admincp


Route::group(['prefix' => 'auth/users','namespace' => 'Auth\custom'], function() {

  Route::post('/pass/error', 'UserChangePassController@error');
  Route::get('/pass', 'UserChangePassController@index');
  Route::post('/pass', 'UserChangePassController@update');

  Route::post('/resets/error', 'UserResetController@error');
  Route::get('/reset/{token}', 'UserResetController@index');
  Route::get('/resets', 'UserResetController@index1');
  Route::post('/resets', 'UserResetController@update1');
});
Route::get('/logout', function () {
  Auth::logout();
    return redirect()->back() ;
});
// Auth::routes([
//   'register' => false, // Registration Routes...
//   'reset' => false, // Password Reset Routes...
//   'verify' => false, // Email Verification Routes...]);
// ]);
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// pages index
Route::get('/home', 'HomeController@index');
Route::get('/', 'indexcontroller@index')->name('index');
Route::group(['prefix' => 'browse'], function() {
  Route::get('/episodes', 'browseController@episodes')->name('episodes');
  Route::get('/tvshows', 'browseController@tvshows')->name('tvshows');
  Route::get('/movies', 'browseController@movies')->name('movies');
});
Route::get('/movies/{id}', 'ProfileMoviesController@index')->name('index');
Route::get('/movies/{id}/watch', 'ProfileMoviesController@watch')->name('index');
//Route::get('tvshows/{id}', 'ProfileTVshowsController@seasons')->name('seasons');
Route::get('tvshows/{season}', 'ProfileTVshowsController@index')->name('index');
Route::get('seasons/{season}', 'ProfileTVshowsController@seasons')->name('seasons');
Route::get('tvshows/{season}/season/{id}', 'ProfileTVshowsController@seasons')->name('seasons');

//End prefix Slug Tvshows
///////////like watch favorit///////////
Route::get('users/edit','UserSettingsController@index');

  Route::group(['prefix' => 'Profile'], function() {
    Route::get('Edit','UserSettingsController@index');
    Route::post('Edit','UserSettingsController@update');
    Route::post('/error', 'UserSettingsController@error')->name('error');
    Route::post('/{id}/Add', 'FavoritController@store')->name('store');
    Route::post('/Favorit/Delet', 'FavoritController@destroy')->name('destroy');
  });

Route::get('users/notifications', 'FavoritController@notification')->name('index_ajax');
Route::post('users/notifications', 'FavoritController@DelletTypeAll')->name('DelletTypeAll');
Route::get('users/watchLater', 'FavoritController@indexWatchlater')->name('indexWatchlater');
Route::get('users/watchContinue', 'FavoritController@indexwatchContinue')->name('indexwatchContinue');
Route::get('users/favorit', 'FavoritController@index')->name('index');
//////////////////////
Route::get('/tvshows/{tv}/season/{Sea}/episode/{Ep}', 'Servercontroller@season_ep_index')->name('ep_index');
Route::post('/search', 'Searchcontroller@ajaxSearch')->name('ajaxSearch');





////////comments start///////////////
// Route::post('comments/ajax/{movies}', 'Servercontroller@movies_ajax')->name('index');
// Route::post('comments/ajaxtest/{movies}', 'Servercontroller@movies_ajaxtest')->name('index');
// Route::get('/comments/{id}/{par}', 'commentscontroller@findajax')->name('findajax');
// Route::post('/comments/{id}', 'commentscontroller@store')->name('store');
// Route::get('/likes', 'LikesController@index')->name('siimo');
// Route::post('/likes/add/{id}', 'LikesController@store')->name('store');
//Route::get('/search/{id}', 'Searchcontroller@ajaxSearch')->name('ajaxSearch');




//Route::get('/simoo', 'Admin\Data\ApiServerAllControl@tvshows');
// Route::get('simo', function()
// {
//   $name = "Shingeki no";
//   $users0 = DB::connection('mysql2')->table('tvshows')
//            ->where('title','like', "%".$name."%")
//            ->first();
//   $users = DB::connection('mysql2')->table('tvshows')
//            ->where('name','like', "%".$name."%")
//            ->where('type','TvShows_animes')
//            ->get();
//   // $users = DB::connection('mysql2')->table('tvshows')
//   //          ->join('episodes', 'tvshows.id', '=', 'episodes.tv_id')
//   //          ->where('tvshows.id', 1)
//   //          ->join('servers', 'episodes.id', '=', 'servers.ep_id')
//   //          ->first();
// dd($users);
// });

//Route::get('/send-mail', 'AllMailcontroller@VerifyAccount');
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
});
