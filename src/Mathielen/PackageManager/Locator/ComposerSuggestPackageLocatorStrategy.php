<?php
namespace Mathielen\PackageManager\Locator;

use Composer\IO\NullIO;
use Composer\Package\Package;
use Composer\Package\PackageInterface;
use Composer\Factory;

class ComposerSuggestPackageLocatorStrategy implements PackageLocatorStrategyInterface
{

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @return PackageInterface[]
     */
    public function getAvailable()
    {
        $plugins = array();

        $composer = Factory::create(new NullIO(), $this->config);

        foreach ($composer->getPackage()->getSuggests() as $id=>$version) {
            $plugins[$id] = new Package($id, $version, $version);
        }

        return $plugins;
    }

}
