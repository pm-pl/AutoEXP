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
        if(!$sender instanceof Player) {
                $form = new CustomForm(function(Player $player, $result){
                    if($result === null) {
                        return true;
                    }

                    if(trim($result[0]) === ""){
                        $player->sendMessage("§cYou need put xp amount!");
                        return true;
                    }

                    $player->getXpManager()->subtractXpLevels($result[0]);
        
                });
               $form->setTitle("§l§8REMOVE XP");
               $form->addInput("Enter the amount of XP:");
               $player->sendForm($form);
            } else {
                $sender->sendMessage("Use command in-gam!");   
            }
        }

    public function getOwningPlugin(): Main { 
        return Main::getInstance(); 
    }
}
