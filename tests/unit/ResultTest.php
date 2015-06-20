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
 * Test \BCA\Architect\Result.
 */
class ResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test Result implements \Robo\Result.
     * @return void
     */
    public function testClassImplementsRoboResult()
    {
        $this->assertInstanceOf(
            '\Robo\Result',
            new \BCA\Architect\Result(new \Robo\Task\Base\Exec('ls'), 'msg')
        );
    }

    /**
     * Test Result::stack() returns an instance of \Robo\Result.
     * @return void
     */
    public function testResultStackReturnsRoboResult()
    {
        $task = new \Robo\Task\Base\Exec('ls');

        $this->assertInstanceOf(
            '\Robo\Result',
            \BCA\Architect\Result::stack([
                $task->run()
            ])
        );
    }

    /**
     * Test Result::stack() returns an error when passed a single errored result.
     * @return void
     */
    public function testStackSingleErrorResultReturnsError()
    {
        $task = new \Robo\Task\Base\Exec('notexecutable');

        $result = \BCA\Architect\Result::stack([
            $task->run()
        ]);

        $this->assertThat($result->wasSuccessful(), $this->isFalse());
    }

    /**
     * Test Result::stack() returns success when passed a single success result.
     * @return void
     */
    public function testStackSingleSuccessResultReturnsSuccess()
    {
        $task = new \Robo\Task\Base\Exec('ls');

        $result = \BCA\Architect\Result::stack([
            $task->run()
        ]);

        $this->assertThat($result->wasSuccessful(), $this->isTrue());
    }

    /**
     * Test Result::stack() returns an error when passed a mixed result.
     * @return void
     */
    public function testStackMixedResultReturnsError()
    {
        $taskOne = new \Robo\Task\Base\Exec('ls');
        $taskTwo = new \Robo\Task\Base\Exec('notexecutable');

        $result = \BCA\Architect\Result::stack([
            $taskOne->run(),
            $taskTwo->run()
        ]);

        $this->assertThat($result->wasSuccessful(), $this->isFalse());
    }

    /**
     * Test Result::stack() throws an exception when passed an instance of
     * something other than \Robo\Result.
     * @expectedException        Exception
     * @return  void
     */
    public function testStackThrowsExceptionIfNotResult()
    {
        $result = \BCA\Architect\Result::stack([
            new \StdClass()
        ]);
    }
}
