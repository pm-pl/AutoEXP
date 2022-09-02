<?php

namespace HenryDM\AutoEXP;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

	public function onEnable() : void {
            $this->getServer()->getPluginManager()->registerEvents($this, $this);
            $this->saveDefaultConfig();
	}

	/**
	 * @param BlockBreakEvent $event
         * priority HIGHEST
         */

	public function onBreak(BlockBreakEvent $event): void {
                if($this->getConfig()->get("auto-block-exp") === true) {
                  $player = $event->getPlayer();
                  $world = $player->getWorld();
                  $worldName = $world->getFolderName();
	          if ($event->isCancelled()) {
		     return;
		}
                     if (in_array($worldName, $this->getConfig()->get("block-exp-worlds"))) {
                         $event->getPlayer()->getXpManager()->addXp($event->getXpDropAmount());
	                 $event->setXpDropAmount(0);
	    }
          }
        }

	/**
	 * @param PlayerDeathEvent $event
	 * @priority HIGHEST
	 */

	public function onKill(PlayerDeathEvent $event): void {
               if($this->getConfig()->get("auto-kill-exp") === true) {
		  $player = $event->getPlayer();
		  $cause = $player->getLastDamageCause();
                  $world = $player->getWorld();
                  $worldName = $world->getFolderName();
		  if ($cause instanceof EntityDamageByEntityEvent) {
		       $damager = $cause->getDamager();
		       if ($damager instanceof Player) {
		           $damager->getXpManager()->addXp($player->getXpDropAmount());
			   $player->getXpManager()->setCurrentTotalXp(0);

            }
         }
      } 
   }
}
