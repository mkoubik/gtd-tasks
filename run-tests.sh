#!/bin/sh

# Path to this script's directory
dir=$(cd `dirname $0` && pwd)

$dir/libs/bin/phpunit --bootstrap $dir/tests/bootstrap.php $dir/tests
if [ $? != 0 ]; then
	echo "\n\n !!! FAIL !!! \n"
fi
