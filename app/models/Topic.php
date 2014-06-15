<?php

	class Topic extends Eloquent {
	
		protected $table = 'topics';
		
		# Geeft het aantal replies van de topic terug
		public function getAmountOfReplies() 
		{
			$amountOfReplies = Reply::where('topics_id', '=', $this->id)->count();
			if (isset($amountOfReplies)) {
				return $amountOfReplies;
			}
		}
		
		# Geeft de datum van de laaste reply van de topic terug
		public function getLastReply() 
		{
			$lastReply = 0;
			$replies = Reply::where('topics_id', '=', $this->id)->get();
			foreach ($replies as $reply) {
				$curReply = $reply->created_at->format('Y-m-d H:i:s');;
				if ($curReply > $lastReply) {
					$lastReply = $curReply;
				}
			}
			if (isset($lastReply) & $lastReply != 0) {
				return date("d-m-Y H:i", strtotime($lastReply));
			}
		}
		
		# Geeft de polloptions van de topic terug
		public function getPolloptions() 
		{
			$polloptions = Polloption::where('topics_id', '=', $this->id)->get();
			if (isset($polloptions)) {
				return $polloptions;
			}
		}
		
	}

?>