<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;


/**
 * Description of PropertyController
 *
 * @author 
 */
class PropertyController extends AbstractController {
    
    private  $repository;
    private  $em;
    public function __construct(PropertyRepository $repository,EntityManagerInterface $em) {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     *@Route("/biens", name="property.index") 
    */
    public function index(PropertyRepository $repository): Response {
        
      /**
        $property = new Property();
        $property->setTitle('Mon second bien')
                 ->setPrice(200000)
                 ->setRooms(5)
                 ->setBedrooms(6)
                 ->setDescription('Une petite description')
                 ->setSurface(60)
                 ->setFloor(4)
                 ->setCity('longuyon')
                 ->setAddress('5 rue Marechall Joffre')
                 ->setPostalCode('54260')
                 ->setHeat(2)
                 ->setCreatedAt(new \DateTimeImmutable('now'));
        $em =  $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();
       * 
       */
        //$repository = $this->getDoctrine()->getRepository(Property::class);
        //$property = $this->repository->findAllVisible();
        //$sold = $property[0]->setPrice(30000);
        //$this->em->flush($sold);
        //dump($property[0]);
        return $this->render(
                'property/index.html.twig',
                [   
                     'current_menu' =>  'properties'
                ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug" : "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($id,$slug) : Response {
 
      $property = $this->repository->find($id);
      if($property->getSlug() !== $slug){
         return  $this->redirectToRoute('property.show',[
                 'id' => $property->getId(),
                 'slug' => $property->getSlug()
          ],301);
      }
      return $this->render(
            'property/show.html.twig', array(
            'property' => $property,
            'current_menu' => 'properties',
      ));
    }
}
