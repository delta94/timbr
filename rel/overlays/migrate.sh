#!/bin/sh
# starts the db migration

BIN_DIR=`dirname "$0"`

${BIN_DIR}/bin/timbr eval ChatApi.Release.migrate
