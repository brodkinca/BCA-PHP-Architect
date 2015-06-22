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

use \Robo\Result as RoboResult;

/**
 * Return a result.
 */
class Result extends RoboResult
{
    /**
     * Return a result based on an array of other result instances.
     *
     * @param array  $results Array of result instances.
     * @param string $message Message to be returned.
     * @param array  $data    Data to be returned.
     *
     * @throws \Exception Throws exception if array item is not Result instance.
     *
     * @return Result          Summary Result instance.
     */
    public static function stack(array $results, $message = '', array $data = [])
    {
        $results = new \ArrayIterator($results);
        $taskInterface = new \Robo\Task\Base\Exec('ls');

        while ($results->valid()) {
            $thisResult = $results->current();

            if (!$thisResult instanceof \Robo\Result) {
                throw new \Exception(
                    'All tasks must return an instance of Robo\Result. '.
                    $results->key().' returned '.get_class($thisResult).'.'
                );
            }

            if (!$thisResult->wasSuccessful()) {
                return self::error($taskInterface, $message, $data);
            }

            $results->next();
        }

        return self::success($taskInterface, $message, $data);
    }
}
