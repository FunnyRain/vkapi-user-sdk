<?php

class Cache {
	
	public $path = __DIR__ . '/';
	public $filename;
	
	public function __construct(string $filename, int $days = 30) {
		if (!file_exists($this->path . $filename)) file_put_contents($this->path . $filename, json_encode([
				'isRemove' => ($days <= 0) ? false : true,
				'deleteTime' => strtotime("+ {$days} minutes"), 
				'temp' => []
			]));
		
		$this->filename = $filename;
	}
	
	public function set($value): void {
		$array = $this->get();
		$array['temp'][] = $value;
		file_put_contents($this->path . $this->filename, json_encode($array));
		
		$this->checkDeleteTime();
	}
	
	public function get(): array {
		return json_decode(file_get_contents($this->path . $this->filename), 1);
	}
	
	private function checkDeleteTime(): void {
		$array = $this->get();
		if ($array['isRemove'] == true) {
			if (time() >= $array['deleteTime']) {
				unlink($this->path . $this->filename);
				echo "\n=> Временный файл удалён!\n";
			}
		}
	}
	
}