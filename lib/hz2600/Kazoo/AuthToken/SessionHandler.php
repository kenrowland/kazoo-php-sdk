<?php
/**
 * Created by PhpStorm.
 * User: rowla
 * Date: 7/11/2017
 * Time: 9:09 PM
 */

namespace Kazoo\AuthToken;


abstract class SessionHandler
{

    abstract public function sessionStart();
    abstract public function put($path, $value);
    abstract public function forget($path);
    abstract public function isValueSet($path);
    abstract public function get($path);

}