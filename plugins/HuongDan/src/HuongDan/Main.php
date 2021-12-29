<?php

namespace HuongDan;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\utils\TextFormat as C;

use HuongDan\Main;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $player, Command $command, string $label, array $args) : bool {
		switch($command->getName()){
			case "huongdan":
			if($player instanceof Player){
			    $this->OpenMenu($player);
			} else {
				$player->sendMessage("§aLệnh này chỉ có thể sử dụng trong trò chơi");
					return true;
			}
			break;
		}
	    return true;
	}

	public function OpenMenu(Player $sender){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createSimpleForm(function (Player $sender, ?int $data = null){
		$result = $data;
		if($result === null){
			return;
		    }
			switch($result){
				case 0:
				break;
			}
		}); 
		$form->setTitle("§l§a♦ §6Hướng dẫn §a♦");
		$form->setContent("§l§c•§aCác lệnh cơ bản: \n§l§b-§a/autosell§c: §eKhi full đồ bạn sẽ được tự động bán \n§l§b-§a/menu§c: §eMở giao diện tính năng trong server \n§l§b-§a/ceshopui§c: §eMua CE với giá 10 point/1 cấp \n§l§b-§a/cuahang§c: §eMở giao diện mua item vip bằng point \n§l§b-§a/muavip§c: §eMở giao diện mua point và mua vip \n§l§b-§a/pshop§c: §eMở giao diện mua đồ bằng point \n§l§b-§a/sbgui§c: §eMở giao diện skyblock \n§l§b-§a/chuyensinh§c: §eChuyển sinh để nhận nhiều quyền lời khi miner \n§l§b-§a/enchantui§c: §eMở giao diện mua enchant với 5000 xu/1 cấp \n§l§b-§a/shopui§c: §eMở giao diện cửa hàng mua item \n§l§b-§a/ah§c: §eMở giao diện chợ đen");
		$form->addButton("§l§e• §cĐóng §l§e•");
		$form->sendToPlayer($sender);
			return $form;
	}
}