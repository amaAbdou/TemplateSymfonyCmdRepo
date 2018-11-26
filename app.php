<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use App\Commands\DefaultCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$yamlFileLoader = new YamlFileLoader(
    $container,
    new FileLocator(__DIR__ . DIRECTORY_SEPARATOR . 'config')
);
$yamlFileLoader->load('container.yaml');
$container
    ->addCompilerPass(new AddConsoleCommandPass())
    ->compile()
;

$app = new Application();
$app->setDispatcher($container->get('event_dispatcher'));
$app->setCommandLoader($container->get('console.command_loader'));
$app->setDefaultCommand(DefaultCommand::getDefaultName());
$app->run();