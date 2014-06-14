<?php

	class NewsController extends BaseController {

		public function getManageNews()
		{
			$category = Category::find($id);
			return View::make('settings/news')->with('category', $category);;
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
				
				return Redirect::route('home');
			}
		}
		
		public function getUpdateNews($id)
		{
			$news = News::find($id);
			return View::make('settings/updateNews')->with('news', $news);
		}
		
		public function postUpdateNews()
		{
			$validator = Validator::make(Input::all(),
				array(
					'name' => 'required',
					'content' => 'required',
				)
			);

			if($validator->fails())
			{
				return Redirect::route('update-news')->withErrors($validator)->withInput();
			}
			else
			{
				$news = News::find(Input::get('newsID'));
				$news->name = Input::get('name');
				$news->content = Input::get('content');
				$news->save();
				
				return Redirect::route('home');
			}
		}
		
		public function getDeleteNews($id)
		{
			News::where('id', '=', $id)->delete();
			return Redirect::route('home');
		}

	}

?>
