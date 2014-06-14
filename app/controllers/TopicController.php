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
		
		$totalAmountOfVotes = 0;
		foreach ($polloptions as $polloption) {
			$amountOfPollvotes = Pollvote::where('polloptions_id', '=', $polloption->id)->count();
			$totalAmountOfVotes = $totalAmountOfVotes + $amountOfPollvotes;
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
		$infoTopic['totalAmountOfVotes'] = $totalAmountOfVotes;
		
		$infoPollvotes = array();
		foreach ($polloptions as $polloption) {
			$infoVote = array();
			$infoVote['polloption'] = $polloption;
			$amountOfVotes = Pollvote::where('polloptions_id', '=', $polloption->id)->count();
			$infoVote['amountOfVotes'] = $amountOfVotes;
			if ($amountOfVotes != 0) {
				$res = ($amountOfVotes / $totalAmountOfVotes) * 100;
				$infoVote['percentage'] = round($res, 0);
			}
			else {
				$infoVote['percentage'] = 0;
			}
			array_push($infoPollvotes, $infoVote);
		}	
		$infoTopic['infoPollvotes'] = $infoPollvotes;
			
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
			
			if (Input::get('polloption1') != null) {
				$polloption1 = new Polloption;
				$polloption1->topics_id = $topic->id;
				$polloption1->description = Input::get('polloption1');
				$polloption1->save();
			}
			
			if (Input::get('polloption2') != null) {
				$polloption2 = new Polloption;
				$polloption2->topics_id = $topic->id;
				$polloption2->description = Input::get('polloption2');
				$polloption2->save();
			}
			
			if (Input::get('polloption3') != null) {
				$polloption3 = new Polloption;
				$polloption3->topics_id = $topic->id;
				$polloption3->description = Input::get('polloption3');
				$polloption3->save();
			}
			
			if (Input::get('polloption4') != null) {
				$polloption4 = new Polloption;
				$polloption4->topics_id = $topic->id;
				$polloption4->description = Input::get('polloption4');
				$polloption4->save();
			}
			
			if (Input::get('polloption5') != null) {
				$polloption5 = new Polloption;
				$polloption5->topics_id = $topic->id;
				$polloption5->description = Input::get('polloption5');
				$polloption5->save();
			}
		
			return Redirect::route('forum-category',Input::get('id'));
		}
	}
	
	public function getUpdateTopic($id)
	{	
		$topic = Topic::find($id);
		$reply = Reply::where('topics_id', '=', $id)->orderBy('created_at', 'asc')->first();
		return View::make('forum/updateTopic')->with('topic', $topic)->with('reply', $reply);
	}

	public function postUpdateTopic()
	{				
		$validator = Validator::make(Input::all(),
			array(
				'content' => 'required',
				'title' => 'required'
			)
		);
		
		if($validator->fails()) {
			$name = Input::get('name');
			return Redirect::route('update-topic', Input::get('topicID'))->withErrors($validator)->withInput();
		}
		else {
			$topic = Topic::find(Input::get('topicID'));
			$topic->title = Input::get('title');
			$topic->save();
			
			$reply = Reply::find(Input::get('replyID'));
			$reply->content = Input::get('content');
			$reply->save();
				
			return Redirect::route('forum-topic', $topic->id);
		}
	}
	
	public function getUpdateReply($id)
	{	
		$reply = Reply::find($id);
		return View::make('forum/updateReply')->with('reply', $reply);
	}

	public function postUpdateReply()
	{				
		$validator = Validator::make(Input::all(),
			array(
				'content' => 'required'
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('update-reply', Input::get('replyID'))->withErrors($validator)->withInput();
		}
		else
		{
			$reply = Reply::find(Input::get('replyID'));
			$reply->content = Input::get('content');
			$reply->save();
			
			return Redirect::route('forum-topic', $reply->topics_id);
		}
	}
	
	public function getDeleteReply($id)
	{
		$reply = Reply::find($id);
		Reply::where('id', '=', $id)->delete();
		return Redirect::route('forum-topic', $reply->topics_id);
	}
	
}

?>