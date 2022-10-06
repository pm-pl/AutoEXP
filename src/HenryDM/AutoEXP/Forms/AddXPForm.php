<?php

namespace HenryDM\AutoEXP\Forms;

use pocketmine\Server;
use Vecnavium\FormsUI\CustomForm;
use pocketmine\player\Player;

class AddXPForm {
 
    public function __construct() { }

    public function AddXPForm(Player $player) {
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
        $form->setTitle("§l§8ADD XP");
        $form->addInput("Enter the amount of XP:");
        $player->sendForm($form);
    }   
}