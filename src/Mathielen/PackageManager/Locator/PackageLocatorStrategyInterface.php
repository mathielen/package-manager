<?php
namespace Mathielen\PackageManager\Locator;

use Composer\Package\PackageInterface;

interface PackageLocatorStrategyInterface
{

    /**
     * @return PackageInterface[]
     */
    public function getAvailablePlugins();

}
