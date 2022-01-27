<?php


namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Description of HomeController
 *
 * @author User
 */
class HomeController extends AbstractController {
    
    private  $repository;
    private  $em;
    public function __construct(PropertyRepository $repository,EntityManagerInterface $em) {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     *@Route("/", name="home") 
    */
    public function index(): Response {
        $properties = $this->repository->findLatest();
        return $this->render('pages/home.html.twig',[
               'properties' => $properties
        ]);
    }
}
