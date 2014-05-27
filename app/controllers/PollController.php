<?php

class PollController extends BaseController {

	public function postVote($id)
	{
		echo "Je hebt gestemd.";
		return Redirect::route('forum-topic',$id)->with('global','Je hebt gestemd.');
	}

}

?>
