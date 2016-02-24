<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
setlocale(LC_TIME, config('app.locale'));

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
	
    Route::auth();
    Route::get('/', 'HomeController@index');
    Route::group(['middleware' => 'auth'], function () {

        Route::resource('report', 'ReportController');
        Route::get('report/getByCollab/{idcollab?}/{datedeb?}/{datefin?}/{type_heure?}', 'ReportController@getByCollab');
        Route::get('report/getByClientCollab/{idclient?}/{idcollab?}/{datedeb?}/{datefin?}/{type_heure?}', 'ReportController@getByClientCollab');
        Route::get('report/getByContratCollab/{idcontrat?}/{idcollab?}/{datedeb?}/{datefin?}/{type_heure?}', 'ReportController@getByContratCollab');

		Route::resource('client', 'ClientController');
		Route::get('client/getByRegion/{idregion?}', 'ClientController@getByRegion');
		Route::get('client/getByDep/{iddep?}', 'ClientController@getByDep');
		Route::get('client/getViewByRegion/{idregion?}', 'ClientController@getViewByRegion');
		Route::get('client/getViewByDep/{iddep?}', 'ClientController@getViewByDep');
		Route::get('client/getByCollab/{idcollab?}', 'ClientController@getByCollab');

		Route::resource('contrat', 'ContratController');
		Route::get('contrat/getByRegion/{idregion?}', 'ContratController@getByRegion');
		Route::get('contrat/getByDep/{iddep?}', 'ContratController@getByDep');
		Route::get('contrat/getByClient/{idclient?}', 'ContratController@getByClient');
		Route::get('contrat/getByClientCollab/{idclient?}/{idcollab?}', 'ContratController@getByClientCollab');

		Route::resource('contrat_collaborateur', 'Contrat_collaborateurController');

		Route::resource('departement', 'DepartementController');
		Route::get('departement/getByRegion/{idregion?}', 'DepartementController@getByRegion');

		Route::resource('user', 'UserController');
		Route::get('user/getViewByRegion/{idregion?}', 'UserController@getViewByRegion');
		Route::get('user/getViewByDep/{iddep?}', 'UserController@getViewByDep');

		Route::resource('calendrier', 'CalendrierController');

		Route::resource('color_client_collab', 'Color_client_collabController');

		Route::resource('planning', 'PlanningController');

		Route::resource('region', 'RegionController');


    });
});



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);