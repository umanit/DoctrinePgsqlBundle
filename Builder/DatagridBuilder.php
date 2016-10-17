<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Librinfo\DoctrinePgsqlBundle\Builder;

use Librinfo\DoctrinePgsqlBundle\Datagrid\Pager;
use Sonata\AdminBundle\Datagrid\PagerInterface;
use Sonata\AdminBundle\Datagrid\SimplePager;
use Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder as BaseDatagridBuidler;

class DatagridBuilder extends BaseDatagridBuidler
{
    /**
     * Get pager by pagerType.
     *
     * @param string $pagerType
     *
     * @return PagerInterface
     *
     * @throws \RuntimeException If invalid pager type is set
     */
    protected function getPager($pagerType)
    {
        switch ($pagerType) {
            case Pager::TYPE_DEFAULT:
                return new Pager();

            case Pager::TYPE_SIMPLE:
                return new SimplePager();

            default:
                throw new \RuntimeException(sprintf('Unknown pager type "%s".', $pagerType));
        }
    }
}
