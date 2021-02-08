<?php

class Account {
	
	private $user;
	
	public function __construct(User $user) {
		$this->user = $user;
	}
	
	/*public function getId() {
		return $this->user->VkApiRequest()->api('account.getProfileInfo', [])['id'];
	}*/
	
	public function ban(int $owner_id = 1) {
		return $this->user->VkApiRequest()->api('account.ban', ['owner_id' => $owner_id]);
	}
	
}