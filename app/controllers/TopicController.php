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
		
		return View::make('forum/topic/topic')->with('topic', $infoTopic)->with('replies', $infoReplies);
	}

}

?>