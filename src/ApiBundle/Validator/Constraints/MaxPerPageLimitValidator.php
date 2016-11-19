<?php
namespace ApiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class MaxPerPageLimitValidator extends ConstraintValidator
{
    /**
     * Validate
     *
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if ($value > $constraint->limit) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%maxPerPage%', $value)
                ->setParameter('%limit%', $constraint->limit)
                ->addViolation();
        }
    }
}
