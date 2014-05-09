<?php

class CategorieController extends BaseController {
	
	public function showCategorieen()
	{
		$categorieen = $this->getCategorieen();	
		return View::make('beheerCategorieen')->with('categorieen', $categorieen);
	}
	
	public function categorieWijzigen($id)
	{	
		return View::make('test');
	}
	
	public function categorieVerwijderen($id)
	{	
		return View::make('test');
	}
	
	public function getCategorieen() {
	
		$categorieen = array();	
		$hoofdcategorieen = Categorie::where('parent','=',0)->get();
		
		foreach ($hoofdcategorieen as $hoofdcategorie) {
			
			$subcategorieen = Categorie::where('parent','=',$hoofdcategorie->id)->get();
			
			$infoCategorie = array();
			$infoCategorie['hoofdcategorie'] = $hoofdcategorie;
			$infoCategorie['subcategorieen'] = $subcategorieen;
			
			array_push($categorieen, $infoCategorie);
		}
		
		return $categorieen;
	}

}

?>
