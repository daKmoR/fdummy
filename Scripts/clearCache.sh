#!/bin/bash

source global.sh

mysql --user=$username --password=$password $database < clearCache.sql