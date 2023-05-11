- [x] Run autoload:
```
composer dump-autoload
```

- [x] Run migrations example:
```
php /LOCAL_PATH_TO_APP/beachbum/app/db/Migrations.php
```

- [x] Add to crontab:

```
* * * * * php /LOCAL_PATH_TO_APP/beachbum/app/crons/work.php >> /LOCAL_PATH_TO_APP/beachbum/app/crons/log-`date +\%Y-\%m-\%d`.log  2>&1
```

