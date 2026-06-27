<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * --------------------------------------------------------------------
     * Filter Aliases
     * --------------------------------------------------------------------
     * Aliases make it easier to call filters
     * throughout the application.
     */
    public array $aliases = [
        'csrf'               => CSRF::class,
        'toolbar'            => DebugToolbar::class,
        'honeypot'           => Honeypot::class,
        'invalidchars'       => InvalidChars::class,
        'secureheaders'      => SecureHeaders::class,
        'pagecache'          => PageCache::class,
        'performanceMetrics' => PerformanceMetrics::class,
        'auth'               => \App\Filters\AuthFilter::class,


        // 🔒 Custom Filter untuk Role Login
        'role'               => \App\Filters\RoleFilter::class,
    ];

    /**
     * --------------------------------------------------------------------
     * Global Filters
     * --------------------------------------------------------------------
     * Filters yang selalu diterapkan ke setiap request.
     */
    public array $globals = [
        'before' => [
            // kamu bisa aktifkan CSRF jika ingin keamanan tambahan:
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            // 'secureheaders',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Method Filters
     * --------------------------------------------------------------------
     * Dijalankan hanya untuk metode HTTP tertentu (GET, POST, dll)
     */
    public array $methods = [];

    /**
     * --------------------------------------------------------------------
     * URI Pattern Filters
     * --------------------------------------------------------------------
     * Menentukan filter yang dijalankan hanya pada URI tertentu.
     */
    public array $filters = [
        // RoleFilter akan otomatis dijalankan pada route tertentu jika ditentukan di Routes.php
        // Contoh: ['before' => ['admin/*', 'mahasiswa/*', 'dosen/*']]
    ];
}
