<?php
namespace Mathielen\PackageManager\Locator;

use Composer\Package\Package;
use Composer\Package\PackageInterface;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;

class RemoteQueryPackageLocatorStrategy implements PackageLocatorStrategyInterface
{

    private $urlToPackageList;

    public function __construct($urlToPackageList)
    {
        if (!is_string($urlToPackageList) || empty($urlToPackageList)) {
            throw new InvalidArgumentException("urlToPackageList must be an url");
        }

        $this->urlToPackageList = $urlToPackageList;
    }

    /**
     * @return PackageInterface[]
     */
    public function getAvailable()
    {
        $packageList = file_get_contents($this->urlToPackageList);
        if (false === $packageList) {
            throw new \LogicException("Could not download package-list from $this->urlToPackageList");
        }

        $packages = array();

        $packageList = json_decode($packageList, true);
        foreach ($packageList as $id=>$version) {
            $packages[$id] = new Package($id, $version, $version);
        }

        return $packages;
    }

}
