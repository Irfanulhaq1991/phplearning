<?php

namespace Irfan\Phplearning\utilities;

class SessionManager implements SessionManagerContract
{


    public function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            // Set secure session cookie parameters before starting the session
            session_set_cookie_params([
                'lifetime' => 0,               // Session cookie expires on browser close
                'path' => '/',                 // Cookie available in entire domain
                'domain' => '',                // Set to your domain if needed
                'secure' => isset($_SERVER['HTTPS']), // Only send cookie over HTTPS if available
                'httponly' => true,            // Prevent JS access to cookie
                'samesite' => 'Strict'         // Prevent CSRF by restricting cross-site requests
            ]);

            session_start();

            // Prevent session fixation by regenerating session ID on new session start
            if (!isset($_SESSION['initiated'])) {
                session_regenerate_id(true);
                $_SESSION['initiated'] = true;
            }
        }

    }

    public function saveValue(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getValue(string $key): string
    {
        return $_SESSION[$key] ?? '';
    }

    public function clear():void
    {
        // Unset all session variables
        $_SESSION = [];

        // Delete session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        // Destroy the session
        session_destroy();
    }

}