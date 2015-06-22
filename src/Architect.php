<?php
/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

namespace BCA\Architect;

use \BCA\Architect\Result;
use \ReflectionClass;

/**
 * Architect Robofile.
 */
abstract class Architect extends \Robo\Tasks
{
    use Traits\Setup;

    const WEIGHT_NO_RUN = -1;
    const WEIGHT_PRE = 0;
    const WEIGHT_POST = 10000000;
    const WEIGHT_FINAL = 10000001;

    /**
     * Configuration store.
     * @var Config
     */
    private $config;

    /**
     * Task weights.
     * @var array
     */
    private static $weights = [];

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Instantiate config repository.
        $this->config = new Config($this);

        // Bootstrap tasks.
        $this->bootstrap();
    }

    /**
     * Bootstrap traits.
     * @return void
     */
    private function bootstrap()
    {
        $reflector = new ReflectionClass($this);
        $boots = array_filter(
            $reflector->getMethods(),
            function ($method) {
                if (strpos($method->getName(), 'boot') === 0
                    && $method->getName() !== 'bootstrap'
                ) {
                    return true;
                }
            }
        );
        foreach ($boots as $boot) {
            call_user_func([$this, $boot->getName()]);
        }
    }

    /**
     * Default Architect run task.
     * @param array $flags Flags provided by user at runtime.
     * @return Robo\Task\BaseTask
     */
    public function run(array $flags = [])
    {
        $this->archClean();
        $this->archSetup();
        return $this->runAll($flags);
    }

    /**
     * Get tasks loaded in current scope.
     * @return array Array of callable task method names.
     */
    private function getTasks()
    {
        $tasks = array_filter(
            get_class_methods($this),
            function ($method) {
                if (strpos($method, 'task') === 0
                    && !in_array($method, get_class_methods('\Robo\Tasks'))
                ) {
                    return true;
                }
            }
        );

        return array_combine($tasks, $tasks);
    }

    /**
     * Run all tasks available in current scope.
     * @param  array $flags Flags provided by user at runtime.
     * @return Robo\Task\BaseTask
     */
    private function runAll(array $flags)
    {
        $tasks = new \ArrayIterator($this->getTasksWeighted());

        $results = [];
        while ($tasks->valid()) {
            $results[$tasks->current()] = $this->runTask($tasks->current(), $flags);
            $tasks->next();
        }

        return Result::stack($results, 'Tasks complete.');
    }

    /**
     * Run a single task.
     *
     * @param string $task  Name of task method.
     * @param array  $flags Flags to be passed to task method.
     *
     * @codeCoverageIgnore
     *
     * @return Robo/Result
     */
    private function runTask($task, array $flags)
    {
        $reflector = new \ReflectionMethod($this, $task);

        // Add a null argument for each expected parameter.
        $countParams = count($reflector->getParameters());
        $params = [];
        for ($i = 2; $i <= $countParams; $i++) {
            $params[] = null;
        }

        // Flags should always be passed last.
        $params[] = $flags;

        return call_user_func_array([$this, $task], $params);
    }

    /**
     * Get weights for all tasks.
     * @return array Method names, sorted by weight.
     */
    private function getTasksWeighted()
    {
        $weightIt = new \ArrayIterator(self::$weights);
        $weightIt->asort();

        $weights = [];
        foreach ($weightIt as $task => $weight) {
            $weights[$task] = $task;
        }

        $weightsOrdered = array_values(array_merge($weights, $this->getTasks()));

        return array_filter($weightsOrdered, function ($task) {
            if (isset(self::$weights[$task])
                && self::$weights[$task] === self::WEIGHT_NO_RUN
            ) {
                return false;
            }

            return true;
        });
    }

    /**
     * Set weight of a task.
     *
     * @param string $task   Method for which weight should be defined.
     * @param mixed  $weight Numerical index of default task order or constant.
     *
     * @return void
     */
    public static function setWeight($task, $weight)
    {
        self::$weights[$task] = $weight;
    }
}
