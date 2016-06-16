<?php
namespace App\Models\Slackwolf\Roles;

use App\Models\Slackwolf\Role;

class Villager extends Role
{
	public function getName() {
		return Role::VILLAGER;
	}
}