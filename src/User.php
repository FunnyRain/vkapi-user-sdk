<?php

class User {
	
	private $VkApiRequest;
	private $Account;
	
	public $token;
	public $v;
	
	public function __construct(string $token, $v = 5.126) {
		$this->token = $token;
		$this->v = $v;
		
		$this->VkApiRequest = new VkApiRequest($this);
		$this->Account = new Account($this);
	}
	
	public function VkApiRequest(): VkApiRequest {
		return $this->VkApiRequest;
	}
	
	public function getAccount(): Account {
		return $this->Account;
	}
	
	// public function getMessages(): Messages { }
	
}