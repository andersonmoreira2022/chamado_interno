@servers(['dev' => 'chamadointernos@chamadointerno.sitelbra.net', 'prod' => 'chamadointerno@chamadointerno.sitelbra.com.br'])

@setup
    $repository = 'https://git.sitelbra.net/sitelbra/chamadosinterno.git';
    $releases_dir = '/var/www/chamadointerno/releases';
    $app_dir = '/var/www/chamadointerno';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
    function logMessage($message) {
        return "echo '\033[32m" .$message. "\033[0m';\n";
    }
@endsetup

@story('deploy_dev', ['on' => 'dev'])
    clone_repository
    run_composer
    run_npm
    update_symlinks
    clean_old_releases
    migrate
    optimize
@endstory

@story('deploy_prod', ['on' => 'prod'])
    clone_repository
    run_composer
    run_npm
    update_symlinks
    clean_old_releases
    migrate
    optimize
@endstory

@task('clone_repository')
    {{ logMessage("Clonando repositório") }}
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone -q --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
    find {{ $new_release_dir }} -type f -exec chmod 744 {} \;
    find {{ $new_release_dir }} -type d -exec chmod 755 {} \;
    chmod -R 775 {{ $new_release_dir }}/bootstrap
@endtask

@task('run_composer')
    echo "Iniciando implantação ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o --optimize-autoloader --no-dev
@endtask

@task('run_npm')
    {{ logMessage("Rodando: npm run build ") }}
    cd {{ $new_release_dir }}
    npm install
    npm run build
@endtask

@task('migrate')
    cd {{ $app_dir }}/current
    {{ logMessage("Executando Database Migrations...") }}
    php artisan down
    php artisan migrate --force
@endtask

@task('update_symlinks')
    {{ logMessage("Link diretório storage") }}
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    {{ logMessage("Link diretório public/storage") }}
    ln -nfs {{ $app_dir }}/storage/app/public {{ $new_release_dir }}/public/storage

    {{ logMessage("criando Link .env") }}
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    {{ logMessage(" Release Atual: $new_release_dir ") }}
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('clean_old_releases')
    # Delete all but the 5 most recent releases
    {{ logMessage("Limpando releases antigos.") }}
    cd {{ $releases_dir }}
    ls -dt {{ $releases_dir }}/* | tail -n +10 | xargs -d "\n" rm -rf;
@endtask

@task('optimize')
    {{ logMessage("optimizacao e limpeza de cache ") }}
    cd {{ $app_dir }}/current
    php artisan auth:clear-resets
    php artisan cache:clear
    php artisan config:clear
    php artisan config:cache
    php artisan route:clear
    php artisan route:cache
    php artisan view:clear
    php artisan view:cache
    php artisan storage:link
    php artisan optimize
    chmod -R 775 {{ $new_release_dir }}/bootstrap
    php artisan up
@endtask


