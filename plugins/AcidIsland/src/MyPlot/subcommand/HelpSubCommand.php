<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI\CustomForm;
class HelpSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return $sender->hasPermission("myplot.command.help");
    }

    /**
     * @return \MyPlot\Commands
     */
    private function getCommandHandler()
    {
        return $this->getPlugin()->getCommand($this->translateString("command.name"));
    }

    public function execute(CommandSender $sender, array $args) {
        if (count($args) === 0) {
            $pageNumber = 1;
        } elseif (is_numeric($args[0])) {
            $pageNumber = (int) array_shift($args);
            if ($pageNumber <= 0) {
                $pageNumber = 1;
            }
        } else {
            return false;
        }

        if ($sender instanceof ConsoleCommandSender) {
            $pageHeight = PHP_INT_MAX;
        } else {
            $pageHeight = 5;
        }

        $commands = [];
        foreach ($this->getCommandHandler()->getCommands() as $command) {
            if ($command->canUse($sender)) {
                $commands[$command->getName()] = $command;
            }
        }
        ksort($commands, SORT_NATURAL | SORT_FLAG_CASE);
        $commands = array_chunk($commands, $pageHeight);
         $this->help($sender);
    }
    public function ailenh($sender){
        $formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result === null){
          }
          switch($result){
              case 0:
              break;
}
 });
        $form->setTitle("§7[ §c§l lệnh §e acidland §r§7]");
        $form->setContent("§a►§b-§c►§d=§e►§f-§9► §e§lBảng lệnh §aAcid§eLand§9◄§f-§e◄§d=§c◄§b-§a◄§r§l\n§f►§e /ai auto§7 - §fĐi đến một hòn đảo\n§f►§e /ai claim§7 - §fNhận ngay hòn đảo bạn đang đứng\n§f►§e /ai addhelper §e<player>§7 - §fThêm người vào đảo của bạn\n§f►§e /ai removehelper §e<player>§7 - §fXóa người chơi trong đảo của bạn\n§f►§e /ai homes§7 - §fDanh sách đảo của bạn\n§f►§e /ai home §e<Số> §7 - §fDịch chuyển về đảo của bạn\n§f►§e /ai info§7 - §fXem thông tin hòn đảo\n§f►§e /ai give §e<Tên người chơi> §7 - §fCho người khác hòn đảo của bạn\n§f►§e /ai warp §e<X;Y> §7 - §fDi chuyển đến hòn đảo nào đó\n §2by Phuongaz, Edit Hằng Xinh Gái");
        $form->addButton("§7》§c§lThoát ra§r§7《");
        $form->sendToPlayer($sender);
}
	 public function help($sender){
        $formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result === null){
          }
          switch($result){
              case 0:
              break;
              case 1:
              $this->aiui($sender);
              break;
              case 2:
              $command = "huongdan";
              $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 3:
              $command = "luat";
              $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 4:
              $this->ailenh($sender);
              break;
         }
        });
        $form->setTitle("§3§lAi HeLp");
		$form->addButton("§7》§c§lThoát§r§7《");
		$form->addButton("§2➻§4❥§3§lAiUI§6★§2彡");
		$form->addButton("§2➻§4❥§3§lHưỚnG DẫN§66★§2彡");
		$form->addButton("§2➻§4❥§3§lLuẬt§6★§2彡");
		$form->addButton("§2➻§4❥§3§lLAi Lệnh6★§2彡");
        $form->sendToPlayer($sender);
	}
	 public function aiui($sender){
        $formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result === null){
          }
          switch($result){
              case 0:
              break;
              case 1:
              $command = "ai auto";
              $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 2:
              $command = "ai claim";
              $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 3:
              $this->home
($sender);
              break;
              case 4:
              $this->addhelper
($sender);
              break;
              case 5:
              $this->removehelper
($sender);
              break;
              case 6:
              $this->give
($sender);
              break;
              case 7:
              $command = "ai info";
              $this->getPlugin()->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 8:
              $this->warp
($sender);
              break;
          }
        });
        $form->setTitle("§3§AiUi");
		$form->addButton("§7》§c§lThoát§r§7《");
		$form->addButton("§2➻§4❥§3§lTạO ĐảO§6★§2彡");
		$form->addButton("§2➻§4❥§3§lNhẬn ĐảO§6★§2彡");
		$form->addButton("§2➻§4❥§3§lVề ĐảO§6★§2彡");
        $form->addButton("§2➻§4❥§3§lThÊm Hổ TrỢ§6★§2彡");
		$form->addButton("§2➻§4❥§3§lXóA Hổ TrỢ§6★§2彡");
		$form->addButton("§2➻§4❥§3§lTặNg ĐảO§6★§2彡");
		$form->addButton("§2➻§4❥§3§lThÔnG TiN ĐảO§6★§2彡");
		$form->addButton("§2➻§4❥§3§l QuA ĐảO KhÁc§6★§2彡");
        $form->sendToPlayer($sender);
	}
	public function home($player){
		$formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "ai home $data[0]";
			$this->getPlugin()->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§3§lHome");
		$form->addInput("§eNhập Số Đảo Bạn Muống Về");
		$form->sendToPlayer($player);
	}
	public function addhelper($player){
		$formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "ai addhelper $data[0]";
			$this->getPlugin()->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§3Helper");
		$form->addInput("§eNhập Tên Người Muống Thêm Hổ Trợ");
		$form->sendToPlayer($player);
	}
	public function removehelper($player){
		$formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "ai removehelper $data[0]";
			$this->getPlugin()->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§3§lRemove helpper");
		$form->addInput("§eNhập tên Người Muống Xoá Hổ Trợ");
		$form->sendToPlayer($player);
	}
	public function give($player){
		$formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "ai give $data[0]";
			$this->getPlugin()->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§3GIVE");
		$form->addInput("§eNhập Tên Người Mà Bạn Muống Chuyển Đảo ");
		$form->sendToPlayer($player);
	}
	public function warp($player){
		$formapi = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "ai warp $data[0]";
			$this->getPlugin()->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§3warp");
		$form->addInput("§eNhập Toạ Độ Đảo Bạn Muống Đến");
		$form->sendToPlayer($player);
	}
}
