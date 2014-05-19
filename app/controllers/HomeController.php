<?php

class HomeController extends BaseController {

	public function showCategorieen()
	{
		$categorieen = array();	
		$hoofdcategorieen = Categorie::where('parent','=',0)->get(); # Alle hoofdcategorieen
		foreach ($hoofdcategorieen as $hoofdcategorie) {
			
			$infoCategorie = array();
			$infoCategorie['hoofdcategorie'] = $hoofdcategorie;
			
			$infoSubcategorieen = array();
			$subcategorieen = Categorie::where('parent','=',$hoofdcategorie->id)->get(); # Alle subcategorieen van een hoofdcategorie
			foreach ($subcategorieen as $subcategorie) {
				$infoSubcategorie = array();
				$infoSubcategorie['subcategorie'] = $subcategorie;
				$infoSubcategorie['aantalTopics'] = Topic::where('categorie_id', '=', $subcategorie->id)->count(); # Het aantal topics van een subcategorie
				$infoSubcategorie['aantalReacties'] = 0;
				$laatsteReactie = 0;
				$topics = Topic::where('categorie_id', '=', $subcategorie->id)->get(); # Alle topics van een subcategorie
				foreach ($topics as $topic) {
					$aantalReacties = Reactie::where('topic_id', '=', $topic->id)->count(); # Het aantal reacties van een subcategorie
					$infoSubcategorie['aantalReacties'] = $infoSubcategorie['aantalReacties'] + $aantalReacties;
					$reacties = Reactie::where('topic_id', '=', $topic->id)->get(); # Alle reacties bij een topic in een subcategorie
					foreach ($reacties as $reactie) {
						$curReactie = $reactie->datum_tijd;
						if ($curReactie > $laatsteReactie) {
							$laatsteReactie = $curReactie;
						}
					}
				}
				$infoSubcategorie['laatsteReactie'] = $laatsteReactie;
				array_push($infoSubcategorieen, $infoSubcategorie); # Voegt info van één subcategorie toe aan de array met alle info van de subcategorieen
			}
		
			$infoCategorie['subcategorieen'] = $infoSubcategorieen;
			array_push($categorieen, $infoCategorie); # Voegt alle info (hoofdcategorie met de bijbehorende subcategorieen) toe aan de array
		}
		return View::make('home')->with('categorieen', $categorieen);
	}
	
	public function home()
	{
		return View::make('home');
	}

}

?>
