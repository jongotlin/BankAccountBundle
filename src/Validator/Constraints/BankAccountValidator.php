<?php

namespace JGI\BankAccountBundle\Validator\Constraints;

use byrokrat\banking\AccountFactoryInterface;
use byrokrat\banking\Exception\InvalidAccountNumberException;
use byrokrat\banking\Exception\InvalidClearingNumberException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BankAccountValidator extends ConstraintValidator
{
    /**
     * @var AccountFactoryInterface
     */
    private $accountFactory;

    /**
     * @param AccountFactoryInterface $accountFactory
     */
    public function __construct(AccountFactoryInterface $accountFactory)
    {
        $this->accountFactory = $accountFactory;
    }

    /**
     * @param mixed $value
     * @param Constraint|\BankAccount $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        try {
            $this->accountFactory->createAccount($value);
        } catch (InvalidClearingNumberException $e) {
            $this->context->addViolation($constraint->clearingNumberMessage);
        } catch (InvalidAccountNumberException $e) {
            $this->context->addViolation($constraint->bankAccountMessage);
        }
    }
}
