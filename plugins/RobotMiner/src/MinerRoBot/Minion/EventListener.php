<?php

declare(strict_types=1);

namespace MinerRoBot\Minion;

use MinerRoBot\Minion\minion\HopperInventory;
use MinerRoBot\Minion\minion\Minion;
use pocketmine\block\Chest;
use pocketmine\entity\Entity;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\nbt\tag\StringTag;
use pocketmine\utils\TextFormat as C;

use onebone\pointapi\PointAPI;

class EventListener implements Listener{

    public $linkable = [];

    public function onInv(InventoryTransactionEvent $e): void{
        $tr = $e->getTransaction();
        foreach($tr->getActions() as $act){
            if($act instanceof SlotChangeAction){
                $inv = $act->getInventory();
                if($inv instanceof HopperInventory){
                    $player = $tr->getSource();
                    $entity = $inv->getEntity();
                    $e->setCancelled();
                    switch($act->getSourceItem()->getId()){
                        case Item::REDSTONE_DUST:
                            if(isset($this->linkable[$player->getName()])) unset($this->linkable[$player->getName()]);
                            $entity->flagForDespawn();
                            $player->getInventory()->addItem(Main::get()->getItem($player, $entity->getLevelM()));
                            break;
                        case Item::CHEST:
                            if($entity->getLookingBehind() instanceof Chest){
                                $player->sendMessage(C::RED . "§l§cHãy Phá Rương sau robot miner để lấy liên kết rương khác.");
                                return;
                            }
                            if(isset($this->linkable[$player->getName()])){
                                $player->sendMessage(C::RED . "You are already on linking mode.");
                                return;
                            }
                            $this->linkable[$player->getName()] = $entity;
                            $player->sendMessage(C::LIGHT_PURPLE . "Please tap the chest that you want to link with.");
                            break;
                        case Item::EMERALD:
                            if($entity->getLevelM() >= Main::get()->getConfig()->getNested("level.max")){
                                $player->sendMessage(C::RED . "§l✘ Level đã max!");
                                return;
                            }
                            if(PointAPI::getInstance()->myPoint($player) < $entity->getCost()){
                                $player->sendMessage(C::RED . "§l✘ bạn không đủ tiền.");
                                return;
                            }
                            $entity->namedtag->setInt("level", $entity->namedtag->getInt("level") + 1);
                            $player->sendMessage(C::GREEN . "§l✔ Đã nâng cấp lên " . $entity->getLevelM());
                            PointAPI::getInstance()->reducePoint($player, $entity->getCost());
                            break;
                    }
                    $inv->onClose($player);
                }
            }
        }
    }

    public function onInteract(PlayerInteractEvent $e): void{
        $player = $e->getPlayer();
        $item = $e->getItem();
        $dnbt = $item->getNamedTag();

        if($dnbt->hasTag("summon", StringTag::class)){
            if(in_array($player->getLevel()->getFolderName(), Main::get()->getConfig()->get("worlds"))) return;
            $nbt = Entity::createBaseNBT($player, null, (90 + ($player->getDirection() * 90)) % 360);
            $nbt->setInt("level", $dnbt->getInt("level"));
            $nbt->setString("player", $player->getName());
            $nbt->setString("xyz", $dnbt->getString("xyz"));
            $nbt->setTag($player->namedtag->getTag("Skin"));
            $entity = new Minion($player->getLevel(), $nbt);
            $entity->spawnToAll();
            $item->setCount($item->getCount() - 1);
            $player->getInventory()->setItemInHand($item);
        }

        if(isset($this->linkable[$player->getName()])){
            if(!$e->getBlock() instanceof Chest){
                $player->sendMessage(C::RED . "§l✘ bạn hãy nhấn 1 cái rương " . $e->getBlock()->getName());
                return;
            }
            $entity = $this->linkable[$player->getName()];
            $block = $e->getBlock();
            if($entity instanceof Minion) $entity->namedtag->setString("xyz", $block->getX() . ":" . $block->getY() . ":" . $block->getZ());
            unset($this->linkable[$player->getName()]);
            $player->sendMessage(C::GREEN . "§l✔ Đã Liên Kết Với Rương!");
            return;
        }
    }
}
