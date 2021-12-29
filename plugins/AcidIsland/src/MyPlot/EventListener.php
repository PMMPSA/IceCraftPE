<?php
namespace MyPlot;

use pocketmine\block\Sapling;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\event\entity\EntityMotionEvent;
use pocketmine\event\Listener;
use pocketmine\event\level\LevelLoadEvent;
use pocketmine\event\level\LevelUnloadEvent;
use pocketmine\utils\Config;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;

use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\block\Iron;
use pocketmine\block\Cobblestone;
use pocketmine\block\Diamond;
use pocketmine\block\Emerald;
use pocketmine\block\Gold;
use pocketmine\block\Coal;
use pocketmine\block\Lava;
use pocketmine\block\Fence;
use pocketmine\block\Lapis;
use pocketmine\block\Redstone;
use pocketmine\block\Water;
use pocketmine\block\Ender;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
class EventListener implements Listener
{
    /** @var MyPlot */
    private $plugin;

    public function __construct(MyPlot $plugin){
        $this->plugin = $plugin;
		$plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
    }

    public function onLevelLoad(LevelLoadEvent $event) {
        if ($event->getLevel()->getProvider()->getGenerator() === "myplot") {
            $settings = $event->getLevel()->getProvider()->getGeneratorOptions();
            if (isset($settings["preset"]) === false or $settings["preset"] === "") {
                return;
            }
            $settings = json_decode($settings["preset"], true);
            if ($settings === false) {
                return;
            }
            $levelName = $event->getLevel()->getName();
            $filePath = $this->plugin->getDataFolder() . "worlds/" . $levelName . ".yml";
            $config = $this->plugin->getConfig();
            $default = [
			"MaxPlotsPerPlayer" => $config->getNested("DefaultWorld.MaxPlotsPerPlayer"),
                "RestrictEntityMovement" => $config->getNested("DefaultWorld.RestrictEntityMovement"),
                "ClaimPrice" => $config->getNested("DefaultWorld.ClaimPrice"),
                "ClearPrice" => $config->getNested("DefaultWorld.ClearPrice"),
                "DisposePrice" => $config->getNested("DefaultWorld.DisposePrice"),
                "ResetPrice" => $config->getNested("DefaultWorld.ResetPrice"),
            ];
            $config = new Config($filePath, Config::YAML, $default);
            foreach (array_keys($default) as $key) {
                $settings[$key] = $config->get($key);
            }
            $this->plugin->addLevelSettings($levelName, new PlotLevelSettings($levelName, $settings));
        }
    }

    public function onLevelUnload(LevelUnloadEvent $event) {
        $levelName = $event->getLevel()->getName();
        $this->plugin->unloadLevelSettings($levelName);
    }

    public function onBlockPlace(BlockPlaceEvent $event) {
        $this->onEventOnBlock($event);
    }

    public function onBlockBreak(BlockBreakEvent $event) {
        $this->onEventOnBlock($event);
    }

    public function onPlayerInteract(PlayerInteractEvent $event) {
        $this->onEventOnBlock($event);
    }

    public function onExplosion(EntityExplodeEvent $event) {
        $levelName = $event->getEntity()->getLevel()->getName();
        if (!$this->plugin->isLevelLoaded($levelName))
            return;

        $plot = $this->plugin->getPlotByPosition($event->getPosition());
        if ($plot === null) {
            $event->setCancelled(true);
            return;
        }
        $beginPos = $this->plugin->getPlotPosition($plot);
        $endPos = clone $beginPos;
        $plotSize = $this->plugin->getLevelSettings($levelName)->plotSize;
        $endPos->x += $plotSize;
        $endPos->z += $plotSize;
        $blocks = array_filter($event->getBlockList(), function($block) use($beginPos, $endPos) {
            if ($block->x >= $beginPos->x and $block->z >= $beginPos->z and $block->x < $endPos->x and $block->z < $endPos->z) {
                return true;
            }
            return false;
        });
        $event->setBlockList($blocks);
    }

    /**
     * @param BlockPlaceEvent|BlockBreakEvent|PlayerInteractEvent $event
     */
    private function onEventOnBlock($event) {
        $levelName = $event->getBlock()->getLevel()->getName();
        if (!$this->plugin->isLevelLoaded($levelName)) {
            return;
        }
        $plot = $this->plugin->getPlotByPosition($event->getBlock());
        if ($plot !== null) {
            $username = $event->getPlayer()->getName();
            if ($plot->owner == $username or $plot->isHelper($username) or $event->getPlayer()->hasPermission("myplot.admin.build.plot")) {
                if (!($event instanceof PlayerInteractEvent and $event->getBlock() instanceof Sapling))
                    return;

                /*
                 * Prevent growing a tree near the edge of a plot
                 * so the leaves won't go outside the plot
                 */
                $block = $event->getBlock();
                $maxLengthLeaves = (($block->getDamage() & 0x07) == Sapling::SPRUCE) ? 3 : 2;
                $beginPos = $this->plugin->getPlotPosition($plot);
                $endPos = clone $beginPos;
                $beginPos->x += $maxLengthLeaves;
                $beginPos->z += $maxLengthLeaves;
                $plotSize = $this->plugin->getLevelSettings($levelName)->plotSize;
                $endPos->x += $plotSize - $maxLengthLeaves;
                $endPos->z += $plotSize - $maxLengthLeaves;

                if ($block->x >= $beginPos->x and $block->z >= $beginPos->z and $block->x < $endPos->x and $block->z < $endPos->z) {
                    return;
                }
            }
        } elseif ($event->getPlayer()->hasPermission("myplot.admin.build.road")) {
            return;
        }
        $event->setCancelled(true);
    }

