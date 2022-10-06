<?php

namespace HenryDM\AutoEXP;

# =======================
#    Pocketmine Class
# =======================

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

# =======================
#      Plugin Class
# =======================

use HenryDM\AutoEXP\Events\BreakEXP;
use HenryDM\AutoEXP\Events\DeathEXP;
use HenryDM\AutoEXP\Events\KillEXP;

use HenryDM\AutoEXP\Commands\AddEXP;
use HenryDM\AutoEXP\Commands\RemoveEXP;

use HenryDM\AutoEXP\Forms\AddXPForm;
use HenryDM\AutoEXP\Forms\RemoveXPForm;

class Main extends PluginBase implements Listener {  
    
    /*** @var Main|null */
    private static Main|null $instance;

    /*** @var Config */
    public Config $cfg;    
    
    /*** @var AddXPForm[] */
    public AddXPForm $addxpform; 
    
    /*** @var RemoveXPForm[] */
    public RemoveXPForm $removexpform; 

    public function onEnable() : void {
        $this->saveResource("config.yml");
        $this->cfg = $this->getConfig();
		$this->commands();
        $this->loadForms();

        $events = [
            BreakEXP::class,
			DeathEXP::class,
            KillEXP::class
        ];
        foreach($events as $ev) {
            $this->getServer()->getPluginManager()->registerEvents(new $ev($this), $this);
        }
    }

	private function commands() : void {
		$this->getServer()->getCommandMap()->register("addxp", new AddEXP());
		$this->getServer()->getCommandMap()->register("removexp", new RemoveEXP());
	}

    public function onLoad() : void {
        self::$instance = $this;
    }

    public static function getInstance() : Main {
        return self::$instance;
    }

    public function loadForms() {
		$this->addxpform = new AddXPForm($this);
		$this->removexpform = new RemoveXPForm($this);
    }

	public function DeathXpChance() {
        $deathXP = mt_rand(1, 100);
        $dXPChance = $this->cfg->get("death-lose-exp-chance");
        if($deathXP <= $dXPChance) {
            return true;
        } else{
            return false;
    	}
    }
}