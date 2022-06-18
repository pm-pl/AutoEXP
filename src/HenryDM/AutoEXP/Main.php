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
		$this->getServer()->getLogger()->info("                _        ________   _______  ");
		$this->getServer()->getLogger()->info("     /\        | |      |  ____\ \ / /  __ \ ");
		$this->getServer()->getLogger()->info("    /  \  _   _| |_ ___ | |__   \ V /| |__) |");
	        $this->getServer()->getLogger()->info("   / /\ \| | | | __/ _ \|  __|   > < |  ___/ ");
		$this->getServer()->getLogger()->info("  / ____ \ |_| | || (_) | |____ / . \| |     ");
		$this->getServer()->getLogger()->info(" /_/    \_\__,_|\__\___/|______/_/ \_\_|     ");
		$this->getServer()->getLogger()->info("");
		$this->getServer()->getLogger()->info("By HenryDM");
	        $this->getServer()->getLogger()->info("Support: https://github.com/Henry12960");
		$this->getServer()->getLogger()->info("Plugin Enable!");
	}

	/**
	 * @param BlockBreakEvent $event
	 * @priority HIGHEST
	 */
	public function onBreak(BlockBreakEvent $event): void{
		if ($event->isCancelled()) {
			return;
		}
		$event->getPlayer()->getXpManager()->addXp($event->getXpDropAmount());
		$event->setXpDropAmount(0);
	}


	/**
	 * @param PlayerDeathEvent $event
	 * @priority HIGHEST
	 */
	public function onPlayerKill(PlayerDeathEvent $event): void{
		$player = $event->getPlayer();
		$cause = $player->getLastDamageCause();
		if ($cause instanceof EntityDamageByEntityEvent) {
			$damager = $cause->getDamager();
			if ($damager instanceof Player) {
				$damager->getXpManager()->addXp($player->getXpDropAmount());
				$player->setCurrentTotalXp(0);
			}
		}
	}
}
