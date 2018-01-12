#!/usr/bin/env bash

# run this script => bash gzip.sh <path to folder>

EXTENSIONS="css|js|ttf|eot|svg"
DIRECTORY="."

function doGzip {

	FILE_MINSIZE=512
	GZIP="gzip -9 -c -n"
	AWK=awk
	TOUCH=touch

	if [ -n "$1" ]; then
	    GZ_NAME="$1.gz"
	    DATA_PLAIN=`stat --format "%s %Y" "$1"`
	    PLAIN_SIZE=`echo "$DATA_PLAIN" | $AWK '{ print $1}'`
	    PLAIN_MTIME=`echo "$DATA_PLAIN" | $AWK '{ print $2}'`

	    if [ $PLAIN_SIZE -lt $FILE_MINSIZE ]; then
	        echo "Ignoring file $1: its size ($PLAIN_SIZE) is less than $FILE_MINSIZE bytes"
	        exit 0;
	    fi

	    if [ -f "$GZ_NAME" ]; then
	        GZIPPED_MTIME=`stat --format "%Y" "$GZ_NAME"`
	        if [ $GZIPPED_MTIME -eq $PLAIN_MTIME ]; then
	            echo "Ignoring file $1: there is a compressed file $GZ_NAME with the same modification time"
	            exit 0
	        fi
	    fi

	    $GZIP "$1" > "$GZ_NAME"
	    $TOUCH -r "$1" "$GZ_NAME"
	    echo "Compressed $1 to $GZ_NAME"
	fi
}

if [ -n "$1" ]; then
    DIRECTORY="$1"
fi

# delete *.gz files
find $DIRECTORY -name '*.gz' -delete

export -f doGzip
find $DIRECTORY -type f -regextype posix-egrep -regex ".*\.($EXTENSIONS)\$" -exec bash -c 'doGzip "{}"' \;