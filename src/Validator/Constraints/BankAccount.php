<?php

namespace JGI\BankAccountBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class BankAccount extends Constraint
{
    /**
     * @var string
     */
    public $bankAccountMessage = 'This value is not a valid bank account.';

    /**
     * @var string
     */
    public $clearingNumberMessage = 'Invalid clearing number.';
}
