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
use \Robo\Output;
use \Robo\Task\Exec;
use \Robo\Result;

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
}
