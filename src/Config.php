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
        // Load project configuration.
        $projectConfig = [];
        $projectConfigFile = self::getProjectPath($robo).'/architect.json';
        if (file_exists($projectConfigFile)) {
            $projectConfig = json_decode(file_get_contents($projectConfigFile), true);
        }

        self::$config = new \Illuminate\Config\Repository((array) $projectConfig);

        // Set system-wide default values.
        self::$defaults = new \Illuminate\Config\Repository();

        self::setDefault('pathArchitect', __DIR__);
        self::setDefault('pathProject', self::getProjectPath($robo));
        self::setDefault('pathComposerVendor', self::get('pathProject').'/vendor');
        self::setDefault('pathComposerBin', self::get('pathComposerVendor').'/bin');
        self::setDefault('pathBuildDir', self::get('pathProject').'/build');
        self::setDefault('projectTitle', self::getProjectTitle());

        self::setDefault('pathsSrc', ['src']);
        self::setDefault('pathsTests', ['tests']);


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
     * Generate title for current project.
     * @return string Title of project
     */
    private function getProjectTitle()
    {
        $title = basename(self::get('pathProject'));
        $title = ucwords($title);
        $title = preg_replace('/-/', ' ', $title);

        return $title;
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
