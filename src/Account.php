<?php

class Account {
	
	private $user;
	
	public function __construct(User $user) {
		$this->user = $user;
	}
	
	public function getId() {
		return $this->user->VkApiRequest()->api('account.getProfileInfo', [])['id'];
	}
	
}