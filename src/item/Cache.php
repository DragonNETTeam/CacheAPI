<?php
namespace item;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\Utils;

class Cache extends PluginBase {

public static $instance = null;
public static $session = [];
public static $handler = [];


public function onEnable()
{
    self::$instance = $this;
    $this->getConfigCache();
    Server::getInstance()->getPluginManager()->registerEvents(new SessionDelete(), $this);
    Key::init();
   
}

public static function getInstance() : Cache {
    return self::$instance;
}

public static function getAPI() : AsyCallable {
    return new AsyCallable();
}
public function getConfigCache(){
@mkdir($this->getDataFolder());
if(!file_exists($this->getDataFolder()."cache.yml")){
$this->getServer()->getCommandMap()->register("cache", new TestCommand());
$data = new Config($this->getDataFolder()."cache.yml",Config::YAML,[
    "command" => true
]);
$data->save();
} else {
    $data = new Config($this->getDataFolder()."cache.yml",Config::YAML);
    if($data->get("command") == true or $data->get("command") == 1){
        $this->getServer()->getCommandMap()->register("cache", new TestCommand());
    }
}
}


}
?>