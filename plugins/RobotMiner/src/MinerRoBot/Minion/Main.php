<?php

declare(strict_types=1);

namespace MinerRoBot\Minion;

use MinerRoBot\Minion\minion\Minion;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase{

	private static $instance;

	public function onLoad(): void{
		self::$instance = $this;
	}

	public function onEnable(): void{
	    Entity::registerEntity(Minion::class, true);
	    $this->saveDefaultConfig();
	    $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

	public static function get(): self{
		return self::$instance;
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
	    if($command->getName() === "robotminer"){
	        if(!$sender->hasPermission("minion.commands")){
	            $sender->sendMessage(C::RED . "You don't have permission to run this command.");
	            return false;
            }
	        if($sender instanceof ConsoleCommandSender){
	            if(!isset($args[0])){
                    $sender->sendMessage("Usage: /robotminer <player>");
                    return false;
                }
	            if(!$p = $this->getServer()->getPlayer($args[0])){
	                $sender->sendMessage(C::RED . "That player could not be found.");
	                return false;
                }
	            $this->giveItem($p);
	            return false;
            }elseif($sender instanceof Player){
	            if(isset($args[0])){
                    if(!$p = $this->getServer()->getPlayer($args[0])){
                        $sender->sendMessage(C::RED . "That player could not be found.");
                        return false;
                    }
                    $this->giveItem($p);
                    return false;
                }
	            $this->giveItem($sender);
	            return false;
            }
        }
        return true;
    }

    public function giveItem(Player $sender): void{
	    $sender->getInventory()->addItem($this->getItem($sender));
	    $sender->sendMessage(C::GREEN . "§l§e✔§abạn đã nhận được đệ tử.");
    }

    public function getItem(Player $sender, int $level = 1, string $xyz = "n"): Item{
        $item = Item::get(Item::TOTEM);
        $item->setCustomName("§l§a✇ §e§lRoBot§c>•<§eMiner §l§a✇");
        $item->setLore(
            [
                " ",
                C::GRAY . "• " . C::YELLOW . "hãy đặt ngược lại với hướng block muốn đào",
                C::GRAY . "• " . C::YELLOW . "hãy chọn hình cái rương rồi nhấn vào rương",
                C::GRAY . "• " . C::YELLOW . "nó không đào được block cao bằng nó",
                C::GRAY . "• " . C::YELLOW . "rồi hãy thử và dùng nào"
            ]
        );
        $nbt = $item->getNamedTag();
        $nbt->setString("summon", "miner");
        $nbt->setString("player", $sender->getName());
        $nbt->setString("xyz", $xyz);
        $nbt->setInt("level", $level);
        $item->setNamedTag($nbt);
        return $item;
    }
}
