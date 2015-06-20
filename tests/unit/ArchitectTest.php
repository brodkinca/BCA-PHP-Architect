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

/**
 * Test \BCA\Architect\Architect.
 */
class ArchitectTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Instance on which tests are run.
     * @var \RoboFile
     */
    private $class;

    /**
     * Setup tests.
     * @return  void
     */
    public function setUp()
    {
        \AspectMock\Test::clean();

        $this->class = new \RoboFile();
    }

    /**
     * Get traits from Architect directory tree.
     * @return array Array of instantiable traits as strings.
     */
    private function getArchTraits()
    {
        $traits = glob(__DIR__.'/../../src/Traits/*.php');
        array_walk($traits, function (&$file) {
            $file = basename($file);
            $file = substr($file, 0, strpos($file, '.php'));
            $file = 'BCA\Architect\Traits\\'.$file;
        });
        asort($traits);

        return $traits;
    }

    /**
     * Test Architect::run().
     * @return void
     */
    public function testRun()
    {
        $taskInterface = new \Robo\Task\Base\Exec('ls');
        $successResult = \Robo\Result::success($taskInterface);

        $mock = \AspectMock\Test::double(
            $this->class,
            [
                'archClean' => function () use ($successResult) {
                    return $successResult;
                },
                'archSetup' => function () use ($successResult) {
                    return $successResult;
                },
                'runTask' => function () use ($successResult) {
                    return $successResult;
                }
            ]
        );

        // Run in default mode.
        $this->class->run();

        // Run in CI mode.
        putenv('CI=true');
        $this->class->run();

        $mock->verifyInvoked('runAll');
        $mock->verifyInvoked('runTask');
        $mock->verifyInvoked('getTasks');
    }

    /**
     * Test Architect::setWeight().
     * @return void
     */
    public function testSetWeight()
    {
        $reflector = new \ReflectionClass($this->class);

        $propertyReflector = $reflector->getParentClass()->getProperty('weights');
        $propertyReflector->setAccessible(true);
        $propertyReflector->setValue($this->class, []);

        $this->assertThat(
            $propertyReflector->getValue($this->class),
            $this->isEmpty()
        );

        // Set initial values.
        $this->class->setWeight('methodNameOne', 10);
        $this->class->setWeight('methodNameTwo', 20);
        $this->class->setWeight('methodNameThree', 30);

        $this->assertThat(
            count($propertyReflector->getValue($this->class)),
            $this->equalTo(3)
        );
        $this->assertThat(
            $propertyReflector->getValue($this->class)['methodNameOne'],
            $this->equalTo(10)
        );

        // Update initial value and add a fourth.
        $this->class->setWeight('methodNameOne', 0);
        $this->class->setWeight('methodNameFour', 40);

        $this->assertThat(
            count($propertyReflector->getValue($this->class)),
            $this->equalTo(4)
        );
        $this->assertThat(
            $propertyReflector->getValue($this->class)['methodNameOne'],
            $this->equalTo(0)
        );
    }

    /**
     * Test Architect::getTasksWeighted().
     * @return void
     */
    public function testGetTasksWeighted()
    {
        $reflector = new \ReflectionClass($this->class);

        $methodReflector = $reflector->getMethod('getTasksWeighted');
        $methodReflector->setAccessible(true);

        $propertyReflector = $reflector->getParentClass()->getProperty('weights');
        $propertyReflector->setAccessible(true);
        $propertyReflector->setValue($this->class, []);

        $mock = \AspectMock\Test::double(
            $this->class,
            [   'getTasks' => [
                    'methodNameThree' => 'methodNameThree',
                    'methodNameOne' => 'methodNameOne',
                    'methodNameFour' => 'methodNameFour',
                    'methodNameTwo' => 'methodNameTwo'
                ]
            ]
        );

        // Set initial values.
        $this->class->setWeight('methodNameOne', 500);
        $this->class->setWeight('methodNameTwo', 200);
        $this->class->setWeight('methodNameThree', 100);

        $weights = $methodReflector->invoke($this->class);

        $this->assertThat(
            is_array($weights),
            $this->isTrue()
        );
        $this->assertThat(
            count($propertyReflector->getValue($this->class)),
            $this->equalTo(3)
        );
        $this->assertThat(
            count($weights),
            $this->equalTo(4)
        );
        $this->assertThat(
            array_shift($weights),
            $this->equalTo('methodNameThree')
        );
        $this->assertThat(
            array_shift($weights),
            $this->equalTo('methodNameTwo')
        );
        $this->assertThat(
            array_shift($weights),
            $this->equalTo('methodNameOne')
        );
        $this->assertThat(
            array_shift($weights),
            $this->equalTo('methodNameFour')
        );
    }
}
