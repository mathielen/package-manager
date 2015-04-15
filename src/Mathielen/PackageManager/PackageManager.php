<?php
namespace Mathielen\PackageManager;

use Composer\Package\PackageInterface;
use Mathielen\PackageManager\Installer\PackageInstaller;
use Mathielen\PackageManager\Locator\ComposerSuggestPackageLocatorStrategy;
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

    public function __construct($config = null)
    {
        if ($config) {
            chdir(dirname($config));
            $config = basename($config);
        }

        $pluginInstaller = new PackageInstaller();

        $this->applicationManager = new ApplicationManager($config);
        $this->repositoryManager = new RepositoryManager(
            new ComposerSuggestPackageLocatorStrategy($config, $pluginInstaller)
        );
    }

    /**
     * @return InstalledPackage[]
     */
    public function getInstalled()
    {
        return $this->applicationManager->getInstalled();
    }

    /**
     * @return PackageInterface[]
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
