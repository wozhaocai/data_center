#!/bin/sh
echo `date`
echo ' stock_china_front.sh start'

/usr/bin/php /home/data/wwwroot/wozhaocai/scripts/job.php -bdc -tworkflow -schina_a_finance_news -asave_sh_finance_news >/dev/null 2>&1 
/usr/bin/php /home/data/wwwroot/wozhaocai/scripts/job.php -bdc -tworkflow -schina_a_finance_news -asave_sz_finance_news >/dev/null 2>&1 
/usr/bin/php /home/data/wwwroot/wozhaocai/scripts/job.php -bdc -tworkflow -schina_hk_finance_news -asave_finance_news >/dev/null 2>&1 

echo `date`
echo ' stock_china_front.sh completed'

