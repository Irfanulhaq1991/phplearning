<?php

namespace Irfan\Phplearning\utilities;

use Doctrine\DBAL\Types\StringType;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use Random\RandomException;

class AppSessionKeys
{
    public const CSRF_TOKEN_KEY = 'csrf_token';
    public const USER_ID_KEY = 'user_id_key';
    public const Group_ID_KEY = 'group_id_key';
}