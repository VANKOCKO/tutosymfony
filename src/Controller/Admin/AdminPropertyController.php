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
use Symfony\Component\HttpFoundation\Session\Session;
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
     *@Route("/admin/property/create", name="admin.property.new") 
    */
   public function new(Request $request) {
       $property = new Property();
       $form = $this->createForm(PropertyType::class,$property);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           $date = new \DateTimeImmutable('now');
           $property->setCreatedAt($date);
           $this->em->persist($property);
           $this->em->flush();
           return $this->redirectToRoute('admin.property.index');
       }
       $properties = $this->repository->findAll();
       return $this->render('admin/property/new.html.twig',[
              'properties' => $properties,
              'form' =>$form->createView()
       ]);
   }
   /**
    *@Route("/admin/property/{id}", name="admin.property.edit",methods="POST") 
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
   /**
    * @Route("/admin/property/delete/{id}", name="admin.property.delete", methods="POST")
    * @return Response
   */
   public function delete($id,Request $request) {
       $property = $this->repository->find($id);
       $this->em->remove($property);
       $this->em->flush();
       return $this->redirectToRoute('admin.property.index');
   }
   
}
