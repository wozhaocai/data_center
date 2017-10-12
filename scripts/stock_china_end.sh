#!/bin/sh
echo `date`
echo ' stock_china_end.sh start'

/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tscript -sSpider_china_sh_code_list -aget >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_sh -asave_price >/dev/null 2>&1 

/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tscript -sSpider_china_sz_code_list -aget >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_sz -asave_price >/dev/null 2>&1 

/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tscript -sSpider_china_hk_code_list -aget >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_hk -asave_price >/dev/null 2>&1 

echo `date`
echo ' stock_china_end.sh completed'