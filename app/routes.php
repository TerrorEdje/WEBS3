<?php
Route::get('/', array(
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
| Niet ingelogde groep.
*/
Route::group(array('before' => 'guest'), function()
{
	
	/*
	| CSRF protection group
	*/
	Route::group(array('before' => 'csrf'), function() 
	{
	
		Route::post('/user/create',array(
			'as' => 'user-create-post',
			'uses' => 'UserController@postCreate'
		));
		
		Route::post('/user/sign-in',array(
			'as' => 'user-sign-in-post',
			'uses' => 'UserController@postSignIn'
		));
	
	});
	
	Route::get('/user/create',array(
		'as' => 'user-create',
		'uses' => 'UserController@getCreate'
	));
	
	Route::get('/user/sign-in',array(
		'as' => 'user-sign-in',
		'uses' => 'UserController@getSignIn'
	));
	
	Route::get('/user/activate/{code}', array(
		'as' => 'user-activate',
		'uses' => 'UserController@getActivate'
	));
	
});

?>
