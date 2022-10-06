<?php

namespace HenryDM\AutoEXP\Commands;

use HenryDM\AutoEXP\Main;
use pocketmine\plugin\PluginOwned;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use Vecnavium\FormsUI\CustomForm;
use pocketmine\player\Player;

class AddEXP extends Command implements PluginOwned {

    public function __construct() {
        parent::__construct("addxp", "Add xp levels", null, ["axp"]);
        $this->setPermission("autoexp.add.xp");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $main = $this->getOwningPlugin();
        if(!$sender instanceof Player) {
            if($sender->hasPermission("autoexp.add.xp")){
         	   Main::getInstance()->addxpform->AddXPForm($sender);
            }
        } else {
            $sender->sendMessage("Use this command in-game!")
        }

    public function getOwningPlugin(): Main { 
        return Main::getInstance(); 
    }
}