<?php

namespace App\Admin\Application\ContextAdapters;

use App\Users\Application\ContextAPI\UsersAPI;

class UserAdapter
{
    public function __construct(public readonly UsersAPI $userApi)
    {
    }

    public static function getUserFqcn()
    {
        return UsersAPI::getEntityFqcn();
    }

    public static function getAllowedUserRoles(): array
    {
        return UsersAPI::getUserAllowedRoles();
    }
}