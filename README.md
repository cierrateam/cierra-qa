## About Cierra QA

Cierra QA (quality assurance) is a simple package that includes code quality tools in your project.  
QA-Tools that will be integrated into your project:

- [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [Larastan](https://github.com/nunomaduro/larastan)

Furthermore, it will create a GitHub workflow file to your project under `.github/workflows` that runs QA tools on pull requests.

## Installation

First, you may use Composer to install Cierra QA to your project:
```
composer require --dev cierrateam/cierra-qa
```

To copy the QA files to your project, you have to run the following command:
```
php artisan cierra-qa:install
```

This command will create a `.qa` folder into your root project with configuration files for `PHP_CodeSniffer` and `Larastan`.  
It will also create a `code-quality.yml` file into `.github/workflows` directory and a `Makefile` into the root of your project.

❗️ Make sure to save your old `Makefile` if there exists one.

## Configuration

You can update the configuration/rules files in the `.qa` for your project so that it has your standards.  
❗ Please update the `php-version` in the `code-quality.yml` with the version you use for your project so that the QA-tools will use the correct PHP version on pull-request.

By default, the QA tools use the `/app` directory for analyzing. You can change the default path in the `Makefile` under `PHP_FILES`.  
The default `phpstan` level is 5. You can update it also in the `Makefile` under `PHPSTAN_LEVEL`.

## Usage

After installing and configuring the QA tools at your convenience, you can use `PHP_CodeSniffer` and `Larastan` very quickly with the `Makefile` shortcut.
- use `make phpcs` to run `PHP_CodeSniffer` for the `/app` folder.
- use `make phpstan` to run `Larastan` for the `/app` folder.

❗ You can change the path that you want to analyze and the `phpstan` level in the `Makefile` under `PHP_FILES` and `PHPSTAN_LEVEL` or provide the path directly with the `make` command:
`make phpstan LEVEL=3 FILES="foo/bar/baz.php foo/bar/foo.php"`

If you don't want to analyze the whole project files under `app` you can also check only the changed files.  
Run `git add .` and then `make phpcs-quick` or `make phpstan-quick`.

### PHPSTORM

Under `.dev/ide/phpstorm/settings` is a code styling file stored which can be imported to your PHPStorm ide under `Preferences --> Editor --> Code Style`.
