<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2f047f8ebb1f60bb44105f0aab195bb
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitf2f047f8ebb1f60bb44105f0aab195bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf2f047f8ebb1f60bb44105f0aab195bb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf2f047f8ebb1f60bb44105f0aab195bb::$classMap;

        }, null, ClassLoader::class);
    }
}
