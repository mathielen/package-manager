<?php
namespace Mathielen\PackageManager;

use Composer\DependencyResolver\Pool;
use Composer\Package\CompletePackageInterface;
use Composer\Package\PackageInterface;
use Composer\Package\Version\VersionSelector;
use Composer\Repository\CompositeRepository;
use Composer\Factory;
use Composer\IO\NullIO;
use Composer\Repository\PlatformRepository;
use Mathielen\PackageManager\Installer\PackageInstaller;
use Mathielen\PackageManager\Package\InstalledPackage;

class ApplicationManager
{

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function install(PackageInterface $package)
    {
        $packageInstaller = new PackageInstaller();
        $packageInstaller->install($package->getName(), $package->getVersion());
    }

    public function uninstall(PackageInterface $package)
    {
        $packageInstaller = new PackageInstaller();
        $packageInstaller->uninstall($package->getName());
    }

    public function update(PackageInterface $package)
    {
        $packageInstaller = new PackageInstaller();
        $packageInstaller->update($package->getName());
    }

    /**
     * @return PackageInterface[]
     */
    public function getInstalled()
    {
        $composer = Factory::create(new NullIO(), $this->config);

        $localRepo = $composer->getRepositoryManager()->getLocalRepository();
        $repos = new CompositeRepository(array_merge(array($localRepo), $composer->getRepositoryManager()->getRepositories()));

        $pool = new Pool();
        $pool->addRepository($repos);
        $vs = new VersionSelector($pool);

        $packages = [];
        foreach ($localRepo->getPackages() as $package) {
            if (!isset($packages[$package->getName()])
                || !is_object($packages[$package->getName()])
                || version_compare($packages[$package->getName()]->getVersion(), $package->getVersion(), '<')
            ) {
                if ($package instanceof CompletePackageInterface) {
                    $latestPackage = $vs->findBestCandidate($package->getName());
                    $package = new InstalledPackage($package, $latestPackage);
                }

                $packages[$package->getName()] = $package;
            }
        }

        return $packages;
    }

    public function getPlatform()
    {
        $repo = new PlatformRepository();

        $packages = [];
        foreach ($repo->getPackages() as $package) {
            if (!isset($packages[$package->getName()])
                || !is_object($packages[$package->getName()])
                || version_compare($packages[$package->getName()]->getVersion(), $package->getVersion(), '<')
            ) {
                $packages[$package->getName()] = $package;
            }
        }

        return $packages;
    }

}
