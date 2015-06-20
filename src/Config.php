<?php
/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

namespace BCA\Architect;

use \RoboFile;

/**
 * Store and retrieve Architect project configuration.
 */
class Config
{

    /**
     * Active configuration.
     * @var \Illuminate\Config\Repository
     */
    private static $config;

    /**
     * Default configuration.
     * @var \Illuminate\Config\Repository
     */
    private static $defaults;

    /**
     * Constructor.
     *
     * @param RoboFile $robo Robo task runner instance.
     */
    public function __construct(RoboFile $robo)
    {
        // Set system-wide default values.
        $defaults['pathArchitect'] = __DIR__;
        $defaults['pathProject'] = self::getProjectPath($robo);
        $defaults['pathComposerVendor'] = $defaults['pathProject'].'/vendor';
        $defaults['pathComposerBin'] = $defaults['pathComposerVendor'].'/bin';
        $defaults['pathBuildDir'] = $defaults['pathProject'].'/build';

        $defaults['pathsSrc'] = ['src'];
        $defaults['pathsTests'] = ['tests'];

        self::$defaults = new \Illuminate\Config\Repository($defaults);

        // Load project configuration.
        $projectConfig = [];
        $projectConfigFile = $defaults['pathProject'].'/architect.json';
        if (file_exists($projectConfigFile)) {
            $projectConfig = json_decode(file_get_contents($projectConfigFile), true);
        }

        self::$config = new \Illuminate\Config\Repository((array) $projectConfig);
    }

    /**
     * Get value of configuration key.
     * @param  string $key Key for which value should be retrieved.
     * @return mixed
     */
    public static function get($key)
    {
        $default = self::$defaults->get($key, null);

        return self::$config->get($key, $default);
    }

    /**
     * Get path to project root based on location of RoboFile.
     * @param RoboFile $robo Robo task runner instance.
     * @return string
     */
    private static function getProjectPath(RoboFile $robo)
    {
        $reflector = new \ReflectionClass($robo);
        return dirname($reflector->getFileName());
    }

    /**
     * Set value of configuration key.
     * @param string $key   Key for which value should be stored.
     * @param mixed  $value Value which should be stored for key.
     * @return  boolean
     */
    public static function set($key, $value)
    {
        self::$config->set($key, $value);

        return self::$config->has($key);
    }

    /**
     * Set default value of configuration key.
     * @param string $key   Key for which value should be stored.
     * @param mixed  $value Value which should be stored for key.
     * @return  boolean
     */
    public static function setDefault($key, $value)
    {
        self::$defaults->set($key, $value);

        return self::$defaults->has($key);
    }
}
