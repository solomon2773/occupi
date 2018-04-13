<?php

namespace Occupi;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            'occupi' => [
                'type'    => literal::class,
                'options' => [
                    'route'    => '/occupi',

                    'defaults' => [
                        'controller'    => Controller\IndexController::class,
                        'action'        => 'index',
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'showcurrentoccupancy' => [
                        'type'  => Segment::class,
                        'options' => [
                            'route'    => '/showcurrentoccupancy[/:action[/:id]]',
                            'defaults' => [
                                'controller'    => Controller\ShowcurrentoccupancyController::class,
                                'action'        => 'index',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+'
                            ],
                        ],
                    ],

                    'showoccupancygraph' => [
                        'type'  => Segment::class,
                        'options' => [
                            'route'    => '/showoccupancygraph[/:action[/:id]]',
                            'defaults' => [
                                'controller'    => Controller\ShowoccupancygraphController::class,
                                'action'        => 'index',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+'
                            ],
                        ],
                    ],/*
                    'enteroccupancymodel' => [
                        'type'  => Segment::class,
                        'options' => [
                            'route'    => '/enteroccupancymodel[/:action[/:id]]',
                            'defaults' => [
                                'controller'    => Controller\EnteroccupancymodelController::class,
                                'action'        => 'index',
                            ],
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+'
                            ],
                        ],
                    ],*/


                ],





            ],




        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\ShowcurrentoccupancyController::class => Controller\Factory\ShowcurrentoccupancyControllerFactory::class,
            Controller\ShowoccupancygraphController::class => Controller\Factory\ShowoccupancygraphControllerFactory::class,


        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.

    'access_filter' => [

        'controllers' => [
            Controller\IndexController::class => [
                // Allow authorized users to visit "settings" action
                ['actions' => ['index'], 'allow' => '@']
            ],
            Controller\ShowcurrentoccupancyController::class => [
                // Allow authorized users to visit "settings" action
                ['actions' => ['index','getRealTimeData'], 'allow' => '@']
            ],
            Controller\ShowoccupancygraphController::class => [
                // Allow authorized users to visit "settings" action
                ['actions' => ['index'], 'allow' => '@']
            ],

        ]

    ],

    'service_manager' => [
        'factories' => [
            Service\IndexManager::class => Service\Factory\IndexManagerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'occupi' => __DIR__ . '/../view',
        ],
    ],
        /*
    // We register module-provided view helpers under this key.
    'view_helpers' => [
        'factories' => [
            View\Helper\Access::class => View\Helper\Factory\AccessFactory::class,
            View\Helper\CurrentUser::class => View\Helper\Factory\CurrentUserFactory::class,
        ],
        'aliases' => [
            'access' => View\Helper\Access::class,
            'currentUser' => View\Helper\CurrentUser::class,
        ],
    ],*/
/*
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],*/
];
