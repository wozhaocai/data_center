#!/bin/sh
echo `date`
echo ' stock_china_front.sh start'

/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_a_finance_news -asave_sh_finance_news >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_a_finance_news -asave_sz_finance_news >/dev/null 2>&1 
/usr/local/bin/php /home/wozhad3j/scripts/job.php -bdc -tworkflow -schina_hk_finance_news -asave_finance_news >/dev/null 2>&1 

echo `date`
echo ' stock_china_front.sh completed'

