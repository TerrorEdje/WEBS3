<?php

class ReactieController extends BaseController {
	
	public function addReactie($id)
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
	}

}

?>