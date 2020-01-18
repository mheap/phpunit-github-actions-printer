## phpunit-github-actions-printer

> There's a zero-config way to achieve this at [mheap/phpunit-matcher-action](https://github.com/mheap/phpunit-matcher-action)

This is a PHPUnit printer that uses the `::error` and `::warning` functionality of GitHub Actions to add annotiations for failing test runs. It's main differentiator to the above is that it supports adding warnings in addition to errors.

## Usage

Add this printer to your project

```bash
composer require --dev mheap/phpunit-github-actions-printer
```

When you run your tests, specify `mheap\GithubActionsReporter\Printer` as the printer to use

```bash
./vendor/bin/phpunit --printer mheap\\GithubActionsReporter\\Printer /path/to/tests
```
