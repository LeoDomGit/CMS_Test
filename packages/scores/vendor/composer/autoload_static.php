<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita131e7c9f194252174f112212d56b5a7
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Leo\\Scores\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Leo\\Scores\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita131e7c9f194252174f112212d56b5a7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita131e7c9f194252174f112212d56b5a7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita131e7c9f194252174f112212d56b5a7::$classMap;

        }, null, ClassLoader::class);
    }
}
