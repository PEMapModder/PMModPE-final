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
	private $alphabets=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	
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
//		$this->api->event("player.block.touch",array("useItemHook"));
//		$this->api->addHandler("console.command",array("procCmdHook"));
		$this->config=new Config($this->api->plugin->configPath($this)."config.yml",CONFIG_YAML,array(
			"phpversion"			=>	"1.0",
			"scriptToLoadByName"	=>	array(),
			"hadLoadedTheseScripts"	=>	array()
		));
		$this->config->reload();
		$scriptsToLoad=$this->config->get("scriptToLoadByName");
		for ($i = 0; $i < sizeof($scriptsToLoad); $i++) {
			loadscript("lmpe",$scriptsToLoad[$i],'console');
		}
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
		$scriptContent[$args[0]]=file_get_contents($this->api->plugin->configPath($this).$args[0]);
		if($scriptContent[$args[0]]===false){
			sendMsg("Cannot find file","console");
			return;
		}
		getScriptProperties($scriptContent);
	}
	private function getScriptProperties($content) {
		return false;
	}
	//hooks
	public function useItemHook($data,$event) {
		;
	}
	public function procCmdHook($data,$event) {
		;
	}
	//functions
	public function saveData($name,$data){
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
		if($receiver==="console"){
			console($output);
			return;
		}
		$receiver->sendchat($output);
	}
}