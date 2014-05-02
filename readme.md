# Kirby Tests

This is Kirby's unit testing driving range. It contains PHPUnit tests for various edge cases and tries to cover as much ground as possible.

Tests are separated into different cases, which make it possible to have multiple installations of Kirby with various setups without creating conflicts. The included test script runs PHPUnit for each directory within `cases`. Feel free to add your own tests.

## Requirements

You must have the latest version PHPUnit installed in order to run tests.

## Installation

```
git clone --recursive https://github.com/getkirby/tests.git
```

Also make sure that the test and update bash scripts are executable:

```
chmod +x test
chmod +x update
```

## Running tests

```
./test
```

## Updating Kirby

To make it easier to update the testdrive's Kirby installation, use the included update bash script:

```
./update
```

It will fetch the latest versions of the Kirby core and Toolkit from Github