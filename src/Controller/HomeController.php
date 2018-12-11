<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 11/12/2018
 * Time: 00:22
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController
{
    /**
     * @Route(path="/", name="home", methods={"GET"})
     * @return Response
     */
    public function home()
    {
        return new RedirectResponse('/api');
    }
}