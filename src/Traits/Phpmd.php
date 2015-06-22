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

use \BCA\Architect\Architect;
use \BCA\Architect\Config;

trait Phpmd
{
    /**
     * Run PHPMD.
     * @return Robo\Result
     */
    public function taskPhpmd()
    {
        $exec = $this->taskExec(Config::get('pathComposerBin').'/phpmd')
            ->arg(implode(Config::get('pathsPhpmd'), ','))
            ->arg('xml')
            ->arg(Config::get('phpmdRuleset'))
            ->option('suffixes', 'php')
            ->option('reportfile', Config::get('pathBuildDir').'/logs/phpmd.xml');

        return $exec->run();
    }

    /**
     * Boot phpmd trait.
     * @return void
     */
    protected function bootPhpmd()
    {
        Config::setDefault('phpmdRuleset', 'cleancode,codesize,design,naming,unusedcode');
        Config::setDefault('pathsPhpmd', Config::get('pathsSrc'));

        // Set weights.
        Architect::setWeight('taskPhpmd', 40);
    }
}
