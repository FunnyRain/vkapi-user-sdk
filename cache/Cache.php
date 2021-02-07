<?php

class Cache {
	
	public $path = __DIR__ . '/';
	public $filename;
	
	public function __construct(string $filename = 'temp.json') {
		if (!file_exists($this->path . $filename)) file_put_contents($this->path . $filename, json_encode([]));
		
		$this->filename = $filename;
	}
	
	public function set($value): void {
		$array = $this->get();
		array_push($array, $value);
		file_put_contents($this->path . $this->filename, json_encode($array));
	}
	
	public function get(): array {
		return json_decode(file_get_contents($this->path . $this->filename), 1);
	}
	
}