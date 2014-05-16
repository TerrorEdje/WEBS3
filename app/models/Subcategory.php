<?php

	class Subcategory extends Eloquent {

		public $timestamps = false;
	
		protected $table = 'subcategories';
		
		public function getAmountOfTopics()
		{
			$amountOfTopics = Topic::where('subcategories_name', '=', $this->name)->count();
			if (isset($amountOfTopics)) {
				return $amountOfTopics;
			}
		}
		
		public function getAmountOfReplies() 
		{
			$amountOfReplies = 0;
			$topics = Topic::where('subcategories_name', '=', $this->name)->get();
			foreach ($topics as $topic) {
				$amountOfReplies = $amountOfReplies + Reply::where('topics_id', '=', $topic->id)->count();
			}
			if (isset($amountOfReplies)) {
				return $amountOfReplies;
			}
		}
		
		public function getLastReply() 
		{
			$lastReply = 0;
			$topics = Topic::where('subcategories_name', '=', $this->name)->get();
			foreach ($topics as $topic) {
				$replies = Reply::where('topics_id', '=', $topic->id)->get();
				foreach ($replies as $reply) {
					$curReply = $reply->date;
					if ($curReply > $lastReply) {
						$lastReply = $curReply;
					}
				}
			}
			if (isset($lastReply) & $lastReply != 0) {
				return date("d-m-Y H:i", strtotime($lastReply));
			}
		}
		
	}

?>