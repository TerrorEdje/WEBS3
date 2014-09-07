<?php
Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

Route::get('/home', array(
	'as' => 'home2',
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
		Route::post('forum/reply/{id}', array(
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

		Route::post('forum/topic-create', array(
			'as'	=> 'forum-topic-create-post',
			'uses'	=> 'TopicController@postTopicCreate'
		));
		
		Route::post('forum/topic/vote/{id}', array(
			'as'	=> 'forum-topic-vote-post',
			'uses'	=> 'PollController@postVote'
		));
		
		Route::post('update/topic', array(
			'as'	=> 'update-topic-post',
			'uses'	=> 'TopicController@postUpdateTopic'
		));
		
		Route::post('update/reply', array(
			'as'	=> 'update-reply-post',
			'uses'	=> 'TopicController@postUpdateReply'
		));

		/*
		| Admin deel
		*/
		Route::group(array('before' => 'admin'), function() 
		{
			Route::post('settings/categories/subcategory', array(
				'as'	=> 'manage-category-subcategory-post',
				'uses'	=> 'CategoryController@postSubcategory'
			));

			Route::post('settings/categories/category', array(
				'as'	=> 'manage-category-category-post',
				'uses'	=> 'CategoryController@postCategory'
			));
			
			Route::post('update/category', array(
				'as'	=> 'update-category-post',
				'uses'	=> 'CategoryController@postUpdatecategory'
			));
			
			Route::post('update/Subcategory', array(
				'as'	=> 'update-subcategory-post',
				'uses'	=> 'CategoryController@postUpdateSubcategory'
			));

			Route::post('settings/permissions/post', array(
				'as'	=> 'manage-permissons-post',
				'uses'	=> 'AccountController@postPermissions'
			));
			
			Route::post('settings/news/post', array(
				'as'	=> 'manage-news-post',
				'uses'	=> 'NewsController@postNews'
			));		

			Route::post('update/news', array(
				'as'	=> 'update-news-post',
				'uses'	=> 'NewsController@postUpdateNews'
			));
			
		});
	});

	Route::get('forum/topic/{id}', array(
		'as'	=> 'forum-topic',
		'uses'	=> 'TopicController@getTopic'
	));

	Route::get('forum/topic-create/{name}', array(
		'as'	=> 'forum-topic-create',
		'uses'	=> 'TopicController@getTopicCreate'
	));
	
	Route::post('forum/topic-create/{name}', array(
		'as'	=> 'forum-topic-create-get',
		'uses'	=> 'TopicController@getTopicCreate'
	));

	Route::get('forum/category/{id}', array(
		'as'	=> 'forum-category',
		'uses'	=> 'CategoryController@getCategory'
	));

	Route::get('forum/category', array(
		'as'	=> 'forum-category-js',
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
	
	Route::get('update/topic/{id}',array(
		'as' => 'update-topic',
		'uses' => 'TopicController@getUpdateTopic'
	));
	
	Route::get('delete/topic/{id}',array(
		'as' => 'delete-topic',
		'uses' => 'TopicController@getDeleteTopic'
	));
	
	Route::get('close/topic/{id}',array(
		'as' => 'close-topic',
		'uses' => 'TopicController@getCloseTopic'
	));
	
	Route::get('update/reply/{id}',array(
		'as' => 'update-reply',
		'uses' => 'TopicController@getUpdateReply'
	));
	
	Route::get('delete/reply/{id}',array(
		'as' => 'delete-reply',
		'uses' => 'TopicController@getDeleteReply'
	));
	
	/*
	| Admin deel
	*/
	Route::group(array('before' => 'admin'), function() 
	{
		Route::get('settings/categories',array(
			'as' => 'categories-manage',
			'uses' => 'CategoryController@getManageCategories'
		));
		
		Route::get('update/category/{id}',array(
			'as' => 'update-category',
			'uses' => 'CategoryController@getUpdateCategory'
		));
		
		Route::get('delete/category/{id}',array(
			'as' => 'delete-category',
			'uses' => 'CategoryController@getDeleteCategory'
		));
		
		Route::get('update/subcategory/{id}',array(
			'as' => 'update-subcategory',
			'uses' => 'CategoryController@getUpdateSubcategory'
		));
		
		Route::get('delete/subcategory/{id}',array(
			'as' => 'delete-subcategory',
			'uses' => 'CategoryController@getDeleteSubcategory'
		));

		Route::get('settings/permissions',array(
			'as' => 'permissions-manage',
			'uses' => 'AccountController@getManagePermissions'
		));
		
		Route::get('settings/news',array(
			'as' => 'news-manage',
			'uses' => 'NewsController@getManageNews'
		));
		
		Route::get('update/news/{id}',array(
			'as' => 'update-news',
			'uses' => 'NewsController@getUpdateNews'
		));
		
		Route::get('delete/news/{id}',array(
			'as' => 'delete-news',
			'uses' => 'NewsController@getDeleteNews'
		));
		
	});
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

	Route::get('database', array(
		'as' => 'database',
		'uses' => 'HomeController@getDatabase'
	));
	
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
