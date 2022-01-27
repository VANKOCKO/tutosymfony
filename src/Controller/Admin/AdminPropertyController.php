<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Description of AdminPropertyController
 *
 * @author van
 */
class AdminPropertyController extends AbstractController {
    
    private  $repository;
    private  $em;
    public function __construct(PropertyRepository $repository,EntityManagerInterface $em) {
        $this->repository = $repository;
        $this->em = $em;
    } 
   /**
     *@Route("/admin", name="admin.property.index") 
    */
   public function index() {
       $properties = $this->repository->findAll();
       return $this->render('admin/property/index.html.twig',[
              'properties' => $properties
       ]);
   } 
   /**
    *@Route("/admin/{id}", name="admin.property.edit") 
    */
   public function edit($id,Request $request) {
       $property = $this->repository->find($id);
       $form = $this->createForm(PropertyType::class,$property);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           $this->em->flush();
           return $this->redirectToRoute('admin.property.index');
       }
       return $this->render('admin/property/edit.html.twig', [
              'property'=>$property,
              'form' =>$form->createView()
       ]);  
   } 
}
