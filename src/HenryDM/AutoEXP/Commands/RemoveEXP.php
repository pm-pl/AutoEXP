<?php

namespace HenryDM\AutoEXP\Commands;

use HenryDM\AutoEXP\Main;
use pocketmine\plugin\PluginOwned;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use Vecnavium\FormsUI\CustomForm;
use pocketmine\player\Player;

class RemoveEXP extends Command implements PluginOwned {

    public function __construct() {
        parent::__construct("removexp", "Remove xp levels", null, ["rmxp"]);
        $this->setPermission("autoexp.remove.xp");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $main = $this->getOwningPlugin();
        if($sender instanceof Player) {
            if($sender->hasPermission("autoexp.remove.xp")){
         	   Main::getInstance()->removexpform->RemoveXPForm($sender);
            }
        } else {
            $sender->sendMessage("Use this command in-game!");
        }
    }
    public function getOwningPlugin(): Main { 
        return Main::getInstance(); 
    }
}
