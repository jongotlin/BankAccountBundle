<?php

namespace JGI\BankAccountBundle\Tests\Validator\Constraints;

use byrokrat\banking\AccountFactoryInterface;
use byrokrat\banking\Exception\InvalidAccountNumberException;
use byrokrat\banking\Exception\InvalidClearingNumberException;
use byrokrat\banking\Exception;
use JGI\BankAccountBundle\Validator\Constraints\BankAccount;
use JGI\BankAccountBundle\Validator\Constraints\BankAccountValidator;
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

    /**
     * @test
     */
    public function invalidBankAccountIsInvalid()
    {
        $accountFactoryMock = $this->createMock(AccountFactoryInterface::class);
        $accountFactoryMock->expects($this->once())->method('createAccount')
            ->willThrowException(new class extends InvalidAccountNumberException implements Exception {});
        $this->validator = new BankAccountValidator($accountFactoryMock);
        $this->validator->initialize($this->context);
        $this->validator->validate('-', new BankAccount());
        $this
            ->buildViolation('This value is not a valid bank account.')
            ->assertRaised()
        ;
    }

    /**
     * @test
     */
    public function invalidClearingNumberIsInvalid()
    {
        $accountFactoryMock = $this->createMock(AccountFactoryInterface::class);
        $accountFactoryMock->expects($this->once())->method('createAccount')
            ->willThrowException(new class extends InvalidClearingNumberException implements Exception {});
        $this->validator = new BankAccountValidator($accountFactoryMock);
        $this->validator->initialize($this->context);
        $this->validator->validate('-', new BankAccount());
        $this
            ->buildViolation('Invalid clearing number.')
            ->assertRaised()
        ;
    }
}
