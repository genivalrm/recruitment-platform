#!/bin/bash

update-alternatives --set php /usr/bin/php7.2
a2enmod php7.2
service apache2 restart

apachelinker /home/project-folder/public
tail -f /tmp/dev.log
