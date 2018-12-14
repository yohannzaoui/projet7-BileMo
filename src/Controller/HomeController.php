<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 14/12/2018
 * Time: 17:35
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController
{
    /**
     * @Route(path="/", name="home_api", methods={"GET"})
     * @return RedirectResponse
     */
    public function HomeApi()
    {
        return new RedirectResponse("/api", RedirectResponse::HTTP_FOUND);
    }
}