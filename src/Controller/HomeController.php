<?php


namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * Description of HomeController
 *
 * @author User
 */
class HomeController extends AbstractController {
    /**
     *@Route("/", name="home") 
    */
    public function index(): Response {
        return $this->render('pages/home.html.twig');
    }
}