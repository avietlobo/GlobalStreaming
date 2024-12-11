<?php
/** User: Aviet Lobo ...*/

namespace app\core\exception;

use app\core\Application;
use app\migrations\m_0004;
use PDO;

/**
 * Class NotFoundException
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core
 */

class NotFoundException extends \Exception
{

    protected $message = 'Page not found,';
    protected $code = 404;

}