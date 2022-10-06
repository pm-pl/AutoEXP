<?php

namespace HenryDM\AutoEXP\Events;

use HenryDM\AutoEXP\Main;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;

class KillEXP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {
# ===================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $cause = $player->getLastDamageCause();
# ===================================================
        if($this->main->cfg->get("kill-auto-exp")) {
            if($cause instanceof EntityDamageByEntityEvent) {
                $damager = $cause->getDamager();
                if($damager instanceof Player) {
                    if(in_array($worldName, $this->main->cfg->get("auto-exp-worlds", []))) {                       
                        $damager->getXpManager()->addXp($player->getXpDropAmount());
                        $player->getXpManager()->setCurrentTotalXp(0);
                    }
                }
            }
        }          
    }

    public function getMain() : Main {
        return $this->main;
    }
}