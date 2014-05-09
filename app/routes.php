<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('hello');
});*/

Route::get('/', array(
	'as'	=> 'home',
	'uses'	=> 'HomeController@showCategorieen'
));

Route::get('topics/{id}', array(
	'as'	=> 'topics',
	'uses'	=> 'TopicController@showTopics'
));

Route::get('topic/{id}', array(
	'as'	=> 'topic',
	'uses'	=> 'TopicController@showTopic'
));

Route::post('topic/{id}', array(
	'as'	=> 'topic2',
	'uses'	=> 'ReactieController@addReactie'
));

# ---------------------------------------------------------------

Route::get('beheerCategorieen', array(
	'as'	=> 'beheerCategorieen',
	'uses'	=> 'CategorieController@showCategorieen'
));

Route::post('beheerCategorieen/{id}', array(
	'as'	=> 'categorieWijzigen',
	'uses'	=> 'CategorieController@categorieWijzigen'
));

Route::post('beheerCategorieen/{id}', array(
	'as'	=> 'categorieVerwijderen',
	'uses'	=> 'CategorieController@categorieVerwijderen'
));

# ---------------------------------------------------------------

Route::get('inloggen', array('as' => 'inloggen', function()
{
    return View::make('inloggen');
}));

Route::post('inloggen', array(
	'as'	=> 'inloggen2',
	'uses'	=> 'GebruikerController@inloggen'
));

Route::get('registreren', function()
{
	return View::make('registreren');
});

Route::post('registreren', array(
	'as'	=> 'registreren2',
	'uses'	=> 'GebruikerController@registreren'
));

?>
