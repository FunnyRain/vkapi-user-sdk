<?php

class Wall {
	
	private $user;
	private $cache;
	
	public function __construct(User $user) {
		$this->user = $user;
		$this->cache = new Cache('temp_wallIDS.json');
	}
	
	public function listen($owner_id, $call, int $sleep) {
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
			/**
			 * Прошу прощения у матерей,
			 * Чьих возбудил я дочерей.
			 * А заодно и у отцов,
			 * Чьим детям бить лицо готов.
			 * 
			 * Короче извините за sleep(), но я хуй знает как сделать задержку пушто шлёт флуд контроль.
			 * Жду героя, который это исправит, а то мне стыдно :)
			 */
			sleep($sleep);
		}
	}
	
}