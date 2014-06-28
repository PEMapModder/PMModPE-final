<?php

namespace pemapmodder\pmmodpe;

use pocketmine\Server;
use pocketmine\plugin\PluginLoader;

class JsPluginLoader implements PluginLoader{
	private $server;
	public function __construct(Server $server){
		$this->server = $server;
	}
}
