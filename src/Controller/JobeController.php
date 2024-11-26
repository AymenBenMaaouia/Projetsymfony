<?php
namespace App\Controller;

use App\Entity\Jobe;
use App\Form\JobeType;
use App\Repository\JobeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobeController extends AbstractController{
    #[Route('/jobe', name: 'app_jobe')]
    public function index(): Response
    {
        return $this->render('jobe/index.html.twig', [
            'controller_name' => 'jobeController',
        ]);
    }
        
     #[Route('/show/{name}')]
     function showJobe($name){
        return $this->render('jobe/show.html.twig',
        ['n'=>$name]);
    }
    #[Route('/List',name:"ll")]
    function listJobe(){
        return $this->render('jobe/list.html.twig',
        ['aa'=>$this->jobes]);
    }
    #[Route('/detail/{ii}',name:"Det")]
    function detail($ii){
        foreach($this->jobes as $aa){
            if($aa['id']==$ii){
                $jobe=$aa;
            }
        }
        return $this->render('jobe/detail.html.twig',
    ['i'=>$ii,'a'=>$jobe]);
    }
    #[Route('/Info',name:"Information")]
    function Informations(){
        return $this->render('information.html.twig');
    }
    #[Route('/Affiche',name:"Aff")]
    function Affiche(JobeRepository $repo){
        return $this->render('jobe/Affiche.html.twig',
     ['a'=>$repo->findAll()]);
    }
    #[Route('/DetailA/{ii}',name:"Detail")]
    function DetailA($ii,JobeRepository $repo){
        $jobe=$repo->find($ii);
        return $this->render('jobe/DetailA.html.twig',
     ['a'=>$jobe]);
    }
    #[Route('/Del/{ii}',name:"Delete")]
    function Delete($ii,jobeRepository $repo,ManagerRegistry $manager){
        $jobe=$repo->find($ii);
        $em=$manager->getManager();
        $em->remove($jobe);
        $em->flush();
        return $this->redirectToRoute('Aff');
    }
    #[Route('/Ajout',name:'Add')]
    function Ajout(Request $request,ManagerRegistry $manager){
        $jobe=new jobe();
        $form=$this->createForm(JobeType::class,$jobe);
        $form->add('Ajout',SubmitType::class);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em=$manager->getManager();
            $em->persist($jobe);
            $em->flush();
            return $this->redirectToRoute('Aff');
        }
        return $this->render('jobe/Ajout.html.twig',['ff'=>$form]);
    }
    #[Route('/Up/{id}',name:'Update')]
    function Update($id,Request $request,ManagerRegistry $manager,JobeRepository $repo){
        $jobe=$repo->find($id);
        $form=$this->createForm(jobeType::class,$jobe);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em=$manager->getManager();
            
            $em->flush();
            return $this->redirectToRoute('Aff');
        }
        return $this->render('jobe/Ajout.html.twig',['ff'=>$form]);
    }






 }
