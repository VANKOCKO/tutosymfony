<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Description of PropertyController
 *
 * @author 
 */
class PropertyController extends AbstractController {
    /**
     *@Route("/biens", name="propertie.index") 
    */
    public function index(): Response {
        return $this->render('property/index.html.twig');
    }
}
