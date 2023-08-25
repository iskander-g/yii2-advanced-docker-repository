## Run docker containers
Run containers:
``` 
docker-compose up -d
```
Enter into container console:
```
docker exec -it {yii2-advanced-docker-repository-frontend-1} bash
```

### In your container:

1. Install composer:
```
composer update
```

2. Set up Cloudflare Turnstile keys in ``environments/dev/common/config/main-local.php`` and ``environments/prod/common/config/main-local.php``


3. Initialize YII2
```
php init
```

4. Run migrations
```
php yii migrate
```

now open http://localhost:20080

## Automatic localizaion via DEEPL

Exctract messages:
```
php yii message/extract @common/config/i18n.php
```

Set up your Deepl api key in file ``console/controllers/TranslationsController.php``
Localize messages:
```
php yii translations/translate-strings
```


## Scheduling tasks

Run schedule command

```
php yii schedule/run --scheduleFile=/app/console/config/schedule.php
```

Add this command to Cron