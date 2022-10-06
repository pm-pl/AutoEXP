<?php

namespace HenryDM\AutoEXP\Events;

use HenryDM\AutoEXP\Main;
use pocketmine\event\Listener;

use pocketmine\event\block\BlockBreakEvent;

class BreakEXP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onBreak(BlockBreakEvent $event) {

# ===================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
# ===================================================

        if($this->main->cfg->get("break-auto-exp") === true) {
            if(in_array($worldName, $this->main->cfg->get("auto-exp-worlds", []))) {
                $event->getPlayer()->getXpManager()->addXp($event->getXpDropAmount());
                $event->setXpDropAmount(0);
            }
        }
    }
    
    public function getMain() : Main {
        return $this->main;
    }
}