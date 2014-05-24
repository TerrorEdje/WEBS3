<?php

class CategoryController extends BaseController {

	public function getCategories()
	{
		$allCategories = array(); # Bevat dadelijk alle hoofdcategorieen met daaraan gekoppeld de bijbehorende subcategorieen met alle info
		$categories = $this->getMainCategories();
		foreach ($categories as $infoCategory) {
			$infoSubcategories = array(); # Bevat dadelijk alle subcategorieen met alle info van een hoofdcategorie
			foreach ($infoCategory['subcategories'] as $subcategory) {
				$infoSubcategory = array();  # Bevat dadelijk alle subcategorieen met alle info
				$infoSubcategory['name'] = $subcategory->name;
				$infoSubcategory['description'] = $subcategory->description;
				$infoSubcategory['amountOfTopics'] = $subcategory->getAmountOfTopics();
				$infoSubcategory['amountOfReplies'] = $subcategory->getAmountOfReplies();
				$infoSubcategory['lastReply'] = $subcategory->getLastReply();
				array_push($infoSubcategories, $infoSubcategory);
			}
			$infoCategory['subcategories'] = $infoSubcategories;
			array_push($allCategories, $infoCategory);
		}		
		return View::make('forum/forum')->with('categories', $allCategories);
	}
	
	public function getMainCategories() {
	
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

	public function getCategory($name)
	{
		$subcategory = Subcategory::where('name', '=', $name)->first();		
		$infoOpenTopics = array();
		$infoClosedTopics = array();
		$topics = $this->getTopicsWithInfo($name); # Deze lijst met alle topics wordt dadelijk gesplist in 2 lijsten (Open topics en gesloten topics)
		foreach ($topics as $infoTopic) {
			if($infoTopic['topic']->open == true) {
				array_push($infoOpenTopics, $infoTopic);
			}
			else {
				array_push($infoClosedTopics, $infoTopic);
			}
		}
		return View::make('forum/category')->with('subcategory', $subcategory)->with('openTopics', $infoOpenTopics)->with('closedTopics', $infoClosedTopics);
	}
	
	public function getTopicsWithInfo($name)
	{
		$allTopics = array(); # Bevat dadelijk van alle topics alle info
		
		$dbTopics = Topic::where('subcategories_name','=', $name)->get();
		foreach ($dbTopics as $topic) {
			$infoTopic = array(); # Bevat dadelijk alle info van een topic
			$infoTopic['topic'] = $topic;
			$user = User::find($topic->by);
			$infoTopic['by'] = $user->username;
			$infoTopic['amountOfReplies'] = $topic->getAmountOfReplies();
			$infoTopic['lastReply'] = $topic->getLastReply();
			array_push($allTopics, $infoTopic);
		}
		
		return $allTopics;
	}

}

?>
