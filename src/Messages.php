<?php

class Messages {
	
	private $user;
	
	public function __construct(User $user) {
		$this->user = $user;
	}
	
	public function sendMessage(string $text, $peer_ids, array $args = []) {
		return $this->user->VkApiRequest()->api('messages.send', [
			'random_id' => rand(),
			'peer_ids' => $peer_ids,
			'message' => $text
		] + $args);
	}
	
}