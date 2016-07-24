#!/usr/bin/env bash

# run this script => bash assets_brotli.sh <path to folder>

EXTENSIONS="css|js|ttf|eot|svg"
DIRECTORY="."

function doBrotli {

	FILE_MINSIZE=1024
	BROTLI="brotli --quality 11"
	AWK=awk
	TOUCH=touch

	if [ -n "$1" ]; then
	    BR_NAME="$1.br"
	    DATA_PLAIN=`stat --format "%s %Y" "$1"`
	    PLAIN_SIZE=`echo "$DATA_PLAIN" | $AWK '{ print $1}'`
	    PLAIN_MTIME=`echo "$DATA_PLAIN" | $AWK '{ print $2}'`

	    if [ $PLAIN_SIZE -lt $FILE_MINSIZE ]; then
	        echo "Ignoring file $1: its size ($PLAIN_SIZE) is less than $FILE_MINSIZE bytes"
	        exit 0;
	    fi
	    
	    $BROTLI --input "$1" --output "$BR_NAME"
	    $TOUCH -r "$1" "$BR_NAME"
	    echo "Compressed $1 to $BR_NAME"
	fi
}

if [ -n "$1" ]; then
    DIRECTORY="$1"
fi

# delete *.br files
find $DIRECTORY -name '*.br' -delete

export -f doBrotli
find $DIRECTORY -type f -regextype posix-egrep -regex ".*\.($EXTENSIONS)\$" -exec bash -c 'doBrotli "{}"' \;