#!/bin/bash
DATE=$(date +%F)

if [ ! -e './storage/framework/last_updated' ]; then
    echo '2020-10-10' > ./storage/framework/last_updated
fi

LAST_UPDATED=$(head -n 1 ./storage/framework/last_updated)

if [ "$LAST_UPDATED" != $DATE ]
then
    composer update
    npm update
    npm install playwright@latest && npx playwright install

    echo $DATE > ./storage/framework/last_updated
fi

npx concurrently \
    -c "#22b1dd,#b12c85,#f3a61d,#94bf3e,#e94e77,#465871" \
    "php artisan queue:listen --tries=1" \
    "npm run dev" \
    "php artisan schedule:work" \
    "tail -F storage/logs/git-hooks.log" \
    "tail -F storage/logs/laravel-$(date +%F).log" \
    "tail -F storage/logs/updates-$(date +%F).log" \
    --names="queue,vite,schedule,git,log,updates" --kill-others
