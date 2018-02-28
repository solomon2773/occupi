<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Cache\Storage\Adapter\Filesystem;
return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=fashiontrendguru;host=192.168.1.21;port=3306',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
       // 'adapters' => [
        //    'User\Db\WriteAdapter' => [
         //       'driver' => 'Pdo',
         //       'dsn'    => 'mysql:dbname=fashiontrendguru;host=192.168.1.21;port=3306charset=utf8',
        //    ],
        //    'User\Db\ReadOnlyAdapter' => [
        //        'driver' => 'Pdo',
         //       'dsn'    => 'mysql:dbname=fashiontrendguru;host=192.168.1.21;port=3306charset=utf8',
         //   ],
       // ],
    ],


    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter'  => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Zend\Session\Config\ConfigInterface' => 'Zend\Session\Service\SessionConfigFactory',
            'navigation' => Zend\Navigation\Service\DefaultNavigationFactory::class,

        ],
    ],
    'session_config' => [
        // Cookie expires in 1 hour
        'cookie_lifetime' => 60*60*1,
        // Stored on server for 30 days
        'gc_maxlifetime' => 60*60*24*30,
    ],
    // Session manager configuration.
    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
    'session_storage' => [
        'type' => SessionArrayStorage::class,
    ],
        /*
    'session' => [
        'config' => [
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => [
                'name' => 'myapp',
            ],
        ],
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => [
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ],
    ],*/
// Cache configuration.
    'caches' => [
        'FilesystemCache' => [
            'adapter' => [
                'name'    => Filesystem::class,
                'options' => [
                    // Store cached data in this directory.
                    'cache_dir' => './data/cache',
                    // Store cached data for 1 hour.
                    'ttl' => 60*60*1
                ],
            ],
            'plugins' => [
                [
                    'name' => 'serializer',
                    'options' => [
                    ],
                ],
            ],
        ],
    ],
    'doctrine' => [
        // migrations configuration
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => 'data/Migrations',
                'name'      => 'Doctrine Database Migrations',
                'namespace' => 'Migrations',
                'table'     => 'migrations',
            ],
        ],
    ],



];

