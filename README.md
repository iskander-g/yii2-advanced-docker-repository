

docker-compose up -d

docker exec -it yii2-advanced-docker-repository-frontend-1 bash

in your container:

composer update

php init

php yii message/extract @common/config/i18n.php

php yii translations/translate-strings