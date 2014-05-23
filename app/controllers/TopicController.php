<?php

class TopicController extends BaseController {
	
	public function getTopic($id)
	{	
		$infoTopic = array();
		$infoTopic['topic'] = Topic::find($id);
		$infoTopic['by'] = User::find($infoTopic['topic']->by);
		
		$infoReplies = array();
		$dbReplies = Reply::where('topics_id', '=', $id)->get();
		foreach ($dbReplies as $reply) {
			$infoReply = array();
			$infoReply['reply'] = $reply;
			$infoReply['by'] = User::find($reply->by);
			array_push($infoReplies, $infoReply);
		}
		
		return View::make('forum/topic')->with('topic', $infoTopic)->with('replies', $infoReplies);
	}

	public function postReply($id)
	{		
		$validator = Validator::make(Input::all(),
			array(
				'content' => 'required'
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('forum-topic',$id)->withErrors($validator)->withInput();
		}
		else
		{
			$reply = new Reply;
			$reply->content = Input::get('content');
			$reply->date = date("Y-m-d H:i:s");
			$user = User::find(Auth::user()->id);
			$reply->by = $user->id;
			$reply->topics_id = $id;
			$reply->save();
			
			return Redirect::route('forum-topic',$id);
		}
	}

}

?>