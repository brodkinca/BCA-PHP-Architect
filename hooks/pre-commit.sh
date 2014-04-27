#!/usr/bin/env sh

git stash -q --keep-index
php phing.phar scm
rc=$?
git stash pop -q
exit $rc
