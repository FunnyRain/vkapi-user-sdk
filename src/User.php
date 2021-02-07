<?php

class User {
	
	private $VkApiRequest;
	private $Account;
	private $Wall;
	private $Likes;
	private $Messages;
	
	public $token;
	public $v;
	
	public function __construct(string $token, $v = 5.126) {
		$this->token = $token;
		$this->v = $v;
		
		$this->VkApiRequest = new VkApiRequest($this);
		$this->Account = new Account($this);
		$this->Wall = new Wall($this);
		$this->Likes = new Likes($this);
		$this->Messages = new Messages($this);
	}
	
	public function VkApiRequest(): VkApiRequest {
		return $this->VkApiRequest;
	}
	
	public function getAccount(): Account {
		return $this->Account;
	}
	
	public function getWall(): Wall {
		return $this->Wall;
	}
	
	public function getLikes(): Likes {
		return $this->Likes;
	}
	
	public function getMessages(): Messages {
		return $this->Messages;
	}
	
}