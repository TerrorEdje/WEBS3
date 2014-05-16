<?php

class CategorieController extends BaseController {

	public function showCategories()
	{
		$categories = $this->getCategories();	
		
		$infoSubcategories = array(); # Bevat dadelijk alle subcategorieen (met extra info) die horen bij de hoofdcategorie
		foreach ($categories as $infoCategory) {
			foreach ($infoCategory['subcategories'] as $subcategory) {
				$infoSubcategory = array(); # Bevat dadelijk alle info van een subcategorie
				$infoSubcategory['name'] = $subcategory->name;
				$infoSubcategory['numberOfTopics'] = Topic::where('subcategories_name', '=', $subcategory->name)->count();
				array_push($infoSubcategories, $infoSubcategory);
			}
			$infoCategory['subcategories'] = $infoSubcategories;
		}
		
		return View::make('forum')->with('categories', $categories);
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
