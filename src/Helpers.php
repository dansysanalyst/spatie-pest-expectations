<?php

function registerSpatiePestHelpers(): void
{
    function skipOnGitHubActions(): void
    {
        if (getenv('GITHUB_ACTIONS') === 'true') {
            test()->markTestSkipped('This test is skipped on GitHub Actions');
        }
    }

    function whenGitHubActions(): void
    {
        if (getenv('GITHUB_ACTIONS') !== 'true') {
            test()->markTestSkipped('This test is skipped on GitHub Actions');
        }
    }

    function whenMac(): void
    {
        if (PHP_OS_FAMILY !== 'Darwin') {
            test()->markTestSkipped('This test will only run on macOS');
        }
    }

    function whenWindows(): void
    {
        if (PHP_OS_FAMILY !== 'Windows') {
            test()->markTestSkipped('This test will only run on Windows');
        }
    }

    function whenLinux(): void
    {
        if (PHP_OS_FAMILY !== 'Linux') {
            test()->markTestSkipped('This test will only run on Linux');
        }
    }

    function skipOnMac(): void
    {
        if (PHP_OS_FAMILY === 'Darwin') {
            test()->markTestSkipped('This test will not run on macOS');
        }
    }

    function skipOnWindows(): void
    {
        if (PHP_OS_FAMILY === 'Windows') {
            test()->markTestSkipped('This test will not run on Windows');
        }
    }

    function skipOnLinux(): void
    {
        if (PHP_OS_FAMILY === 'Linux') {
            test()->markTestSkipped('This test will not run on Linux');
        }
    }

    /**
     * Only runs the test if PHP version is
     * equal or higher than the specified version.
     */
    function requiresMinPhpVersion(string $phpVersion): void
    {
        if (version_compare(PHP_VERSION, $phpVersion, '<=')) {
            test()->markTestSkipped("This test will only run on PHP version {$phpVersion} or higher");
        }
    }

    /**
     * Only runs the test if PHP version is
     * equal or higher than the specified version.
     */

    //This function avoids a breaking change
    function whenPhpVersion(string $phpVersion)
    {
        requiresMinPhpVersion($phpVersion);
    }

    /**
     * Only runs the test if the specified file does not exist.
     */
    function skipWhenFileExists(string $filepath)
    {
        if (file_exists($filepath) === true) {
            test()->markTestSkipped("This test will only run if '{$filepath}' does not exist.");
        }
    }

    /**
     * Only runs the test if the specified file exists.
     */
    function requiresFile(string $filepath)
    {
        if (file_exists($filepath) === false) {
            test()->markTestSkipped("This test will only run if '{$filepath}' exists.");
        }
    }

    /**
     * Only runs the test if the specified server can be reached.
     */
    function requiresServerToBeAvailable(string $uri, string $port)
    {
        try {
            fsockopen($uri, $port, $error_code, $error_message, 15);
        } catch (\Exception $e) {
            test()->markTestSkipped("Could not reach the server '{$uri}:{$port}'.");
        }
    }

    /**
     * Skips the test if dependency is missing
     */
    function requiresDependency(string $dependency)
    {
        if (\Composer\InstalledVersions::isInstalled($dependency) === false) {
            test()->markTestSkipped("This test will not run if '{$dependency}' is missing.");
        }
    }

    /**
     * Only runs the test if dependency is not installed
     */
    function skipWhenDependencyExists(string $dependency)
    {
        if (\Composer\InstalledVersions::isInstalled($dependency) === true) {
            test()->markTestSkipped("This test will only run if '{$dependency}' is not installed.");
        }
    }

    /**
     * Only runs the test if the specified PHP extension is not loaded.
     */
    function skipWhenPhpExtensionExists(string $PhpExtension): void
    {
        if (in_array($PhpExtension, get_loaded_extensions()) === true) {
            test()->markTestSkipped("This test will only run if PHP extension '{$PhpExtension}' is not loaded.");
        }
    }

    /**
     * Only runs the test if the specified PHP extension is loaded.
     */
    function requiresPhpExtension(string $phpExtension): void
    {
        if (in_array($phpExtension, get_loaded_extensions()) === false) {
            test()->markTestSkipped("This test will only run if PHP extension '{$phpExtension}' is loaded.");
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Laravel Test Helpers
    |--------------------------------------------------------------------------
    |
    */

    if (class_exists('\Illuminate\Container\Container')) {

        function whenConfig(string $key): void
        {
            if (config($key) === null) {
                test()->markTestSkipped("{$key} is not set in the config file");
            }
        }

        function whenEnvVar(string $key): void
        {
            if (env($key) === null) {
                test()->markTestSkipped("{$key} is not set in the .env file");
            }
        }

        /**
         * Only runs the test if Laravel version
         * is equal or higher than the specified version.
         */
        function requiresLaravelVersion(string $version): void
        {
            if (version_compare(app()->version(), $version, '<=')) {
                test()->markTestSkipped("This test will only run on Laravel version {$version} or higher");
            }
        }

        /**
         * Only runs the test if the database is MySQL.
         */
        function requiresMysql()
        {
            if (\Illuminate\Support\Facades\DB::getDriverName() !== 'mysql') {
                test()->markTestSkipped('This test requires a MySQL database');
            }
        }

        /**
         * Only runs the test if the database is SQLite.
         */
        function requiresSqlite()
        {
            if (\Illuminate\Support\Facades\DB::getDriverName() !== 'sqlite') {
                test()->markTestSkipped('This test requires a SQLite database');
            }
        }

        /**
         * Only runs the test if the database is PostgreSQL.
         */
        function requiresPostgre()
        {
            if (\Illuminate\Support\Facades\DB::getDriverName() !== 'pgsql  ') {
                test()->markTestSkipped('This test requires a PostgreSQL database');
            }
        }
    }
}
