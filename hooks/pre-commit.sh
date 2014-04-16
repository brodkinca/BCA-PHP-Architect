#!/usr/bin/env sh

git stash -q --keep-index
phing default-scm
rc=$?
git stash pop -q
exit $rc
