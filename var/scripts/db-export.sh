#!/bin/bash

source var/scripts/config.sh
FILE_PATH=$1

if [ -z "$1" ]; then
    TIME=$(/bin/date +%Y-%m-%d-%H.%M.%S)
    SQL_FILE="${ENV}-${DB_NAME}-db-${TIME}.sql"
    BACKUP_FILE="${SQL_FILE}.gz"
    BACKUP_RELATIVE_PATH="${BACKUP_DIR}/${BACKUP_FILE}"
else
    BACKUP_RELATIVE_PATH=$1.gz
fi

echo "- performing DB backup into file: ${BACKUP_RELATIVE_PATH}" && \
mysqldump --default-character-set=utf8 --user=$DB_USER --password=$DB_PASS $DB_NAME | gzip -c | cat > ${BACKUP_RELATIVE_PATH} && \

exit 0