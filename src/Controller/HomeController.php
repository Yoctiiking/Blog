<?php

namespace App\Controller;

use App\Entity\BlogItem;
use App\Entity\UserInfo;
use App\Form\CreateItemType;
use App\Form\EditInfoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $items = $this->entityManager->getRepository(BlogItem::class)->findBlogs();
        //$info = $this->entityManager->getRepository(UserInfo::class)->find();

        return $this->render('home/index.html.twig', [
            'items' => $items,
            //'info' => $info,
        ]);
    }

    #[Route('/yoctiibloguer', name: 'createItem')]
    public function createItem(Request $request): Response
    {
        $item = new BlogItem;
        $form = $this->createForm(CreateItemType::class, $item);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $item->setName($form->get('name')->getData());
            $item->setDescription($form->get('description')->getData());
            //dd($item);
            $this->entityManager->persist($item);
            $this->entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/createItem.html.twig', [
            'form' => $form->createView(),
            'item' => $item,
        ]);
    }

    /*#[Route('/edit-informations', name: 'editInfo')]
    public function editInfo(Request $request, $id): Response
    {
        $info = $this->entityManager->getRepository(UserInfo::class)->find($id);
        
        if($info){
            $form = $this->createForm(EditInfoType::class, $info);
            
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $info = $form->getData();
                //dd($info);
                $this->entityManager->persist($info);
                $this->entityManager->flush();

                return $this->redirectToRoute('home');
            }
        } else {
            $info = new UserInfo;
            $form = $this->createForm(EditInfoType::class, $info);
            
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $info = $form->getData();
                //dd($info);
                $this->entityManager->persist($info);
                $this->entityManager->flush();

                return $this->redirectToRoute('home');
            }
        }
        

        return $this->render('home/editInfo.html.twig', [
            'form' => $form->createView(),
            'info' => $info,
        ]);
    }*/

    #[Route('/delete/{id}', name: 'deleteItem')]
    public function delete($id): Response
    {
        $item = $this->entityManager->getRepository(BlogItem::class)->find($id);

        if($item){
            $this->entityManager->remove($item);
            $this->entityManager->flush();
            return $this->redirectToRoute('home');
        } else {
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'item' => $item,
        ]);
    }
}
