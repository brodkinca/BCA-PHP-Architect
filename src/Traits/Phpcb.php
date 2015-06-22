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

trait Phpcb
{
    /**
     * Run PHPCB.
     * @return Robo\Result
     */
    public function taskPhpcb()
    {
        $exec = $this->taskExec(Config::get('pathComposerBin').'/phpcb')
            ->option('log', Config::get('pathBuildDir').'/logs')
            ->option('output', Config::get('pathBuildDir').'/codebrowser');

        foreach (Config::get('pathsSrc') as $path) {
            $exec->option('source', $path);
        }

        return $exec->run();
    }

    /**
     * Boot phpcb trait.
     * @return void
     */
    protected function bootPhpcb()
    {
        // Set weights.
        Architect::setWeight('taskPhpcb', Architect::WEIGHT_FINAL);
    }
}
