#!/bin/bash

# usage ./checkoutTYPO3v6.sh shopCom mySqlPassword

name=$1;
nameLowerCase=${1,,};
password=$2;

## CLONE & FOLDERS #################################################################################
git clone git@git.webteam.at:clients/$nameLowerCase.git $name

cd $name
git submodule update --init --recursive

# create needed folders
mkdir fileadmin
mkdir fileadmin/user_upload
mkdir fileadmin/_temp_
mkdir uploads
mkdir uploads/pics
mkdir uploads/media
mkdir uploads/tf
mkdir typo3temp

# create needed symlinks
ln -s typo3_src/typo3
ln -s typo3_src/t3lib
ln -s typo3_src/index.php

## DATABASE ########################################################################################
ssh -t $nameLowerCase@clients.webteam.at "mysqldump --user=$nameLowerCase --password=$password $nameLowerCase > dump.sql && gzip dump.sql"

scp $nameLowerCase@clients.webteam.at:dump.sql.gz dump.sql.gz

gunzip dump.sql.gz

mysql --user=root -e "CREATE DATABASE $nameLowerCase"
mysql --user=root -e "ALTER DATABASE $nameLowerCase DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"
mysql --user=root $nameLowerCase < dump.sql

# remove files
rm dump.sql

# remove remote files
ssh -t $nameLowerCase@clients.webteam.at "rm dump.sql.gz"