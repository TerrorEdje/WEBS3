<?php
Route::get('/', function()
{
	return View::make('home');
});

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

Route::get('emailtest',array(
	'as' => 'emailtest',
	'uses' => 'HomeController@email'
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
	
		Route::post('user/create',array(
		'as' => 'user-create-post',
		'uses' => 'UserController@postCreate'
	));
	
	});
	
	Route::get('user/create',array(
		'as' => 'user-create',
		'uses' => 'UserController@getCreate'
	));
	
});

?>
