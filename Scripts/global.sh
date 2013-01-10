#!/bin/bash

folder="${PWD##*/}";
if [ "$folder" != "Scripts" ]
then
	echo "You need to call Scripts from within ./Scripts/";
	exit
fi

username='username';
password='password';
host='127.0.0.1';
database="$(basename ${PWD%/*})";

test -f hostconf.sh && source hostconf.sh
test -f ../../hostconf.sh && source ../../hostconf.sh

if [ "$username" = "username" ]
then
	echo "You have to provide the local mysql username in a hostconf.sh"
	exit
fi

if [ "$password" = "password" ]
then
	echo "You have to provide the local mysql password in a hostconf.sh"
	exit
fi