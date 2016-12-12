#!/bin/sh

PROFILE=$1
VOLUMENAME=$2
SIZE=$3

ROOTDIR=$HOME

oc-cluster create-volume volumeName $SIZE $HOME/.oc/profiles/$PROFILE/volumes/$VOLUMENAME
