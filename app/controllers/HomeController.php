<?php

class HomeController extends BaseController {
	
	public function home()
	{
		$allNews = array();
	
		$infoNews = array();
		$dbNews = News::orderBy('created_at', 'desc')->get();
		foreach ($dbNews as $news) {
			$by = User::find($news->users_id);
			$infoNews['by'] = $by->username;
			$infoNews['news'] = $news;
			array_push($allNews, $infoNews);
		}
		return View::make('home')->with('allNews', $allNews);
	}

	public function getDatabase()
	{
		$newuser = new Right;
		$newuser->name = "New user";
		$newuser->save();

		$user = new Right;
		$user->name = "User";
		$user->save();

		$moderator = new Right;
		$moderator->name = "Moderator";
		$moderator->save();

		$admin = new Right;
		$admin->name = "Admin";	
		$admin->save();
		
		$menu = new Menu;
		$menu->name = "Home";
		$menu->link = "home";
		$menu->save();

		$menu = new Menu;
		$menu->name = "Login";
		$menu->link = "account-sign-in";
		$menu->save();

		$menu = new Menu;
		$menu->name = "Register";
		$menu->link = "account-create";
		$menu->save();

		$menu = new Menu;
		$menu->name = "Home";
		$menu->link = "home";
		$menu->rights_id = $newuser->id;
		$menu->save();

		$menu = new Menu;
		$menu->name = "Forum";
		$menu->link = "forum";
		$menu->rights_id = $newuser->id;
		$menu->save();

		$account = new Menu;
		$account->name = "Account";
		$account->link = "profile-user-loggedin";
		$account->rights_id = $newuser->id;
		$account->save();

		$menu = new Menu;
		$menu->name = "Change password";
		$menu->link = "account-change-password";
		$menu->rights_id = $newuser->id;
		$menu->parent = $account->id;
		$menu->save();

		$menu = new Menu;
		$menu->name = "Change profile";
		$menu->link = "profile-change";
		$menu->rights_id = $newuser->id;
		$menu->parent = $account->id;
		$menu->save();

		$settings = new Menu;
		$settings->name = "Settings";
		$settings->rights_id = $admin->id;
		$settings->save();

		$menu = new Menu;
		$menu->name = "Manage categories";
		$menu->link = "categories-manage";
		$menu->rights_id = $admin->id;
		$menu->parent = $settings->id;
		$menu->save();

		$menu = new Menu;
		$menu->name = "Manage permissions";
		$menu->link = "permissions-manage";
		$menu->rights_id = $admin->id;
		$menu->parent = $settings->id;
		$menu->save();

		$menu = new Menu;
		$menu->name = "Logout";
		$menu->link = "account-sign-out";
		$menu->rights_id = $newuser->id;
		$menu->save();

		return Redirect::route('home')->with('global','Database has been filled.');
	}

}

?>
