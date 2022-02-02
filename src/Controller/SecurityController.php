<?php


namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Description of SecurityController
 *
 * @author User
 */
class SecurityController extends AbstractController {
    
    /**
    *@Route("/login", name="login") 
    */
    public function login(AuthenticationUtils $authenticationUtils): Response {
        $lastusername = $authenticationUtils->getLastUsername();
        //$error = $authenticationUtils->getLastAuthenticationError();
       // dump($lastusername);
        return $this->render('security/login.html.twig',[
            'last_username' => $lastusername,
            //'error' => $error
        ]);
    }
}
