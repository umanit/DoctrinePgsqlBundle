<?php

namespace Blast\DoctrinePgsqlBundle\Model;

use Sonata\DoctrineORMAdminBundle\Model\ModelManager as BaseModelManager;
use Blast\DoctrinePgsqlBundle\Datagrid\ProxyQuery;

class ModelManager extends BaseModelManager
{
    /**
     * {@inheritdoc}
     */
    public function createQuery($class, $alias = 'o')
    {
        $repository = $this->getEntityManager($class)->getRepository($class);

        // use Librinfo ProxyQuery instead of Sonata one
        return new ProxyQuery($repository->createQueryBuilder($alias));
    }
}