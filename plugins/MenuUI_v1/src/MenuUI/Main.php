<?php

namespace MenuUI;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\utils\TextFormat as C;

use MenuUI\Main;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	}
	
	public function onCommand(CommandSender $player, Command $command, string $label, array $args) : bool {
		switch($command->getName()){
			case "menu":
			if($player instanceof Player){
			    $this->OpenMenuMuaDo($player);
			} else {
				$player->sendMessage("§cLệnh này chỉ có thể sử dụng trong trò chơi");
					return true;
			}
			break;
		}
	    return true;
	}

	public function OpenMenuMuaDo(Player $sender){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createSimpleForm(function (Player $sender, ?int $data = null){
		$result = $data;
		if($result === null){
			return;
		    }
			switch($result){
				case 0:
				$cmd = "enchantui";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 1:
				$cmd = "vip";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 2:
				$cmd = "cuahang";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 3:
				$cmd = "pshop";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 4:
				$cmd = "sbgui";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 5:
				$cmd = "ceshopui";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 6:
				$cmd = "chuyensinh";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 7:
				$cmd = "shopui";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
				break;
				case 8:
				$cmd = "ah";
				$this->getServer()->getCommandMap()->dispatch($sender, $cmd);
			}
		});
		$form->setTitle("§l§a♦ §6MenuUI §a♦");
		$form->setContent("§l§aChọn 1 Ô Bất Kì");
		$form->addButton("§l§e• §bMua Enchant §l§e•");
		$form->addButton("§l§e• §bMua VIP §l§e•");
		$form->addButton("§l§e• §bCửa Hàng §l§e•");
		$form->addButton("§l§e• §bPoint Shop§l§e•");
		$form->addButton("§l§e• §bSkyblock §l§e•");
		$form->addButton("§l§e• §bMua CE §l§e•");
		$form->addButton("§l§e• §bChuyển Sinh§e•");
		$form->addButton("§l§e• §bShop§e•");
		$form->addButton("§l§e• §bChợ Đen§e•");
		$form->sendToPlayer($sender);
			return $form;
	}
}