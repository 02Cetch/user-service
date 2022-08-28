<?php

namespace App\Admin\Infrastructure\ContextAdapters;

use App\Users\Infrastructure\ContextAPI\UsersAPI;

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
