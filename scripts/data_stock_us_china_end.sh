#!/bin/sh
echo `date`
echo ' stock_us_china_front.sh start' 

/usr/bin/php /home/data/wwwroot/wozhaocai/scripts/job.php -bdc -tscript -sSpider_us_china_code_list -aget >/dev/null 2>&1 
/usr/bin/php /home/data/wwwroot/wozhaocai/scripts/job.php -bdc -tworkflow -sus_china -asave_price >/dev/null 2>&1 

echo `date`
echo ' stock_us_china_front.sh completed'