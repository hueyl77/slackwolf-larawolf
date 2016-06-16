<?php
namespace App\Models\Slackwolf\Roles;

use App\Models\Slackwolf\Role;

class WolfMan extends Werewolf
{
	public function appearsAsWerewolf() {
		return false;
	}

	public function getName() {
		return Role::WOLFMAN;
	}

	public function getDescription() {
		return "A werewolf who appears to the Seer as a Villager.";
	}
}