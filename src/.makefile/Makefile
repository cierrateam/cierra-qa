ifndef ARGS
ARGS=
endif

ifndef FILES
FILES=app/ composer.json composer.lock
endif

ifndef PHP_FILES
PHP_FILES=app/
endif

CORES=$(shell (nproc  || sysctl -n hw.ncpu) 2> /dev/null )

# This command search for modified files.
# grep -e ^M: Line should begin with M
# cut -c 4: Removes the first 3 characters
CHANGED_FILES=$(shell git status -s | grep -e '^M' -e '^A' | cut -c 4- | xargs)
CHANGED_PHP_FILES=$(shell git status -s | grep -e '^M' -e '^A' | grep -e '.php$$' | cut -c 4- | xargs)

# This is needed to store a space in a make variable.
# https://stackoverflow.com/questions/10571658/gnu-make-convert-spaces-to-colons
SPACE :=
SPACE +=
COMMA := ,

PHPCS_CMD=php vendor/bin/phpcs
PHPCS_ARGS=--parallel=$(CORES) --standard=./.qa/phpcs/rules.xml -n

PHPCBF_CMD=php vendor/bin/phpcbf
PHPCBF_ARGS=--parallel=$(CORES) --standard=./.qa/phpcs/rules.xml -n

PHPSTAN_LEVEL=5
PHPSTAN_CMD=php vendor/bin/phpstan
PHPSTAN_ARGS=analyse --level=$(PHPSTAN_LEVEL) --configuration=.qa/phpstan/phpstan.neon


.PHONY: phpcs
phpcs: ## Run style check on all files
	$(PHPCS_CMD) $(PHPCS_ARGS) $(FILES)

.PHONY: phpcs-quick
phpcs-quick: ## Run style check on all files
	$(PHPCS_CMD) $(PHPCS_ARGS) $(CHANGED_FILES)

.PHONY: phpcbf
phpcbf: ## Run style fixer on all files
	$(PHPCBF_CMD) $(PHPCBF_ARGS) $(FILES)

.PHONY: phpcbf-quick
phpcbf-quick: ## Run style fixer on changed files
	$(PHPCBF_CMD) $(PHPCBF_ARGS) $(CHANGED_FILES)

.PHONY: phpstan
phpstan:  ## Run phpstan with level LEVEL. Usage: make phpstan LEVEL=3 FILES="foo/bar/baz.php foo/bar/foo.php"
	$(PHPSTAN_CMD) $(PHPSTAN_ARGS) $(FILES) $(ARGS)

.PHONY: phpstan-quick
phpstan-quick:  ## Run phpstan with level LEVEL. Usage: make phpstan LEVEL=3 FILES="foo/bar/baz.php foo/bar/foo.php "
	$(PHPSTAN_CMD) $(PHPSTAN_ARGS) $(CHANGED_FILES) $(ARGS)