<?php

/*
__PocketMine Plugin__
name=PMModPE
description=run modpe scripts
version=1.0
apiversion=10
author=PEMapModder
class=PMModPE
*/
class PMModPE implements Plugin {
	private $api;
	public function __construct() {
		$this->api=$api;
	}
	public function __destruct() {
		;
	}
	public function init() {
		$this->api->console->register("loadmodscript","<filename> loads a ModPE Script",array($this,"loadscript"));
		$this->api->console->register("loadmodpe","<filename> loads a ModPE Script",array($this,"loadscript"));
		$this->api->console->register("lmpe","<filename> loads a ModPE Script",array($this,"loadscript"));
		$this->api->console->register("unloadmodscript","<filename> unloads a ModPE Script",array($this,"unloadscript"));
		$this->api->console->register("unloadmodpe","<filename> unloads a ModPE Script",array($this,"unloadscript"));
		$this->api->console->register("umpe","<filename> unloads a ModPE Script",array($this,"unloadscript"));
		$this->api->event("player.block.touch",array("useItemHook"));
		$this->api->addHandler("console.command",array("procCmdHook"));
		$this->config=new Config($this->api->plugin->configPath($this)."config.yml",CONFIG_YAML,array(
			"phpversion"			=>	"1.0",
			"scriptToLoadByName"	=>	array()
		));
	}
	public function loadscript($cmd,$args,$issuer) {
		if ($issuer!=='console') {
			sendMsg("This command is only available by the console.",$issuer);
			return;
		}
		if ($args[0]=="") {
			console("Usage: /".$cmd." <filename>");
			return;
		}
		$scriptContent[$args[0]]=file_get_contents($args[0]);
		if($scriptContent[$args[0]]===false){
			console("Cannot find file");
			return;
		}
		
	}
	//hooks
	public function useItemHook($data,$event) {
		;
	}
	public function procCmdHook($data,$event) {
		;
	}
	public function sendMsg($msg,$receiver=false) {
		$msg="[PMModPE] ".$msg;
		$outarray=split(" ",$msg);
		$output="";
		for ($i = 0; $i < sizeof($outarray); $i++) {
			$output=$output.$outarray."\n";
		}
		if ($receiver===false) {
			$this->api->chat->broadcast($output);
			return;
		}
		$receiver->sendchat($output);
	}
}