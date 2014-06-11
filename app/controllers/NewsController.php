<?php

	class NewsController extends BaseController {

		public function getManageNews()
		{
			return View::make('settings/news');
		}

		public function postNews()
		{
			$validator = Validator::make(Input::all(),
				array(
					'name' => 'required',
					'content' => 'required',
				)
			);

			if($validator->fails())
			{
				return Redirect::route('news-manage')->withErrors($validator)->withInput();
			}
			else
			{
				$news = new News;
				$news->name = Input::get('name');
				$news->content = Input::get('content');
				$user = User::find(Auth::user()->id);
				$news->users_id = $user->id;
				$news->save();
				
				return Redirect::route('home')->with('global','News has been added.');
			}
		}

	}

?>
