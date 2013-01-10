#!/bin/bash

source global.sh

./clearCache.sh

mysqldump --user=$username --password=$password $database > dump.sql
gzip dump.sql