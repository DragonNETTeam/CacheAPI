<?php
declare(strict_types=1);

namespace item;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\command\utils\CommandException;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class TestCommand extends Command implements PluginIdentifiableCommand
{

	public function __construct()
	{
		parent::__construct("cache", "§6Test commands chacheAPI", "§9use /cache", ["cache", "c", "ch"]);
	}

	/**
	 * @param CommandSender $player
	 * @param string $commandLabel
	 * @param string[] $args
	 *
	 * @return mixed
	 * @throws CommandException
	 */
	public function execute(CommandSender $player, string $commandLabel, array $args)
	{
		if ($player instanceof Player) {
                if($args[0] == "save"){
					Cache::getAPI()->add($player);
				}
				if($args[0] == "get"){
				if(Cache::getAPI()->existsArmor($player) or Cache::getAPI()->existsItem($player)){
                 Cache::getAPI()->call($player);
				}else{
					$player->sendMessage("§6[CacheAPI] §cYou have no items saved");
				}
				}

        }
    }
	/**
	 * @return Plugin
	 */
	public function getPlugin(): Plugin
	{
		return Loader::getInstance();
	}
}