<?php
namespace App\Models\Slackwolf\Roles;

use App\Models\Slackwolf\Role;

class Werewolf extends Role
{
	public function appearsAsWerewolf() {
		return true;
	}

	public function isWerewolfTeam() {
		return true;
	}

	public function getName() {
		return Role::WEREWOLF;
	}
}