    public function onEntityMotion(EntityMotionEvent $event) {
        $levelName = $event->getEntity()->getLevel()->getName();
        if (!$this->plugin->isLevelLoaded($levelName))
            return;

        $settings = $this->plugin->getLevelSettings($levelName);
        if ($settings->restrictEntityMovement and !($event->getEntity() instanceof Player)) {
            $event->setCancelled(true);
        }
    }

    public function onPlayerMove(PlayerMoveEvent $event) {
		
		$player = $event->getPlayer();
		$x = $player->getX();
		$y = $player->getY();
		$z = $player->getZ();
		$level = $player->getLevel();
		$pos = new Position($x, $y + 1 , $z, $level);
		$blocks = array(8, 9);
		$effects = 'poison';
		if(in_array($player->getLevel()->getBlock($pos)->getId(), $blocks)) {
		
			$effect = Effect::getEffect(20);
			$effect1 = Effect::getEffect(2);
			$effect2 = Effect::getEffect(15);
$player->addEffect(new EffectInstance($effect, 50, 1));
$player->addEffect(new EffectInstance($effect1, 50, 1));
$player->addEffect(new EffectInstance($effect2, 50, 1));
				$player->sendPopup("§l§1•§a Bạn Đang Bị Dính A xít §1•\n§1•§a Mau Thoát ra Khỏi Đây§1 •");
		}
		//$player->removeEffect(Effect::SPEED);
		
		
		
		
		
        if (!$this->plugin->getConfig()->get("ShowPlotPopup", true))
            return;

        $levelName = $event->getPlayer()->getLevel()->getName();
        if (!$this->plugin->isLevelLoaded($levelName))
            return;

        $plot = $this->plugin->getPlotByPosition($event->getTo());
        if ($plot !== null and $plot !== $this->plugin->getPlotByPosition($event->getFrom())) {
            $plotName = TextFormat::GREEN . $plot;
            $popup = $this->plugin->getLanguage()->translateString("popup", [$plotName]);
            if ($plot->owner != "") {
                $owner = TextFormat::GREEN . $plot->owner;
                $ownerPopup = $this->plugin->getLanguage()->translateString("popup.owner", [$owner]);
                $paddingSize = floor((strlen($popup) - strlen($ownerPopup)) / 2);
                $paddingPopup = str_repeat(" ", max(0, -$paddingSize));
                $paddingOwnerPopup = str_repeat(" ", max(0, $paddingSize));
                $popup = TextFormat::WHITE . $paddingPopup . $popup . "\n" .
                         TextFormat::WHITE . $paddingOwnerPopup . $ownerPopup;
		      if($event->getPlayer()->getName() == $owner){
		  	$event->getPlayer()->sendMessage("§l§bISLAND§e đã trở về đảo của bạn");
			  }else{
				$event->getPlayer()->addTitle("§l§bISLAND", "§a§lChào mừng bạn đã đến với đảo của§e ".$owner);
			//	$this->plugin->getServer()->broadcastMessage("§l§b[§6ACIDISLAND§b]§e ".$event->getPlayer()->getName()."§6 vừa đi sang đảo của §e".$owner);
			  }
			} else {
                $ownerPopup = $this->plugin->getLanguage()->translateString("popup.available");
                $paddingSize = floor((strlen($popup) - strlen($ownerPopup)) / 2);
                $paddingPopup = str_repeat(" ", max(0, -$paddingSize));
                $paddingOwnerPopup = str_repeat(" ", max(0, $paddingSize));
                $popup = TextFormat::WHITE . $paddingPopup . $popup . "\n" .
                         TextFormat::WHITE . $paddingOwnerPopup . $ownerPopup;
						 
            }
            $event->getPlayer()->sendMessage($popup);
        }
    }
	        public function onBlockSet(BlockUpdateEvent $event){
        $block = $event->getBlock();
        $water = false;
        $lava = false;
        for ($i = 2; $i <= 5; $i++) {
            $nearBlock = $block->getSide($i);
            if ($nearBlock instanceof Water) {
                $water = true;
            } else if ($nearBlock instanceof Lava || $nearBlock instanceof Fence) {
                $lava = true;
            }
            if ($water && $lava) {
                $id = mt_rand(1, 65);
                switch ($id) {
                    case 2;
                        $newBlock = new Iron();
                        break;
                    case 4;
                        $newBlock = new Gold();
                        break;
                    case 6;
                        $newBlock = new Emerald();
                        break;
                    case 8;
                        $newBlock = new Coal();
                        break;
                    case 10;
                        $newBlock = new Redstone();
                        break;
                    case 12;
                        $newBlock = new Diamond();
                        break;
					case 14;
                        $newBlock = new Lapis();
                        break;	
						case 16;
                        $newBlock = new Block(15);
                        break;	
						case 19;
                        $newBlock = new Block(21);
					
                        break;	
						case 21;
                        $newBlock = new Block(14);
                        break;	
							case 27;
                        $newBlock = new Block(15);
                        break;	
							case 29;
                        $newBlock = new Block(56);
                        break;	
	case 25;
                        $newBlock = new Block(73);
                        break;	
							case 28;
                        $newBlock = new Block(129);
                        break;	
							case 32;
                        $newBlock = new Block(153);
                        break;	
                    default:
                        $newBlock = new Cobblestone();
                }
                $block->getLevel()->setBlock($block, $newBlock, true, false);
                return;
            }
        }
    }
}
