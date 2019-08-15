<?php
namespace item;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
class SessionDelete implements Listener {


public function removeSession(PlayerQuitEvent $event){
   if(Cache::getAPI()->existsArmor($event->getPlayer()) or Cache::getAPI()->existsArmor($event->getPlayer())){
       Cache::getAPI()->remove($event->getPlayer());
   }
}








}