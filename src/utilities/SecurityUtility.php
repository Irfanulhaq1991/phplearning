<?php

namespace Irfan\Phplearning\utilities;

use Doctrine\DBAL\Types\StringType;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use Random\RandomException;

class SecurityUtility
{

    public const CSRF_TOKEN_KEY = 'csrf_token';

    public function __construct(private readonly SessionManagerContract $sessionManager)
    {
    }

    public function createCsrfToken(): string
    {
        try {

            $token = bin2hex(random_bytes(32));
            $this->sessionManager->saveValue(self::CSRF_TOKEN_KEY, $token);
            return $token;
        } catch (RandomException $e) {
            echo $e; // creation custom exceptoin
            return "prblemcreateCsrfToken";
        }
    }

    public function checkTokenValidity(string $token): bool
    {
        $savedToken = $this->sessionManager->getValue(self::CSRF_TOKEN_KEY);
        return !empty($savedToken) && hash_equals($savedToken, $token);
    }

    public function escapeHtml(?string $input): string
    {
        return htmlspecialchars($input ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    public function purifyHtml(?string $input): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $purifier->purify($input);
        return $purifier->purify($input);
    }
}