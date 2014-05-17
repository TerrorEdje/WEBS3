<?php

class TopicController extends BaseController {

	public function showTopics($name)
	{
		$infoOpenTopics = array();
		$infoClosedTopics = array();
		$topics = $this->getTopicsWithInfo($name);
		foreach ($topics as $infoTopic) {
			if($infoTopic['topic']->open == true) {
				array_push($infoOpenTopics, $infoTopic);
			}
			else {
				array_push($infoClosedTopics, $infoTopic);
			}
		}
		return View::make('topics')->with('openTopics', $infoOpenTopics)->with('closedTopics', $infoClosedTopics);
	}
	
	public function getTopicsWithInfo($name)
	{
		$allTopics = array();
		
		$dbTopics = Topic::where('subcategories_name','=', $name)->get();
		foreach ($dbTopics as $topic) {
			$infoTopic = array();
			$infoTopic['topic'] = $topic;
			$infoTopic['amountOfReplies'] = $topic->getAmountOfReplies();
			$infoTopic['lastReply'] = $topic->getLastReply();
			array_push($allTopics, $infoTopic);
		}
		
		return $allTopics;
	}
	
	/*public function showTopics($id)
	{
		$categorie = Categorie::find($id);
		if ($categorie->parent == 0) {		
			$alleTopics = array();
			$subcategorieen = Categorie::where('parent','=',$categorie->id)->get();
			foreach ($subcategorieen as $subcategorie) {
				$topics = Topic::where('categorie_id', '=', $subcategorie->id)->get();
				foreach ($topics as $topic) {
					array_push($alleTopics, $topic);
				}
			}
		}
		else {
			$alleTopics = Topic::where('categorie_id', '=', $id)->get();	
		}
		
		$openTopics = array();
		$geslotenTopics = array();
		foreach ($alleTopics as $topic) {
			if ($topic->actief == true) {
				$infoOpenTopic = array();
				$infoOpenTopic['topic'] = $topic;
				$infoOpenTopic['aantalReacties'] = Reactie::where('topic_id', '=', $topic->id)->count();
				$laatsteReactie = 0;
				$reacties = Reactie::where('topic_id', '=', $topic->id)->get();
				foreach ($reacties as $reactie) {
					$curReactie = $reactie->datum_tijd;
					if ($curReactie > $laatsteReactie) {
						$laatsteReactie = $curReactie;
					}
				}
				$infoOpenTopic['laatsteReactie'] = $laatsteReactie;
				array_push($openTopics, $infoOpenTopic);
			}
			else {
				$infoGeslotenTopic = array();
				$infoGeslotenTopic['topic'] = $topic;
				$infoGeslotenTopic['aantalReacties'] = Reactie::where('topic_id', '=', $topic->id)->count();
				$laatsteReactie = 0;
				$reacties = Reactie::where('topic_id', '=', $topic->id)->get();
				foreach ($reacties as $reactie) {
					$curReactie = $reactie->datum_tijd;
					if ($curReactie > $laatsteReactie) {
						$laatsteReactie = $curReactie;
					}
				}
				$infoGeslotenTopic['laatsteReactie'] = $laatsteReactie;
				array_push($geslotenTopics, $infoGeslotenTopic);
			}
		}
		
		return View::make('topics')->with('openTopics', $openTopics)->with('geslotenTopics', $geslotenTopics);
	}
	
	public function showTopic($id)
	{	
		$topic = Topic::find($id);
		$reacties = Reactie::where('topic_id', '=', $id)->get();
		return View::make('topic')->with('topic', $topic)->with('reacties', $reacties);
	}*/

}

?>