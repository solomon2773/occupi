<?php
namespace Occupi\Service\Factory;

use Interop\Container\ContainerInterface;
use Occupi\Service\IndexManager;
use User\Service\RbacManager;
use User\Service\PermissionManager;

/**
 * This is the factory class for IndexManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class IndexManagerFactory
{
    /**
     * This method creates the NavManager service and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $indexManager = $container->get(IndexManager::class);
        $permissionManager = $container->get(PermissionManager::class);

        return new IndexManager($entityManager, $indexManager, $permissionManager);
    }
}
