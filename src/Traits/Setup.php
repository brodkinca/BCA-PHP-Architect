<?php
/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

namespace BCA\Architect\Traits;

use \BCA\Architect\Config;

trait Setup
{
    /**
     * Clean build directory.
     * @return void
     */
    public function archClean()
    {
        $this->archSetup();
        
        $path = Config::get('pathProject').'/build';
        $this->taskCleanDir($path)->run();
    }

    /**
     * Setup build directory.
     * @return void
     */
    public function archSetup()
    {
        $path = Config::get('pathProject').'/build';

        $this->taskFileSystemStack()
            ->run();

        $this->taskFileSystemStack()
            ->mkdir($path.'/api')
            ->mkdir($path.'/codebrowser')
            ->mkdir($path.'/logs')
            ->run();
    }
}
