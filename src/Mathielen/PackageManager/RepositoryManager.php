<?php
namespace Mathielen\PackageManager;

use Composer\Package\PackageInterface;
use Mathielen\PackageManager\Locator\PackageLocatorStrategyInterface;

class RepositoryManager
{

    /**
     * @var PackageLocatorStrategyInterface
     */
    private $packageLocatorStrategy;

    public function __construct(PackageLocatorStrategyInterface $packageLocatorStrategy)
    {
        $this->packageLocatorStrategy = $packageLocatorStrategy;
    }

    /**
     * @return PackageInterface[]
     */
    public function getAvailable()
    {
        return $this->packageLocatorStrategy->getAvailablePlugins();
    }

}
