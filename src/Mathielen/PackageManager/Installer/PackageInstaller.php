<?php
namespace Mathielen\PackageManager\Installer;

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class PackageInstaller
{

    public function install($name, $version=null)
    {
        $app = new Application();
        $app->setAutoExit(false);
        $input = new ArrayInput(['require', 'packages'=>[$name.(empty($version)?'':':'.$version)]]);
        $input->setInteractive(false);
        $output = new BufferedOutput();
        $app->run($input, $output);

        return $output->fetch();
    }

    public function uninstall($name)
    {
        $app = new Application();
        $app->setAutoExit(false);
        $input = new ArrayInput(['remove', 'packages'=>[$name]]);
        $input->setInteractive(false);
        $output = new BufferedOutput();
        $app->run($input, $output);

        return $output->fetch();
    }

    public function update($name)
    {
        $app = new Application();
        $app->setAutoExit(false);
        $input = new ArrayInput(['update', 'packages'=>[$name]]);
        $input->setInteractive(false);
        $output = new BufferedOutput();
        $app->run($input, $output);

        return $output->fetch();
    }

}
