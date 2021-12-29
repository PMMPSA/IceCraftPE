<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI\CustomForm;
class InfoSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("myplot.command.info");
    }

    public function getAliases() {
        return [];
    }

    public function execute(CommandSender $sender, array $args) {
        if (!empty($args)) {
            return false;
        }
        $form = new CustomForm(function(Player $player, $data)
            {
                if(is_null($data)) return;
            });

        $player = $sender->getServer()->getPlayer($sender->getName());
        $plot = $this->getPlugin()->getPlotByPosition($player->getPosition());
        if ($plot === null) {
            $form->addLabel(TextFormat::RED . $this->translateString("notinplot"));
            return true;
        }
        $form->addLabel($this->translateString("info.about", [TextFormat::GREEN . $plot]));
        $form->addLabel($this->translateString("info.owner", [TextFormat::GREEN . $plot->owner]));
        $form->addLabel($this->translateString("info.plotname", [TextFormat::GREEN . $plot->name]));
        $helpers = implode(", ", $plot->helpers);
        $form->addLabel($this->translateString("info.helpers", [TextFormat::GREEN . $helpers]));
        $form->addLabel($this->translateString("info.biome", [TextFormat::GREEN . $plot->biome]));
        $form->sendToPlayer($sender);
        return true;
    }
}