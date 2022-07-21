#!/bin/bash

# script to add git subtree to the project

git remote add -f design-scuole https://github.com/maxmorozoff/design-scuole-pagine-statiche.git
git subtree add --prefix assets/design-scuole design-scuole tag-dev --squash
git fetch design-scuole tag-dev
git subtree pull --prefix assets/design-scuole design-scuole tag-dev --squash 

cd assets/design-scuole

# install node modules
npm install

# install sass compiler
sudo npm install sass -g

# start file watch
# sass --watch <input-file-path> <output-file-path>
sass --watch src/scss/scuole.scss src/scss/scuole.css 