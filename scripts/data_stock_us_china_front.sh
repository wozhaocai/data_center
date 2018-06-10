#!/bin/sh
echo `date`
echo ' stock_us_china_end.sh start'

/usr/bin/php /home/data/wwwroot/test/scripts/job.php -bdc -tworkflow -sus_china_finance_news -asave_finance_news >/dev/null 2>&1 

echo `date`
echo ' stock_us_china_end.sh completed'