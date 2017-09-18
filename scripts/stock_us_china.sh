#!/bin/sh
/usr/local/bin/php job.php -bdc -tscript -sSpider_us_china_code_list -aget
/usr/local/bin/php job.php -bdc -tworkflow -sus_china -asave_price