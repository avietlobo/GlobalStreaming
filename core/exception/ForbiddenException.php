<?php
/** User: Aviet Lobo ...*/

namespace app\core\exception;

use app\core\Application;
use app\migrations\m_0004;
use PDO;

/**
 * Class ForbiddenException
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core
 */

class ForbiddenException extends \Exception
{

    protected $message = 'You don\'t have permission to access this page';
    protected $code = '403';

}