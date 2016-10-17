<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\DoctrinePgsqlBundle\Datagrid;

use Doctrine\ORM\Query;
use Sonata\DoctrineORMAdminBundle\Datagrid\Pager as BasePager;

class Pager extends BasePager
{
    /**
     * {@inheritdoc}
     */
    public function computeNbResult()
    {
        $countQuery = clone $this->getQuery();

        if (count($this->getParameters()) > 0) {
            $countQuery->setParameters($this->getParameters());
        }

        $countQuery->select(sprintf('count(DISTINCT %s.%s) as cnt', $countQuery->getRootAlias(), current($this->getCountColumn())))
            ->resetDQLPart('orderBy');
        $query = $countQuery->getQuery();

        // Use ILIKE instead of LIKE for Postgresql
        if ( 'pdo_pgsql' == $countQuery->getEntityManager()->getConnection()->getDriver()->getName() )
            $query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, 'Librinfo\DoctrinePgsqlBundle\DoctrineExtensions\LibrinfoWalker');

        return $query->getSingleScalarResult();
    }
}
