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

use \BCA\Architect\Config;

/**
 * Test \BCA\Architect\Config.
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Project configuartion repository.
     * @var \BCA\Architect\Config
     */
    private $config;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->config = new Config(new \RoboFile);
    }

    /**
     * Setup tests.
     * @return void
     */
    public function setUp()
    {
        $this->config->__construct(new \RoboFile);
    }

    /**
     * Test retrieving stored value.
     * @return void
     */
    public function testRetrievingValue()
    {
        $key = 'key';
        $value = 'value';
        $defaultValue = 'foobar';

        // Default value only.
        $this->config->setDefault($key, $defaultValue);
        $this->assertThat(
            $this->config->get($key),
            $this->equalTo($defaultValue)
        );

        // Project value overrides default value.
        $this->config->set($key, $value);
        $this->assertThat(
            $this->config->get($key),
            $this->equalTo($value)
        );
    }

    /**
     * Test retrieving stored value statically.
     * @return void
     */
    public function testRetrievingValueStatically()
    {
        $key = 'key';
        $value = 'value';
        $defaultValue = 'foobar';

        // Default value only.
        Config::setDefault($key, $defaultValue);
        $this->assertThat(
            Config::get($key),
            $this->equalTo($defaultValue)
        );

        // Project value overrides default value.
        Config::set($key, $value);
        $this->assertThat(
            Config::get($key),
            $this->equalTo($value)
        );
    }
}
