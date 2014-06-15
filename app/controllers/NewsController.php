<?php

	class NewsController extends BaseController {

		# Maakt de view aan om een niewsbericht toe te voegen
		public function getManageNews()
		{
			Breadcrumb::addbreadcrumb('Home','../');
			Breadcrumb::addbreadcrumb('Manage news');
			$data = array ( 'breadcrumbs' => Breadcrumb::generate() );
			return View::make('settings/news',$data);
		}

		# Zet een nieuwsbericht in de database
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
		
		# Maakt een view aan om een nieuwsbericht te wijzigen
		public function getUpdateNews($id)
		{
			$news = News::find($id);
			Breadcrumb::addbreadcrumb('Home','../../');
			Breadcrumb::addbreadcrumb('Update news');
			$data = array ( 'breadcrumbs' => Breadcrumb::generate() );
			return View::make('settings/updateNews',$data)->with('news', $news);
		}
		
		# Zet het gewijzigde nieuwsbericht in de database
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
		
		# Verwijderd een nieuwsbericht uit de database
		public function getDeleteNews($id)
		{
			News::where('id', '=', $id)->delete();
			return Redirect::route('home')->with('global','News number ' .$id. ' deleted!');
		}

	}

?>
