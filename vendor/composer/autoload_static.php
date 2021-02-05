<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6151a96ea7bc19a827e7e7a7d15d0874
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6151a96ea7bc19a827e7e7a7d15d0874::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6151a96ea7bc19a827e7e7a7d15d0874::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6151a96ea7bc19a827e7e7a7d15d0874::$classMap;

        }, null, ClassLoader::class);
    }
}
