<?php
/** User: Aviet Lobo ...*/

namespace app\core; 

/**
 * Class UserModel
 * 
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core
 */

 
abstract class UserModel extends DbModel
{

    public abstract function getDisplayName(): string;



}