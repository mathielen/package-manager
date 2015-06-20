<?php
namespace Mathielen\PackageManager;

use Composer\Package\CompletePackageInterface;
use Composer\Package\PackageInterface;
use Mathielen\PackageManager\Locator\ComposerSuggestPackageLocatorStrategy;
use Mathielen\PackageManager\Locator\PackageLocatorStrategyInterface;
use Mathielen\PackageManager\Package\InstalledPackage;

class PackageManager
{

    /**
     * @var ApplicationManager
     */
    private $applicationManager;

    /**
     * @var RepositoryManager
     */
    private $repositoryManager;

    public function __construct($config = null, PackageLocatorStrategyInterface $packageLocatorStrategyInterface = null)
    {
        if ($config) {
            chdir(dirname($config));
            $config = basename($config);
        }

        //set default
        if (!$packageLocatorStrategyInterface) {
            $packageLocatorStrategyInterface = new ComposerSuggestPackageLocatorStrategy($config);
        }

        $this->applicationManager = new ApplicationManager($config);
        $this->repositoryManager = new RepositoryManager($config, $packageLocatorStrategyInterface);
    }

    /**
     * @return InstalledPackage[]
     */
    public function getInstalled()
    {
        return $this->applicationManager->getInstalled();
    }

    /**
     * @return CompletePackageInterface[]
     */
    public function getAvailable()
    {
        return $this->repositoryManager->getAvailable();
    }

    /**
     * @return PackageInterface[]
     */
    public function getPlatform()
    {
        return $this->applicationManager->getPlatform();
    }

    public function install(PackageInterface $package)
    {
        $this->applicationManager->install($package);
    }

    public function uninstall(InstalledPackage $package)
    {
        $this->applicationManager->uninstall($package);
    }

    public function update(InstalledPackage $package)
    {
        $this->applicationManager->update($package);
    }
}
