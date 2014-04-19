#!/usr/bin/env sh

git stash -q --keep-index
phing scm
rc=$?
git stash pop -q
exit $rc
