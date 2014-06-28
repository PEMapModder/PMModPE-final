<?php

namespace pemapmodder\pmmodpe\Main;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginLoadOrder;

class Main extends PluginBase{
	private $cacheDir;
	public function onEnable(){
		@mkdir($this->getDataFolder());
		@mkdir($this->cacheDir = $this->getDataFolder()."cache/");
		$this->getServer()->getPluginManager()->registerInterface("pemapmodder\\pmmodpe\\JsPluginLoader");
		$this->getServer()->getPluginManager()->loadPlugins($this->getServer()->getPluginPath(), ["pemapmodder\\pmmodpe\\JsPluginLoader"]);
		$this->getServer()->enablePlugins(PluginLoadOrder::STARTUP);
		$this->getLogger()->info("Finished loading plugins");
	}
}
