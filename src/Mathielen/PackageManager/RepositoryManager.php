<?php
namespace Mathielen\PackageManager;

use Composer\Factory;
use Composer\IO\NullIO;
use Composer\Package\CompletePackageInterface;
use Mathielen\PackageManager\Locator\PackageLocatorStrategyInterface;

class RepositoryManager
{

    private $config;

    /**
     * @var PackageLocatorStrategyInterface
     */
    private $packageLocatorStrategy;

    public function __construct($config, PackageLocatorStrategyInterface $packageLocatorStrategy)
    {
        $this->config = $config;
        $this->packageLocatorStrategy = $packageLocatorStrategy;
    }

    /**
     * @return CompletePackageInterface[]
     */
    public function getAvailable()
    {
        $composer = Factory::create(new NullIO(), $this->config);

        //transform to complete packages
        $availablePackages = array();
        foreach ($this->packageLocatorStrategy->getAvailable() as $id=>$availablePackage) {
            $completePackage = $composer->getRepositoryManager()->findPackage($availablePackage->getName(), $availablePackage->getVersion());
            $availablePackages[$id] = $completePackage;
        }

        return $availablePackages;
    }

}
