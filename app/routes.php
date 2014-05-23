<?php
Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

/*
| Ingelogde groep.
*/
Route::group(array('before' => 'auth'), function() 
{

	/*
	| CSRF protection group
	*/
	Route::group(array('before' => 'csrf'), function() 
	{
		Route::post('forum/topic/{id}', array(
			'as'	=> 'forum-topic-post',
			'uses'	=> 'TopicController@postReply'
		));

		Route::post('account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));

		Route::post('profile/change',array(
			'as' => 'profile-change-post',
			'uses' => 'ProfileController@postChangeProfile'
		));
	});

	Route::get('forum/topic/{id}', array(
		'as'	=> 'forum-topic',
		'uses'	=> 'TopicController@getTopic'
	));

	Route::get('forum/category/{name}', array(
		'as'	=> 'forum-category',
		'uses'	=> 'CategoryController@getCategory'
	));

	Route::get('forum', array(
		'as'	=> 'forum',
		'uses'	=> 'CategoryController@getCategories'
	));
	
	Route::get('account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));
	
	Route::get('account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));
	
	Route::get('profile/get/{username}',array(
		'as' => 'profile-user',
		'uses' => 'ProfileController@user'
	));

	Route::get('profile/change',array(
		'as' => 'profile-change',
		'uses' => 'ProfileController@getChangeProfile'
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
		
		Route::post('account/forgot-password',array(
		'as' => 'account-forgot-password-post',
		'uses' => 'AccountController@postForgotPassword'
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
	
	Route::get('account/forgot-password',array(
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	));
	
	Route::get('account/recovery/{code}', array(
		'as' => 'account-recover',
		'uses' => 'AccountController@getRecover'
	));
	
});

?>
