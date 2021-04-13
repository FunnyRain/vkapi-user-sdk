<?php require_once "../autoload.php";

/**
 * Суть скрипта:
 * => Обычный бот для страницы, с возможностью ответа
 */

$user = new User("токен");

$user->getMessages()->listen(function ($peer_id, $text, $data) use ($user) {

	if ($text == 'hello')
		$user->getMessages()->sendMessage('world :3', $peer_id);

});
