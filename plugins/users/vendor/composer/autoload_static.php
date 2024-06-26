<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit75349e24a4b6c5d560e4005a8a00af1d
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Leo\\Users\\Providers\\' => 20,
            'Leo\\Users\\Database\\Seeders\\' => 27,
            'Leo\\Users\\Database\\Migrations\\' => 30,
            'Leo\\Users\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Leo\\Users\\Providers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Providers',
        ),
        'Leo\\Users\\Database\\Seeders\\' => 
        array (
            0 => __DIR__ . '/../..' . '/database/seeders',
        ),
        'Leo\\Users\\Database\\Migrations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/database/migrations',
        ),
        'Leo\\Users\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Leo\\Users\\Controllers\\UserController' => __DIR__ . '/../..' . '/src/Controllers/UserController.php',
        'Leo\\Users\\Database\\Seeders\\Role_Seeder' => __DIR__ . '/../..' . '/database/seeders/Role_Seeder.php',
        'Leo\\Users\\Database\\Seeders\\User_Seeder' => __DIR__ . '/../..' . '/database/seeders/User_Seeder.php',
        'Leo\\Users\\Jobs\\SendUserCreateMail' => __DIR__ . '/../..' . '/src/Jobs/SendUserCreateMail.php',
        'Leo\\Users\\Mail\\createUser' => __DIR__ . '/../..' . '/src/Mail/createUser.php',
        'Leo\\Users\\Models\\User' => __DIR__ . '/../..' . '/src/Models/User.php',
        'Leo\\Users\\Providers\\UserServiceProvider' => __DIR__ . '/../..' . '/src/Providers/UserServiceProvider.php',
        'Leo\\Users\\Role' => __DIR__ . '/../..' . '/src/Models/Role.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit75349e24a4b6c5d560e4005a8a00af1d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit75349e24a4b6c5d560e4005a8a00af1d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit75349e24a4b6c5d560e4005a8a00af1d::$classMap;

        }, null, ClassLoader::class);
    }
}
