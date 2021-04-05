#!/bin/bash
APPDIR=$HOME/Projects/Retail_Assistant
UTILSDIR=$APPDIR/utils
APPNAME="$(basename $APPDIR)"
APPSLUG="$(echo "$APPNAME" | iconv -t ascii//TRANSLIT | sed -r s/[^a-zA-Z0-9]+/-/g | sed -r s/^-+\|-+$//g | tr A-Z a-z)"
