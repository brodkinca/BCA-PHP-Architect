<?php
/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

namespace BCA\Architect\Tests;

use BCA\Architect\Tests\FunctionalTester;
use BCA\Architect\Tests\Codeception\Module\FunctionalHelper;

/**
 * Test task:phpcs via Robo CLI.
 */
class PhpcsCest
{
    /**
     * Checkstyle for valid code.
     * @param  FunctionalTester $I Codeception actor.
     * @return void
     */
    public function tryCheckstyleValidCode(FunctionalTester $I)
    {
        $I->wantTo('run PHPCS on valid code.');
        $I->runShellCommand(FunctionalHelper::getRoboCommand('task:phpcs phpcs/pass.php'));
    }

    /**
     * Checktyle for invalid code.
     * @param  FunctionalTester $I Codeception actor.
     * @return void
     */
    public function tryCheckstyleInvalidCode(FunctionalTester $I)
    {
        $I->wantTo('run PHPCS on invalid code.');
        $I->runShellCommand(
            FunctionalHelper::getRoboCommand('task:phpcs phpcs/fail.php'),
            false
        );
        $I->seeInShellOutput('ERROR');
    }

    /**
     * Checkstyle for mixed code.
     * @param  FunctionalTester $I Codeception actor.
     * @return void
     */
    public function tryCheckstyleMixedCode(FunctionalTester $I)
    {
        $I->wantTo('run PHPCS on mixed code.');
        $I->runShellCommand(
            FunctionalHelper::getRoboCommand('task:phpcs phpcs'),
            false
        );
        $I->seeInShellOutput('ERROR');
    }
}
