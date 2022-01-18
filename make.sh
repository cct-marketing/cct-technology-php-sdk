#!/bin/bash

cat build/git.pre_hook.sh > ./.git/hooks/pre-commit
chmod +x ./.git/hooks/pre-commit

if [ ! -d "./vendor" ]; then
    composer install --no-interaction --optimize-autoloader
fi
