# BankAccountBundle

This Symfony Bundle uses [github.com/byrokrat/banking](https://github.com/byrokrat/banking) to validate swedish bank account numbers.

## Install

Via Composer

```bash
$ composer require jongotlin/bank-account-bundle
```

```php
class AppKernel extends Kernel
{
  public function registerBundles()
  {
    $bundles = array(
        // ...
        new JGI\BankAccountBundle\BankAccountBundle(),
    }
  }
}
```

## Usage
```php
use JGI\BankAccountBundle\Validator\Constraints as BankAccountAssert;

/**
 * @BankAccountAssert\BankAccount
 */
private $bankAccount;
```
