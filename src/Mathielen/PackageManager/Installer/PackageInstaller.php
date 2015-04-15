<?php
namespace Mathielen\PackageManager\Installer;

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class PackageInstaller
{

    public function install($name)
    {
        $app = new Application();
        $app->setAutoExit(false);
        $input = new ArrayInput(['require', 'packages'=>[$name]]);
        $output = new NullOutput();
        $app->run($input, $output);
    }

    public function uninstall($name)
    {
        $app = new Application();
        $app->setAutoExit(false);
        $input = new ArrayInput(['remove', 'packages'=>[$name]]);
        $output = new NullOutput();
        $app->run($input, $output);
    }

    public function update($name)
    {
        $app = new Application();
        $app->setAutoExit(false);
        $input = new ArrayInput(['update', 'packages'=>[$name]]);
        $output = new NullOutput();
        $app->run($input, $output);
    }

}
