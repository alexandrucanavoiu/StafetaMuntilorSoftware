#!/bin/bash

source var/scripts/config.sh

SQL_FILE="${ENV}-${DB_NAME}-db-snapshot.sql"
BACKUP_FILE="${SQL_FILE}.gz"

BACKUP_RELATIVE_PATH="${BACKUP_DIR}/${BACKUP_FILE}"
SQL_RELATIVE_PATH="${BACKUP_DIR}/${SQL_FILE}"
BACKUP_PATH="${APP_PATH}/${BACKUP_RELATIVE_PATH}"
echo "- executing locally: " && \

var/scripts/db-export.sh ${SQL_RELATIVE_PATH} && \

echo "- uploading file to: ${BACKUP_PATH}" && \
scp -P $SERVER_PORT ${BACKUP_RELATIVE_PATH} ${SERVER_USER}@${SERVER_HOST}:${BACKUP_PATH} && \

echo "- executing remotely: " && \
/bin/ssh -T -p $SERVER_PORT ${SERVER_USER}@${SERVER_HOST} bash -c "'
cd ${APP_PATH} && \
var/scripts/db-import.sh ${BACKUP_RELATIVE_PATH}
'"  && \

echo "- done"