<?php
namespace ApiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @codeCoverageIgnore
 */
class MaxPerPageLimit extends Constraint
{
    /**
     * @var int
     */
    public $limit = 10;

    /**
     * @var string
     */
    public $message = 'The parameter \'%maxPerPage%\' is over limit. Please set parameters within range [1-%limit%].';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
