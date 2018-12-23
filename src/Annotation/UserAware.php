<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 23/12/2018
 * Time: 21:29
 */

namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation\Target("CLASS")
 * Class UserAware
 * @package App\Annotation
 */
class UserAware
{
    public $userFieldName;
}