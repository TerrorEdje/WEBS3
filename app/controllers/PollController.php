<?php

class PollController extends BaseController {

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
			return Redirect::route('forum-topic',$id)->with('global','Je hebt gestemd.');
		}
	}

}

?>
