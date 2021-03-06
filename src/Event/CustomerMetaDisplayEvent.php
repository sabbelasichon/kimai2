<?php

/*
 * This file is part of the Kimai time-tracking app.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Event;

use App\Entity\MetaTableTypeInterface;
use App\Repository\Query\BaseQuery;
use App\Repository\Query\CustomerQuery;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Dynamically find possible meta fields for a customer query.
 */
final class CustomerMetaDisplayEvent extends Event implements MetaDisplayEventInterface
{
    public const EXPORT = 'export';
    public const CUSTOMER = 'customer';

    /**
     * @var CustomerQuery
     */
    private $query;
    /**
     * @var string
     */
    private $location;
    /**
     * @var MetaTableTypeInterface[]
     */
    private $fields = [];

    public function __construct(CustomerQuery $query, string $location)
    {
        $this->query = $query;
        $this->location = $location;
    }

    /**
     * If you want to filter where your meta-field will be displayed, use the query settings.
     *
     * @return CustomerQuery
     */
    public function getQuery(): BaseQuery
    {
        return $this->query;
    }

    /**
     * If you want to filter where your meta-field will be displayed, check the current location.
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    public function addField(MetaTableTypeInterface $meta)
    {
        $this->fields[] = $meta;
    }

    /**
     * @return MetaTableTypeInterface[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
