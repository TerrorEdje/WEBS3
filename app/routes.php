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

	Route::get('profile',array(
		'as' => 'profile-user-loggedin',
		'uses' => 'ProfileController@loggedInUser'
	));

	Route::get('profile/change',array(
		'as' => 'profile-change',
		'uses' => 'ProfileController@getChangeProfile'
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
		
		Route::get('update/subcategory/{id}',array(
			'as' => 'update-subcategory',
			'uses' => 'CategoryController@getUpdateSubcategory'
		));

		Route::get('settings/permissions',array(
			'as' => 'permissions-manage',
			'uses' => 'AccountController@getManagePermissions'
		));
		
		Route::get('settings/news',array(
			'as' => 'news-manage',
			'uses' => 'NewsController@getManageNews'
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
