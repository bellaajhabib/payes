<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('personnel/delete/{task}', 'PersonnelController@getDelete');
Route::get('personnel/supprimerPersonnel/{task}', 'PersonnelController@supprimerPersonnel');

Route::get('/', 'AppController@home');
Route::get('dashborad', 'DashboradController@index');
Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){
	
 Route::resource('admins','AdminController');
});
/**************************Bulletin de Paie*********************************************************/
Route::resource('bulletinPaie','BulletinPaieController');
/**************************primes*********************************************************/
Route::resource('primes','PrimeController');


/**************************Conges*********************************************************/
Route::resource('conges','CongesController');

Route::get('conges/updateCongee/{personnel_id}', 'CongesController@updateCongee');
Route::any('conges/{conge_id}/updateCongePersonnell', 'CongesController@updateCongePersonnell');

/********************************************************************************************/
/**************************personnel*********************************************************/
Route::resource('personnel','PersonnelController');

/********************************************************************************************/
/********************Cacule salaier***********************/
Route::get('salaire', 'PersonnelController@salaire');

Route::post('calculeSalaire',['uses'=>'PersonnelController@calculeSalaire', 'as' => 'clsalaire'] );

/*********************************************************/
Route::resource('typeDeContrat','TypeDeContratController');

// Authentication routes...

//Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
// Route::match(['get', 'post'], '/', 'AppController@home');
// Route::get('test', 'AppController@test');

//Route::post('auth/facebookLogin/{offline?}', 'Auth\AuthController@facebookLogin');
// Route::post('signup', 'AppController@signup');

/*Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);*/

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'authz'],
    'roles' => ['admin'],
    'permissions' => ['can_edit']
], function()
{
    Route::get('/', ['uses' => 'AdminController@dashboard', 'as' => 'admin.dashboard']);
});
*/


/*
|--------------------------------------------------------------------------
|  Routes Journal de paie Coût Total
|--------------------------------------------------------------------------
*/
Route::get('JournalPaieCoutTotal', 'JournalPaieCoutTotalController@index');
/*
|--------------------------------------------------------------------------
|  Routes Journal de paie IRPP
|--------------------------------------------------------------------------
*/
Route::get('JournalPaieIrpp', 'JournalPaieIrppController@index');

/*
|--------------------------------------------------------------------------
|  Routes Cnss
|--------------------------------------------------------------------------
*/
Route::get('cnss', 'CnssController@index');

/*
 ------------------------------------------------------------------------------------
Ajax
 -------------------------------------------------------------------------------------
 */
Route::post('/getRequest',function(){
	$data = Input::all();

	if(Request::ajax())
	{
		return $data;
	}
});