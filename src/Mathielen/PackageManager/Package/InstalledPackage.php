<?php
namespace Mathielen\PackageManager\Package;

use Composer\Package\CompletePackageInterface;
use Composer\Package\PackageInterface;
use Composer\Repository\RepositoryInterface;

class InstalledPackage implements CompletePackageInterface
{

    /**
     * @var CompletePackageInterface
     */
    private $installedPackage;

    /**
     * @var PackageInterface
     */
    private $latestPackage;

    public function __construct(CompletePackageInterface $installedPackage, PackageInterface $latestPackage)
    {
        $this->installedPackage = $installedPackage;
        $this->latestPackage = $latestPackage;
    }

    public function getInstallDate()
    {
        //get the composer.json file of the package to check its modified-date
        $repository = $this->installedPackage->getRepository();
        $reflection = new \ReflectionClass('Composer\Repository\FilesystemRepository');
        $p = $reflection->getProperty('file');
        $p->setAccessible(true);
        $file = $p->getValue($repository);
        $installDate = filemtime($file->getPath());

        return \DateTime::createFromFormat('U', $installDate);
    }

    public function isOutdated()
    {
        return version_compare($this->getVersion(), $this->getLatestVersion(), '<');
    }

    public function getLatestVersion()
    {
        return $this->latestPackage->getVersion();
    }

    /**
     * Returns the scripts of this package
     *
     * @return array array('script name' => array('listeners'))
     */
    public function getScripts()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns an array of repositories
     *
     * {"<type>": {<config key/values>}}
     *
     * @return array Repositories
     */
    public function getRepositories()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package license, e.g. MIT, BSD, GPL
     *
     * @return array The package licenses
     */
    public function getLicense()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns an array of keywords relating to the package
     *
     * @return array
     */
    public function getKeywords()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package homepage
     *
     * @return string
     */
    public function getHomepage()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns an array of authors of the package
     *
     * Each item can contain name/homepage/email keys
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the support information
     *
     * @return array
     */
    public function getSupport()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns if the package is abandoned or not
     *
     * @return boolean
     */
    public function isAbandoned()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * If the package is abandoned and has a suggested replacement, this method returns it
     *
     * @return string
     */
    public function getReplacementPackage()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package's name without version info, thus not a unique identifier
     *
     * @return string package name
     */
    public function getName()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package's pretty (i.e. with proper case) name
     *
     * @return string package name
     */
    public function getPrettyName()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a set of names that could refer to this package
     *
     * No version or release type information should be included in any of the
     * names. Provided or replaced package names need to be returned as well.
     *
     * @return array An array of strings referring to this package
     */
    public function getNames()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Allows the solver to set an id for this package to refer to it.
     *
     * @param int $id
     */
    public function setId($id)
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Retrieves the package's id set through setId
     *
     * @return int The previously set package id
     */
    public function getId()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns whether the package is a development virtual package or a concrete one
     *
     * @return bool
     */
    public function isDev()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package type, e.g. library
     *
     * @return string The package type
     */
    public function getType()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package targetDir property
     *
     * @return string The package targetDir
     */
    public function getTargetDir()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package extra data
     *
     * @return array The package extra data
     */
    public function getExtra()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Sets source from which this package was installed (source/dist).
     *
     * @param string $type source/dist
     */
    public function setInstallationSource($type)
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns source from which this package was installed (source/dist).
     *
     * @return string source/dist
     */
    public function getInstallationSource()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the repository type of this package, e.g. git, svn
     *
     * @return string The repository type
     */
    public function getSourceType()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the repository url of this package, e.g. git://github.com/naderman/composer.git
     *
     * @return string The repository url
     */
    public function getSourceUrl()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the repository urls of this package including mirrors, e.g. git://github.com/naderman/composer.git
     *
     * @return array
     */
    public function getSourceUrls()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the repository reference of this package, e.g. master, 1.0.0 or a commit hash for git
     *
     * @return string The repository reference
     */
    public function getSourceReference()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the source mirrors of this package
     *
     * @return array|null
     */
    public function getSourceMirrors()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the type of the distribution archive of this version, e.g. zip, tarball
     *
     * @return string The repository type
     */
    public function getDistType()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the url of the distribution archive of this version
     *
     * @return string
     */
    public function getDistUrl()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the urls of the distribution archive of this version, including mirrors
     *
     * @return array
     */
    public function getDistUrls()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the reference of the distribution archive of this version, e.g. master, 1.0.0 or a commit hash for git
     *
     * @return string
     */
    public function getDistReference()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the sha1 checksum for the distribution archive of this version
     *
     * @return string
     */
    public function getDistSha1Checksum()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the dist mirrors of this package
     *
     * @return array|null
     */
    public function getDistMirrors()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the version of this package
     *
     * @return string version
     */
    public function getVersion()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the pretty (i.e. non-normalized) version string of this package
     *
     * @return string version
     */
    public function getPrettyVersion()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the release date of the package
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the stability of this package: one of (dev, alpha, beta, RC, stable)
     *
     * @return string
     */
    public function getStability()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a set of links to packages which need to be installed before
     * this package can be installed
     *
     * @return array An array of package links defining required packages
     */
    public function getRequires()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a set of links to packages which must not be installed at the
     * same time as this package
     *
     * @return array An array of package links defining conflicting packages
     */
    public function getConflicts()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a set of links to virtual packages that are provided through
     * this package
     *
     * @return array An array of package links defining provided packages
     */
    public function getProvides()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a set of links to packages which can alternatively be
     * satisfied by installing this package
     *
     * @return array An array of package links defining replaced packages
     */
    public function getReplaces()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a set of links to packages which are required to develop
     * this package. These are installed if in dev mode.
     *
     * @return array An array of package links defining packages required for development
     */
    public function getDevRequires()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a set of package names and reasons why they are useful in
     * combination with this package.
     *
     * @return array An array of package suggestions with descriptions
     */
    public function getSuggests()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns an associative array of autoloading rules
     *
     * {"<type>": {"<namespace": "<directory>"}}
     *
     * Type is either "psr-4", "psr-0", "classmap" or "files". Namespaces are mapped to
     * directories for autoloading using the type specified.
     *
     * @return array Mapping of autoloading rules
     */
    public function getAutoload()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns an associative array of dev autoloading rules
     *
     * {"<type>": {"<namespace": "<directory>"}}
     *
     * Type is either "psr-4", "psr-0", "classmap" or "files". Namespaces are mapped to
     * directories for autoloading using the type specified.
     *
     * @return array Mapping of dev autoloading rules
     */
    public function getDevAutoload()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a list of directories which should get added to PHP's
     * include path.
     *
     * @return array
     */
    public function getIncludePaths()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Stores a reference to the repository that owns the package
     *
     * @param RepositoryInterface $repository
     */
    public function setRepository(RepositoryInterface $repository)
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a reference to the repository that owns the package
     *
     * @return RepositoryInterface
     */
    public function getRepository()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package binaries
     *
     * @return array
     */
    public function getBinaries()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns package unique name, constructed from name and version.
     *
     * @return string
     */
    public function getUniqueName()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns the package notification url
     *
     * @return string
     */
    public function getNotificationUrl()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Converts the package into a readable and unique string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Converts the package into a pretty readable string
     *
     * @return string
     */
    public function getPrettyString()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a list of patterns to exclude from package archives
     *
     * @return array
     */
    public function getArchiveExcludes()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

    /**
     * Returns a list of options to download package dist files
     *
     * @return array
     */
    public function getTransportOptions()
    {
        return $this->installedPackage->{__FUNCTION__}();
    }

}
