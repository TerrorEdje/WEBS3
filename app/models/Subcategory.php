<?php

	class Subcategory extends Eloquent {

		public $timestamps = false;
	
		protected $table = 'subcategories';
		
		public function getAmountOfTopics()
		{
			$amountOfTopics = Topic::where('subcategories_name', '=', $this->name)->count();
			if (isset($amountOfTopics))
			{
				return $amountOfTopics;
			}
		}
		
	}

?>