<?php

class Likes {
	
	private $user;
	
	public function __construct(User $user) {
		$this->user = $user;
	}
	
	public function add(string $type, int $owner_id, int $item_id) {
		return $this->user->VkApiRequest()->api('likes.add', [
			'type' => $type,
			'owner_id' => $owner_id,
			'item_id' => $item_id
		]);
	}
	
}