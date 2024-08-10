<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit51cf5ca848dd2b03e8cb5cac31bdc5e1
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zend\\Escaper\\' => 13,
        ),
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
            'PhpOffice\\Common\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zend\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-escaper/src',
        ),
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'PhpOffice\\Common\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/common/src/Common',
        ),
    );

    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsstream/src/main/php',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PclZip' => __DIR__ . '/..' . '/pclzip/pclzip/pclzip.lib.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit51cf5ca848dd2b03e8cb5cac31bdc5e1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit51cf5ca848dd2b03e8cb5cac31bdc5e1::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit51cf5ca848dd2b03e8cb5cac31bdc5e1::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit51cf5ca848dd2b03e8cb5cac31bdc5e1::$classMap;

        }, null, ClassLoader::class);
    }
}
