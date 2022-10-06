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
        parent::__construct("addxp", "Add xp to player", null, ["axp"]);
        $this->setPermission("autoexp.add.xp");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
        $main = $this->getOwningPlugin();
        if(!$sender instanceof Player) {
                $form = new CustomForm(function(Sender $sender, $result){
                    if($result === null){
                        return true;
                    }
                    if(trim($result[0]) === ""){
                        $sender->sendMessage("§cYou need put player name!");
                        return true;
                    }

                    if(trim($result[1]) === ""){
                        $sender->sendMessage("§cYou need put xp amount!");
                        return true;
                    }

                    $sender->getXpManager()->addXpLevels($result[0], $result[1]);
        
                });
               $form->setTitle("§l§8ADD XP");
               $form->addInput("Enter player name:");
               $form->addInput("Enter the amount of XP:");
               $player->sendForm($form);
            }
        }

    public function getOwningPlugin(): Main { 
        return Main::getInstance(); 
    }
}