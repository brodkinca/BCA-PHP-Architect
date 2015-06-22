<?php
/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

namespace BCA\Architect\Tests\Codeception\Module;

/**
 * Functional helper.
 */
class FunctionalHelper extends \Codeception\Module
{
    /**
     * Get string to execute command via Robo.
     * @param  string $cmd Robo task to be executed.
     * @return string      Bash-executable string.
     */
    public static function getRoboCommand($cmd)
    {
        $contentPath = ROBO_HOME;
        $roboPath = realpath(VENDOR_BIN.'/robo');

        return 'cd '.$contentPath.' && '.$roboPath.' '.$cmd;
    }
}
