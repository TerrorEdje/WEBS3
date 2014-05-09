<?php

class CategorieController extends BaseController {

	public function showCategories()
	{
		$categories = $this->getCategories();	
		return View::make('forum')->with('categories', $categories);
	}
	
	public function getCategories() {
	
		$allCategories = array();
	
		$categories = Categorie::all();
		foreach ($categories as $categorie) {
			
			$subcategories = Subcategorie::where('categories_name','=',$categorie->name)->get();
			
			$infoCategorie = array();
			$infoCategorie['categorie'] = $categorie;
			$infoCategorie['subcategories'] = $subcategories;
			
			array_push($allCategories, $infoCategorie);
		}
		
		return $allCategories;
	}
	
	/*public function showCategorieen()
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
	}*/

}

?>
