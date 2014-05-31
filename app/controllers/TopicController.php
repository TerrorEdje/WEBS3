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
		
		$infoPollvotes = array();
		foreach ($polloptions as $polloption) {
			$amountOfPollvotes = Pollvote::where('polloptions_id', '=', $polloption->id)->count();
			$infoPollvotes[$polloption->description] = $amountOfPollvotes;
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
		
		$infoTopic['votes'] = $infoPollvotes;
			
		$firstReply = null;
		
		$infoReplies = array();
		$dbReplies = Reply::where('topics_id', '=', $id)->orderBy('created_at', 'asc')->get();
		foreach ($dbReplies as $reply) {
			if ($firstReply == null) {
				$infoReply = array();
				$infoReply['reply'] = $reply;
				$infoReply['by'] = User::find($reply->by);
				$firstReply = $infoReply;
			}
			else {
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
			$user = User::find(Auth::user()->id);
			$reply->by = $user->id;
			$reply->topics_id = $id;
			$reply->save();
			
			return Redirect::route('forum-topic',$id);
		}
	}
	
	public function getTopicCreate($id) {
		$subcategory = Subcategory::find($id);
		return View::make('forum/topic-create')->with('subcategory',$subcategory);
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
			$topic->by = Auth::user()->id;
			$topic->subcategories_id = Input::get('id');
			$topic->open = true;
			$topic->save();
			
			$reply = new Reply;
			$reply->content = Input::get('content');
			$user = User::find(Auth::user()->id);
			$reply->by = $user->id;
			$reply->topics_id = $topic->id;
			$reply->save();
		
			return Redirect::route('forum-category',Input::get('id'));
		}
	}

}

?>