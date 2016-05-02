<?php
namespace Framework\Helper\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Framework\Config\Config;

class DataManager implements DataManagerInterface
{
    public static function getManager()
    {
        $paths     = [realpath(getcwd() . "/src/App/Model/Entity")];
        $isDevMode = true;

        $config1 = Config::getConfig();
        if (isset($config1['db'])) {
            $dbParams = $config1['db'];
        } else {
            throw new \Exception('Not set db params in config');
        }

        $config        = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);

        return $entityManager;
    }
}