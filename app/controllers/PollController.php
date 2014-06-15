<?php

class PollController extends BaseController {

	# Voegt de stem op een polloption toe aan de database
	public function postVote($id)
	{
		$validator = Validator::make(Input::all(),
			array(
				'poll' => 'required'
			),
			array(
				'required' => 'You have not selected an option.'
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('forum-topic',$id)->withErrors($validator)->withInput();
		}
		else
		{
			$pollvote = new Pollvote;
			$pollvote->polloptions_id = Input::get('poll');
			$user = User::find(Auth::user()->id);
			$pollvote->by = $user->id;
			$pollvote->save();
			return Redirect::route('forum-topic',$id);
		}
	}

}

?>
