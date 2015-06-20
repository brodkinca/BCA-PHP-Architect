<?php
// @codingStandardsIgnoreFile

/**
 * Brodkin CyberArts Website
 *
 * @package    robo
 * @subpackage bca/architect
 * @author     Brodkin CyberArts <info@brodkinca.com>
 * @copyright  2015 Brodkin CyberArts
 */

/**
 * Test RoboFile.
 */
class RoboFile extends \BCA\Architect\Architect
{
    use \BCA\Architect\Traits\Pdepend;
    use \BCA\Architect\Traits\Phpcb;
    use \BCA\Architect\Traits\Phpcs;
    use \BCA\Architect\Traits\Phpcpd;
    use \BCA\Architect\Traits\Phplint;
    use \BCA\Architect\Traits\Phploc;
    use \BCA\Architect\Traits\Phpmd;
}
