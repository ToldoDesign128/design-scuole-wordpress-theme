#!/bin/bash

# script to add git subtree to the project

git remote add -f design-scuole https://github.com/maxmorozoff/design-scuole-pagine-statiche.git
git subtree add --prefix assets/design-scuole design-scuole tag-dev --squash
git fetch design-scuole tag-dev
git subtree pull --prefix assets/design-scuole design-scuole tag-dev --squash 
