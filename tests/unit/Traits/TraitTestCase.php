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
 * Test case for Robo traits.
 */
abstract class TraitTestCase extends \PHPUnit_Framework_TestCase
{
    const BUILD_DIR = ROBO_HOME.'/build';

    /**
     * Instance of \RoboFile with necessary traits loaded.
     * @var \RoboFile
     */
    protected $robo;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->robo = new \RoboFile;
    }

    /**
     * Setup tasks.
     * @return  void
     */
    protected function setUp()
    {
        \AspectMock\Test::clean();
    }
}
