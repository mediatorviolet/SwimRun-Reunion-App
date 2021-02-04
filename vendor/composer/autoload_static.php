<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit25beda65c6c4784ed8a83e6b9c65e811
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit25beda65c6c4784ed8a83e6b9c65e811::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit25beda65c6c4784ed8a83e6b9c65e811::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit25beda65c6c4784ed8a83e6b9c65e811::$classMap;

        }, null, ClassLoader::class);
    }
}