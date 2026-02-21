<?php

namespace Deployer;

// load in the Laravel recipe, this will do the heavy lifting.
require 'recipe/laravel.php';

// tell Deployer where your Git repository is
set('http_user', 'Jas-n');
set('application', 'fuse');
set('repository', 'git@github.com:jas-n/fuse.git');
set('ssh_multiplexing', true);

// configure your environments, you can have as many as you like here!
host('console.jas-n.com')
    ->set('port', 10500)
    ->set('remote_user', 'Jas-n')
    ->set('branch', 'main') // Git branch
    ->set('deploy_path', '/home/Jas-n/web/fuse.jas-n.dev/public_html');

// now onto the build steps, in most cases, you can leave these as below,
// but you can add or remove build steps as required!
// compile our production assets
task('npm:build', function () {
    run('cd {{release_path}} && npm install');
    run('cd {{release_path}} && npm run build');
    // run('cd {{release_path}} && npm install --omit=dev');
})->desc('Compile npm files locally');
after('deploy:vendors', 'npm:build');

// automatically unlock when a deploy fails
after('deploy:failed', 'deploy:unlock');

// after a deploy, clear our cache and run optimisations
after('deploy:cleanup', 'artisan:optimize:clear');
after('deploy:cleanup', 'artisan:optimize');

// handle queue restarts
after('deploy:success', 'artisan:queue:restart');
after('rollback', 'artisan:queue:restart');
