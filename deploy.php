<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:erikgreasy/mixer.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('mixer.greasy.dev')
    ->set('remote_user', 'ploi')
    ->set('deploy_path', '~/mixer.greasy.dev');

// Hooks

after('deploy:failed', 'deploy:unlock');
