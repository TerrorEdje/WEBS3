<?php

class CategoryController extends BaseController {

	public function showCategories()
	{
		$allCategories = array(); # Bevat dadelijk alle hoofdcategorieen met daaraan gekoppeld de bijbehorende subcategorieen met alle info
		$categories = $this->getCategories();
		foreach ($categories as $infoCategory) {
			$infoSubcategories = array(); # Bevat dadelijk alle subcategorieen met alle info van een hoofdcategorie
			foreach ($infoCategory['subcategories'] as $subcategory) {
				$infoSubcategory = array();  # Bevat dadelijk alle subcategorieen met alle info
				$infoSubcategory['name'] = $subcategory->name;
				$infoSubcategory['amountOfTopics'] = $subcategory->getAmountOfTopics();
				$infoSubcategory['amountOfReplies'] = $subcategory->getAmountOfReplies();
				$infoSubcategory['lastReply'] = $subcategory->getLastReply();
				array_push($infoSubcategories, $infoSubcategory);
			}
			$infoCategory['subcategories'] = $infoSubcategories;
			array_push($allCategories, $infoCategory);
		}		
		return View::make('forum')->with('categories', $allCategories);
	}
	
	public function getCategories() {
	
		$allCategories = array(); # Bevat dadelijk alle hoofdcategorieen met daaraan gekoppeld de bijbehorende subcategorieen
	
		$dbCategories = Category::all();
		foreach ($dbCategories as $category) {
			
			$dbSubcategories = Subcategory::where('categories_name','=',$category->name)->get();
			
			$infoCategory = array(); # Bevat dadelijk alle info van een categorie
			$infoCategory['category'] = $category;
			$infoCategory['subcategories'] = $dbSubcategories;
			
			array_push($allCategories, $infoCategory);
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
