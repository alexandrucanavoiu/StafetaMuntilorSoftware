#!/bin/bash

if [ -z "$1" ]; then
    echo "No FILE_PATH provided"
    exit -1
fi

if [ ! -e "$1" ]; then
    echo "File doesn't exists: $1"
    exit -1
fi

source var/scripts/config.sh
FILE_PATH=$1

var/scripts/db-export.sh && \

echo "- decompressing..." && \
gunzip < $FILE_PATH > ${BACKUP_DIR}/snapshot.sql && \

echo "- importing ${FILE_PATH}..." && \
mysql --default-character-set=utf8 --user=$DB_USER --password=$DB_PASS $DB_NAME < ${BACKUP_DIR}/snapshot.sql && \

exit 0