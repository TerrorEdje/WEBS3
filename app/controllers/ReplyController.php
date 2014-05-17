<?php

class ReplyController extends BaseController {

	public function addReply($id)
	{		
		echo "REACTIE IS TOEGEVOEGD !!!";
		
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
		
		return View::make('topic')->with('topic', $infoTopic)->with('replies', $infoReplies);
	}

	
	/*public function addReactie($id)
	{	
		$reactie = new Reactie;
		$reactie->inhoud = Input::get('inhoud');
		$reactie->datum_tijd = date("Y-m-d H:i:s");
		$reactie->gebruikersnaam = Input::get('gebruikersnaam');
		$reactie->topic_id = $id;
		$reactie->save();
	
		echo "REACTIE IS TOEGEVOEGD !!!";
		
		$topic = Topic::find($id);
		$reacties = Reactie::where('topic_id', '=', $id)->get();
		return View::make('topic')->with('topic', $topic)->with('reacties', $reacties);
	}*/

}

?>