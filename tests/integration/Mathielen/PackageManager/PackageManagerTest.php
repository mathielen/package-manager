<?php
namespace Mathielen\PackageManager;

use Mathielen\PackageManager\Package\InstalledPackage;

class PackageManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @medium
     */
    public function testFull()
    {
        $pm = new PackageManager('tests/metadata/full/composer.json');

        $availablePackages = $pm->getAvailable();
        $this->assertEquals(1, count($availablePackages));

        $installedPackages = $pm->getInstalled();
        $this->assertEquals(0, count($installedPackages));

        $pm->install($availablePackages['justinrainbow/json-schema']);

        $installedPackages = $pm->getInstalled();
        $this->assertEquals(1, count($installedPackages));

        $pm->uninstall($installedPackages['justinrainbow/json-schema']);

        $installedPackages = $pm->getInstalled();
        $this->assertEquals(0, count($installedPackages));
    }

    /**
     * @medium
     */
    public function testInstalled()
    {
        $pm = new PackageManager('tests/metadata/installed/composer.json');
        $packages = $pm->getInstalled();

        $cwd = getcwd();
        copy($cwd.'/_installed.json', $cwd.'/vendor/composer/installed.json');

        $this->assertEquals(1, count($packages));
        $this->assertTrue($packages['justinrainbow/json-schema'] instanceof InstalledPackage);
        $this->assertEquals('1.3.0.0', $packages['justinrainbow/json-schema']->getVersion());

        $this->assertEquals('2015-06-20', $packages['justinrainbow/json-schema']->getInstallDate()->format('Y-m-d'));
        $this->assertEquals('1.4.2.0', $packages['justinrainbow/json-schema']->getLatestVersion());
        $this->assertTrue($packages['justinrainbow/json-schema']->isOutdated());

        $pm->update($packages['justinrainbow/json-schema']);

        $packages = $pm->getInstalled();
        $this->assertEquals(1, count($packages));
        $this->assertTrue($packages['justinrainbow/json-schema'] instanceof InstalledPackage);
        $this->assertEquals('1.4.2.0', $packages['justinrainbow/json-schema']->getVersion());
    }

    /**
     * @medium
     */
    public function testPlatform()
    {
        $pm = new PackageManager('tests/metadata/installed/composer.json');

        $packages = $pm->getPlatform();
        $this->assertEquals(66, count($packages));
    }

}
