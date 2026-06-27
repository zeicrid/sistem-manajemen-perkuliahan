<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     */
    public string $baseURL = 'http://localhost:8080/';

    public array $allowedHostnames = [];

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI Protocol
     * --------------------------------------------------------------------------
     */
    public string $uriProtocol = 'REQUEST_URI';

    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    public string $defaultLocale = 'en';
    public bool $negotiateLocale = false;
    public array $supportedLocales = ['en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     */
    public string $appTimezone = 'Asia/Jakarta'; // ✅ ubah ke waktu lokal Indonesia

    public string $charset = 'UTF-8';
    public bool $forceGlobalSecureRequests = false;

    public array $proxyIPs = [];

    public bool $CSPEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * SESSION CONFIG
     * --------------------------------------------------------------------------
     */
    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName = 'ci_session';
    public string $sessionSavePath = WRITEPATH . 'session';
    public int $sessionExpiration = 7200;
    public bool $sessionMatchIP = false;
    public bool $sessionRegenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * COOKIE CONFIG
     * --------------------------------------------------------------------------
     */
    public string $cookiePrefix   = '';
    public string $cookieDomain   = '';
    public string $cookiePath     = '/';
    public string $cookieSameSite = 'Lax';
    public bool $cookieSecure     = false;
    public bool $cookieHTTPOnly   = true;
}
