<?php

class Wall {
	
	private $user;
	private $cache;
	
	public function __construct(User $user) {
		$this->user = $user;
		$this->cache = new Cache('temp_wallIDS.json');
	}
	
	public function listen($owner_id, $call) {
		while ($data = $this->user->VkApiRequest()->api('wall.get', [
			'owner_id' => $owner_id,
			'count' => 10,
			'filter' => 'owner'
		])) {
			$items = $data['items'];
			if (count($items) == 0) continue;
			
			foreach ($items as $key => $item) {
				
				if (!in_array($item['id'], $this->cache->get())) {
					$this->cache->set($item['id']);
					$call($item);
				}
				
			}
		}
	}
	
}