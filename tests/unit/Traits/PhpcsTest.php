<?php
/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

namespace BCA\Architect\Tests\Traits;

/**
 * Test \BCA\Architect\Traits\Phpcs.
 */
class PhpcsTest extends TraitTestCase
{
    /**
     * Test Setup::taskPhpcs() runs PHP_Codesniffer.
     * @return void
     */
    public function testPhpcsTask()
    {
        $this->robo->taskPhpcs();
    }

    /**
     * Test Setup::taskPhpcs() runs PHP_Codesniffer.
     * @return void
     */
    public function testPhpcbfTask()
    {
        $this->robo->taskPhpcbf();
    }
}
