<?php
Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

Route::get('home', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

Route::get('forum', array(
	'as'	=> 'forum',
	'uses'	=> 'CategoryController@showCategories'
));

Route::get('topics/{name}', array(
	'as'	=> 'topics',
	'uses'	=> 'TopicController@showTopics'
));

Route::get('topic/{id}', array(
	'as'	=> 'topic',
	'uses'	=> 'TopicController@showTopic'
));

Route::post('topic/{id}', array(
	'as'	=> 'topic2',
	'uses'	=> 'ReplyController@addReply'
));

/*
| Ingelogde groep.
*/
Route::group(array('before' => 'auth'), function() 
{

	Route::group(array('before' => 'csrf'), function() 
	{
		Route::post('account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));
	});
	
	Route::get('account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));
	
	Route::get('account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));
	
});

/*
| Niet ingelogde groep.
*/
Route::group(array('before' => 'guest'), function()
{
	
	/*
	| CSRF protection group
	*/
	Route::group(array('before' => 'csrf'), function() 
	{
	
		Route::post('account/create',array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		));
		
		Route::post('account/sign-in',array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));
	
	});
	
	Route::get('account/create',array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));
	
	Route::get('account/sign-in',array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));
	
	Route::get('account/activate/{code}', array(
		'as' => 'account-activate',
		'uses' => 'AccountController@getActivate'
	));
	
});

?>
