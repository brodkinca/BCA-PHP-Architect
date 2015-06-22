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
 * Test \BCA\Architect\Traits\Setup.
 */
class SetupTest extends TraitTestCase
{
    const BUILD_DIR = ROBO_HOME.'/build';

    /**
     * Test Setup::archSetup() creates needed directories.
     * @return void
     */
    public function testSetupTask()
    {
        // Prepare directory.
        $this->robo->archClean();
        rmdir(self::BUILD_DIR);

        // Run tests.
        $this->assertFileNotExists(self::BUILD_DIR);
        $this->robo->archSetup();
        $this->assertFileExists(self::BUILD_DIR);
    }

    /**
     * Test Setup::archClean() deletes contents of build directory.
     * @return void
     */
    public function testCleanTask()
    {
        $path = self::BUILD_DIR.'/file.txt';

        $this->robo->archSetup();
        touch($path);

        $this->assertFileExists($path);
        $this->robo->archClean();
        $this->assertFileNotExists($path);
    }
}
