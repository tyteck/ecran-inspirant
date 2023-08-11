#!/usr/bin/zsh
containerName=inspiration

# updating code
git pull

# creating symlink from public to storage
if [[ ! -L "./public/storage" ]]; then
    docker exec -it --user www-data $containerName php artisan storage:link
fi

# installing php modules
docker run --rm -v $(pwd):/app composer:2.3 install --ignore-platform-reqs --prefer-dist

# building css/js
npm install && npm run build

