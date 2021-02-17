<?php

class Wall {

	private $user;
	private $cache;
	private $update_time;

	public function __construct(User $user) {
		$this->user = $user;
		$this->cache = new Cache('temp_wallIDS.json', 30);
		$this->update_time = time();
	}

	public function listen($owner_id, $call, int $sleep) {
		while (true) {
			if (time() >= $this->update_time) {
				$data = $this->user->VkApiRequest()->api('wall.get', [
					'owner_id' => $owner_id,
					'count' => 5,
					'filter' => 'owner'
				]);
				$items = $data['items'];
				if (count($items) == 0) continue;

				foreach ($items as $key => $item) {
					if (!in_array($item['id'], $this->cache->get()['temp'])) {
						$this->cache->set($item['id']);
						$call($item);
					}
				}
				$this->update_time = strtotime("+ {$sleep} seconds");
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
		// Хахахаха нахуй это отсюда
		// sleep($sleep);
	}
}
