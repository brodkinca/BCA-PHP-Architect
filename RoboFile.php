<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \BCA\Architect\Architect
{
    use \BCA\Architect\Traits\Apigen;
    use \BCA\Architect\Traits\Codeception;
    use \BCA\Architect\Traits\Pdepend;
    use \BCA\Architect\Traits\Phpcb;
    use \BCA\Architect\Traits\Phpcs;
    use \BCA\Architect\Traits\Phpcpd;
    use \BCA\Architect\Traits\Phplint;
    use \BCA\Architect\Traits\Phpmd;
    use \BCA\Architect\Traits\Phploc;
}