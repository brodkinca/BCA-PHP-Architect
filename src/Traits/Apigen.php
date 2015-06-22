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

trait Apigen
{
    /**
     * Generate API docs.
     *
     * @return Robo\Result
     */
    public function taskApi()
    {
        $exec = $this->taskExec(Config::get('pathComposerBin').'/apigen')
            ->arg('generate')
            ->option('todo')
            ->option('tree')
            ->option('template-theme', 'bootstrap')
            ->option('title', '\''.Config::get('projectTitle').'\'')
            ->option('source', implode(Config::get('pathsApigen'), ' '))
            ->option('destination', Config::get('pathBuildDir').'/api');

        return $exec->run();
    }

    /**
     * Boot codeception trait.
     * @return void
     */
    protected function bootApigen()
    {
        // Set defaults.
        Config::setDefault('pathsApigen', Config::get('pathsSrc'));

        // Set weights.
        Architect::setWeight('taskApi', Architect::WEIGHT_NO_RUN);
    }
}
