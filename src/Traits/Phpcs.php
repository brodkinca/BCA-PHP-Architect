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

trait Phpcs
{
    /**
     * Run PHP_Codesniffer.
     *
     * @param string $paths Space-separated paths to files.
     * @param array  $args  Array of arguments.
     *
     * @return mixed
     */
    public function taskPhpcs($paths = '', array $args = ['interactive|i' => false])
    {
        $exec = $this->taskExec(Config::get('pathComposerBin').'/phpcs')
            ->arg('--extensions=php')
            ->arg('--report=full')
            ->arg('--report=summary')
            ->arg('--report-checkstyle='.Config::get('pathBuildDir').'/logs/checkstyle.xml')
            ->arg('--standard='.Config::get('phpcsStandard'));

        // Set paths.
        if (empty($paths)) {
            $paths = Config::get('pathsPhpcs');
        }

        $exec->arg($paths);

        // Disable warnings in CI.
        if ((bool) getenv('CI')) {
            $exec->arg('-n');
        }

        // Show helpful sniff information?
        if (isset($args['verbose']) && $args['verbose']) {
            $exec->arg('-s');
        }

        // Run interactively?
        if (isset($args['interactive']) && $args['interactive']) {
            passthru($exec->arg('-a')->getCommand(), $exitCode);

            return new \Robo\Result($exec, $exitCode, 'PHPCS coding style analysis complete.');
        }

        return $exec->run();
    }

    /**
     * Run PHP_Codesniffer Beautifier.
     *
     * @param string $paths Space-separated paths to files.
     * @param array  $args  Array of arguments.
     *
     * @return Robo\Result
     */
    public function taskPhpcbf($paths = '', array $args = ['interactive|i' => false])
    {
        $exec = $this->taskExec(Config::get('pathComposerBin').'/phpcbf')
            ->arg('--extensions=php')
            ->arg('--standard='.Config::get('phpcsStandard'));

        // Set paths.
        if (empty($paths)) {
            $paths = Config::get('pathsPhpcs');
        }

        $exec->arg($paths);

        // Show helpful sniff information?
        if (isset($args['verbose']) && $args['verbose']) {
            $exec->arg('-s');
        }

        return $exec->run();
    }

    /**
     * Boot phpcs trait.
     * @return void
     */
    protected function bootPhpcs()
    {
        // Set defaults.
        Config::setDefault('pathsPhpcs', array_merge(
            (array) Config::get('pathsSrc'),
            (array) Config::get('pathsTests')
        ));

        Config::setDefault(
            'phpcsStandard',
            realpath(
                Config::get('pathComposerVendor').
                '/bca/phpcs-standard/src/BCA/CodingStandard/BCA'
            )
        );
    }
}
