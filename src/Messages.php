<?php

class Messages {

	private $user;

	public function __construct(User $user) {
		$this->user = $user;
	}

	public function listen($listen) {
		if (empty($this->user->token)) die('Не указан токен!');
		$this->user->VkApiRequest()->getLongPollServer();

		while ($data = $this->user->VkApiRequest()->getRequest()) {
			if (!isset($data["ts"])) {
				echo ("\nTIMESTAMP не получен...\n");
				continue;
			}

			$updates = $data['updates'];
			if (count($updates) == 0) continue;

			foreach ($updates as $key => $updates) {
				if (isset($updates[0])) {

					@list($id, $idontknow1, $idontknow2, $peer_id, $timestamp, $text_message) = $updates;
					if ($id == 4) { // Добавление нового сообщения. 
						$from = isset($updates[6]['from']) ?:
							$listen($peer_id, $text_message, $updates);
					}
				}
			}
		}
	}

	public function sendMessage(string $text, $peer_ids, array $args = []) {
		return $this->user->VkApiRequest()->api('messages.send', [
			'random_id' => rand(),
			'peer_ids' => $peer_ids,
			'message' => $text
		] + $args);
	}
}
