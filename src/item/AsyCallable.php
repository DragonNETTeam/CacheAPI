<?php
namespace item;
use pocketmine\Player;
use item\Cache;
class AsyCallable {

public function add(Player $player){
    if(!isset(Cache::$session[$player->getName()]) or !isset(Cache::$handler[$player->getName()]) && $player->getGamemode() == 0 or $player->getGamemode() == 2){
        Cache::$session[$player->getName()] = $player->getInventory()->getContents();
        Cache::$handler[$player->getName()] = $player->getArmorInventory()->getContents();
        $player->sendMessage("§7[§l§c!§r§7] §bYour inventory has been saved in ID: §9".count(Cache::$session));
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
    }else {
       $this->remove($player);
        Cache::$session[$player->getName()] = $player->getInventory()->getContents();
        Cache::$handler[$player->getName()] = $player->getArmorInventory()->getContents();
        $player->sendMessage("§7[§l§c!§r§7] §bYour inventory has been saved in ID: §9".count(Cache::$session));
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
    }
}

public function remove(Player $player){
if(isset(Cache::$session[$player->getName()])){
    unset(Cache::$session[$player->getName()]);
}
if(isset(Cache::$handler[$player->getName()])){
    unset(Cache::$handler[$player->getName()]);
}
}

public function call(Player $player){
    if(isset(Cache::$session[$player->getName()])){
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $player->getInventory()->setContents(Cache::$session[$player->getName()]);
        $player->getArmorInventory()->setContents(Cache::$handler[$player->getName()]);
        $this->remove($player);
    }
}

public function callPlayer(Player $player,$sujeto){
    if(isset(Cache::$handler[$sujeto]) && isset(Cache::$session[$sujeto])){
        $player->getInventory()->setContents(Cache::$session[$sujeto]);
        $player->getArmorInventory()->setContents(Cache::$handler[$sujeto]);
        $player->sendMessage("§6[CacheAPI]§7:§a You have placed the player's items: §b".$sujeto);
    }
}

public static function existsItem(Player $player) : bool{
    if(isset(Cache::$session[$player->getName()]) && isset(Cache::$handler[$player->getName()])){
        return true;
    }else{
        return false;
    }
}

public static function existsArmor(Player $player) : bool{
    if(isset(Cache::$session[$player->getName()]) && isset(Cache::$handler[$player->getName()])){
        return true;
    }else{
        return false;
    }
}



}