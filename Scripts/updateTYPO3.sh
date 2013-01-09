#!/bin/bash

#set -o nounset
#set -o errexit

version=$1;

if [ "$version" = "" ]
then
	echo Provide a Version as the first parameter to this script. Example: updateTYPO3.sh 4-7-1
	exit
fi

cd ..
cd typo3_src
git fetch
git fetch --tags
git checkout tags/TYPO3_$version
git submodule update --init --recursive

git add typo3_src