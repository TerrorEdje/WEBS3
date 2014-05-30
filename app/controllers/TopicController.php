<?php

class TopicController extends BaseController {
	
	public function getTopic($id)
	{	
		$topic = Topic::find($id);
		$infoTopic = array();
		$infoTopic['topic'] = $topic;
		$infoTopic['by'] = User::find($infoTopic['topic']->by);
		
		$polloptions = $topic->getPolloptions();
		$infoTopic['polloptions'] = $polloptions;
		$infoTopic['voted'] = false;
		
		$user = User::find(Auth::user()->id);
		foreach ($polloptions as $polloption) {
			if ($infoTopic['voted'] != true) {
				$pollvotes = Pollvote::where('polloptions_id', '=', $polloption->id)->get();
				foreach ($pollvotes as $pollvote) {
					if ($pollvote->by == $user->id) {
						$infoTopic['voted'] = true;
						break;
					}
				}
			}
		}
			
		$firstReply = null;
		
		$infoReplies = array();
		$dbReplies = Reply::where('topics_id', '=', $id)->orderBy('date', 'asc')->get();
		foreach ($dbReplies as $reply) {
			if ($firstReply == null) {
				$reply->date = date("d-m-Y H:i", strtotime($reply->date));
				$infoReply = array();
				$infoReply['reply'] = $reply;
				$infoReply['by'] = User::find($reply->by);
				$firstReply = $infoReply;
			}
			else {
				$reply->date = date("d-m-Y H:i", strtotime($reply->date));
				$infoReply = array();
				$infoReply['reply'] = $reply;
				$infoReply['by'] = User::find($reply->by);
				array_push($infoReplies, $infoReply);
			}
		}
		
		return View::make('forum/topic')->with('topic', $infoTopic)->with('reply', $firstReply)->with('replies', $infoReplies);
	}

	public function postReply($id)
	{		
		$validator = Validator::make(Input::all(),
			array(
				'content' => 'required'
			),
			array(
				'required' => 'You have not written a reply.'
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
	
	public function getTopicCreate($name) {
		return View::make('forum/topic-create')->with('name',$name);
	}
	
	public function postTopicCreate() {
		$validator = Validator::make(Input::all(),
			array(
				'content' => 'required',
				'title' => 'required'
			)
		);
		
		if($validator->fails()) {
			$name = Input::get('name');
			return Redirect::route('forum-topic-create', $name)->withErrors($validator)->withInput();
		}
		else {
			$topic = new Topic;
			$topic->title = Input::get('title');
			$topic->date = date("Y-m-d H:i:s");
			$topic->by = Auth::user()->id;
			$topic->subcategories_name = Input::get('name');
			$topic->open = true;
			$topic->save();
			
			$reply = new Reply;
			$reply->content = Input::get('content');
			$reply->date = date("Y-m-d H:i:s");
			$user = User::find(Auth::user()->id);
			$reply->by = $user->id;
			$reply->topics_id = $topic->id;
			$reply->save();
		
			return Redirect::route('forum-category',Input::get('name'));
		}
	}

}

?>