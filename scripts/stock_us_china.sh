#!/bin/sh
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tscript -sSpider_us_china_code_list -aget >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -sus_china -asave_price >/dev/null 2>&1 

echo `date`
echo ' stock_us_china.sh completed'