<?php

namespace HenryDM\AutoEXP\Forms;

use pocketmine\Server;
use Vecnavium\FormsUI\CustomForm;
use pocketmine\player\Player;

class RemoveXPForm {

    public function __construct() { }
    
    public function RemoveXPForm(Player $player) {
        $form = new CustomForm(function(Player $player, $result){
            if($result === null) {
                return true;
            }

            if(trim($result[0]) === ""){
                $player->sendMessage("§cYou need put xp amount!");
                return true;
            }
            
            if($result[0] <= $player->getXpManager()->getXpLevel()) { 
                $player->getXpManager()->subtractXpLevels((int)$result[0]);
            }
        });
        $form->setTitle("§l§8REMOVE XP");
        $form->addInput("Enter the amount of XP:");
        $player->sendForm($form);
    }   
}