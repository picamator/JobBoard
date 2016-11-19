<?php
declare(strict_types = 1);

namespace ApiBundle\Util\Inflector;

use FOS\RestBundle\Inflector\InflectorInterface;

/**
 * Inflector
 *
 * @codeCoverageIgnore
 */
class NoopInflector implements InflectorInterface
{
    public function pluralize($word)
    {
        // Don't pluralize
        return $word;
    }
}
