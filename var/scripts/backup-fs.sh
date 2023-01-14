#!/bin/sh

NAME="bcf"

TIME=$(date +%Y-%m-%d-%H.%M.%S)
CURRENT_DIR="$(cd "$(dirname "$0")" && pwd)"
TARGET_DIR="$CURRENT_DIR/../../"
BACKUP_DIR="$CURRENT_DIR/../backups"
BACKUP_FILE="$BACKUP_DIR/$NAME-fs-$TIME.sql.gz"


zip -qr $BACKUP_FILE $TARGET_DIR \
--exclude=*.DS_Store* \
--exclude=*.git \
--exclude=*.zip \

echo "Backup filesystem in $BACKUP_FILE"
# echo "Removing old files from $BACKUP_DIR/$NAME-fs*"
# find $BACKUP_DIR/$NAME-fs* -mtime +90 -exec rm {} \;
