<?php

namespace JGI\BankAccountBundle\Tests\Validator\Constraints;

use byrokrat\banking\AccountFactoryInterface;
use JGI\BankAccountBundle\Validator\Constraints\BankAccount;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class BankAccountValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @return BankAccountValidator
     */
    protected function createValidator()
    {
        return new BankAccountValidator($this->createMock(AccountFactoryInterface::class));
    }

    /**
     * @test
     */
    public function bankAccountIsValid()
    {
        $this->validator->validate('-', new BankAccount());
        $this->assertNoViolation();
    }
}
