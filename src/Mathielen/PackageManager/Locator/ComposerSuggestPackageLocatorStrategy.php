<?php
namespace Mathielen\PackageManager\Locator;

use Composer\IO\NullIO;
use Composer\Package\Package;
use Composer\Package\PackageInterface;
use Composer\Factory;
use Mathielen\PackageManager\Installer\PackageInstaller;

class ComposerSuggestPackageLocatorStrategy implements PackageLocatorStrategyInterface
{

    private $config;

    /**
     * @var PackageInstaller
     */
    private $pluginInstaller;

    public function __construct($config, PackageInstaller $pluginInstaller)
    {
        $this->config = $config;
        $this->pluginInstaller = $pluginInstaller;
    }

    /**
     * @return PackageInterface[]
     */
    public function getAvailablePlugins()
    {
        $plugins = array();

        $composer = Factory::create(new NullIO(), $this->config);

        foreach ($composer->getPackage()->getSuggests() as $id=>$version) {
            $plugins[$id] = new Package($id, $version, $version);
        }

        return $plugins;
    }

}
