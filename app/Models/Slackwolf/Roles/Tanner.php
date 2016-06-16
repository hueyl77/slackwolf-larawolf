<?php
namespace App\Models\Slackwolf\Roles;

use App\Models\Slackwolf\Role;

class Tanner extends Role
{
	public function getName() {
		return Role::TANNER;
	}

	public function getDescription() {
		return "A player not on the side of the villagers or the werewolves who wins if is killed.";
	}
}