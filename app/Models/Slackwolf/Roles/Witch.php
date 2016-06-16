<?php
namespace App\Models\Slackwolf\Roles;

use App\Models\Slackwolf\Role;

class Witch extends Role
{
    public function getName() {
        return Role::WITCH;
    }

    public function getDescription() {
        return "A villager who has 1 healing potion and 1 poison potion and may heal and/or kill targets at night, but can only do each action once per game.";
    }
}