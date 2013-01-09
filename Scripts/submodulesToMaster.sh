#!/bin/bash

cd ..

cd typo3conf/ext/mootools_essentials
git checkout master
git fetch
git rebase
git submodule update --init --recursive
cd ../../../

cd typo3conf/ext/mootools_stack
git checkout master
git fetch
git rebase
git submodule update --init --recursive
cd ../../../

cd typo3conf/ext/tinymce_rte
git checkout master
git fetch
git rebase
git submodule update --init --recursive
cd ../../../

cd typo3conf/ext/wt_base
git checkout master
git fetch
git rebase
git submodule update --init --recursive
cd ../../../