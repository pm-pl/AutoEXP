<?php

namespace HenryDM\AutoEXP\Events;

use HenryDM\AutoEXP\Main;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerDeathEvent;

class DeathEXP implements Listener {

    public function __construct(private Main $main) {
        $this->main = $main;
    }

    public function onDeath(PlayerDeathEvent $event) {

# ===================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $amount = $this->main->cfg->get("lose-exp-amount");
# ===================================================

        if($this->main->cfg->get("death-lose-exp") === true) {
            if(in_array($worldName, $this->getMain()->cfg->get("custom-exp-worlds", []))) {
                if($this->main->DeathXpChance()) {
                    $player->getXpManager()->subtractXpLevels($player, $amount);
                }
            }
        }
    }

    public function getMain() : Main {
        return $this->main;
    }
}