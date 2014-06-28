<?php

namespace pemapmodder\pmmodpe;

use pocketmine\Server;
use pocketmine\plugin\PluginLoader;

class JsPluginLoader implements PluginLoader{
	private $cache = [];
	private $server;
	public function __construct(Server $server){
		$this->server = $server;
	}
	public function loadPlugin($file){
		$js = $this->getCachedFile($file);
	}
	public function getPluginDescription($file){
		$js = $this->getCachedFile($file);
	}
	public function getPluginFilters(){
		return "#\\.js\$#i";
	}
	public function enablePlugin(Plugin $plugin){
	}
	public function disablePlugin(Plugin $plugin){
	}
	public function getCachedFile($file){
		return isset($this->cache[$file]) ? $this->cache[$file]:JavaScript::parse(fopen($file, "rt"), true);
	}
}
