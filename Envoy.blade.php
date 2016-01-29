@servers(['web' => 'root@smart-robox.com'])

@setup
    $directory = "/home/smartrobox/apps/box/startersite";
    $repository = "git@bitbucket.org:boxadvertainment/starter-site.git";
@endsetup

@macro('create')
    clone
    configure
@endmacro

@macro('deploy')
    pull
    configure
@endmacro

@macro('refresh')
    delete
    clone
    configure
@endmacro

@task('clone')
    git clone -b master {{ $repository }} {{ $directory }};

    cd {{ $directory }};
    composer self-update;
    composer install --prefer-dist --no-dev --no-interaction;

    cp .env.production .env;

    echo "Project has been created";
@endtask

@task('pull')
    cd {{ $directory }};

    php artisan down;

    git pull origin master;
    composer install --prefer-dist --no-dev --no-interaction;

    cp .env.production .env;

    php artisan up;
    echo "Deployment finished successfully!";
@endtask

@task('configure')
    cd {{ $directory }};

    php artisan config:cache;
    php artisan route:cache;

    chown -R www-data:www-data {{ $directory }};
    echo "Permissions have been set";
@endtask

@task('delete', ['confirm' => true])
    rm -rf {{ $directory }};
    echo "Project directory has been deleted";
@endtask

@task('reset', ['confirm' => true])
    cd {{ $directory }};
    git reset --hard HEAD;
@endtask

@task('migrate')
    cd {{ $directory }};
    php artisan migrate --force;
@endtask

@task('rollback')
    cd {{ $directory }};
    php artisan migrate:rollback --force;
@endtask

@task('seed')
    cd {{ $directory }};
    php artisan db:seed --force;
@endtask
