#!/bin/bash

SUCCESS=1

# Localize the files changed
FILES=$(git diff-index --name-only --cached --diff-filter=ACMR HEAD -- '*.php' -- | grep -v 'tests' | paste -s -d' ' -)

# If there are no PHP files, we don't need to continue into the script
if [ "$FILES" == "" ]; then
  exit 0;
fi

# Check the coding standards
./bin/php-cs-fixer fix $FILES --config=.php_cs.dist -v --dry-run --show-progress=dots --using-cache=no --diff
RESULT=$?

if ! [ $RESULT -eq 0 ]; then
  exit 2;
fi

# Executing PHP Unit testing. If the tests fail, we exit the script earlier
./bin/phpunit -c phpunit.xml.dist ./tests/
RESULT=$?

if ! [ $RESULT -eq 0 ]; then
  exit 2;
fi

# Check against the PSALM (Analysis tool trying to find bugs, or possible bugs)
php -d memory_limit=2G ./bin/psalm --show-info=false $FILES  -c psalm.xml.dist
RESULT=$?

if ! [ $RESULT -eq 0 ]; then
   exit 2
fi
