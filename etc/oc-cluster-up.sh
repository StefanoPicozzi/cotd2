#!/bin/sh

PROFILE=$1
ROOTDIR=$HOME

echo $ROOTDIR

oc cluster up \
 --public-hostname='127.0.0.1' \
 --host-data-dir=/$ROOTDIR/.oc/profiles/$PROFILE/data \
 --host-config-dir=/$ROOTDIR/.oc/profiles/$PROFILE/config \
 --routing-suffix=' ' \
 --skip-registry-check=true \
 --use-existing-config
