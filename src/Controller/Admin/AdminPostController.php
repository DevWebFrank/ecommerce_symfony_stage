<?php

namespace App\Controller\Admin;

use App\Dictionary\PostStatus;
use DateTime;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPostController extends AbstractController
{
    #[Route("/admin/post/list", name: "admin_post_list")]
    public function list(PostRepository $postRepository)
    {
        // on va chercher dans la base de donnée
        $posts = $postRepository->findAll();

        // on envoi dans la vue
        return $this->render("admin/post/list.html.twig", [
            'posts' => $posts
        ]);
    }

    #[Route("/admin/post/new", name: "admin_post_new")]
    public function create(EntityManagerInterface $em, Request $request)
    {
        //Je crée une instance de la classe Post
        $post = new Post();

        //$this->date = new \DateTime();

        // on va chercher dans la base de donnée
        $toto = $this->createForm(PostType::class, $post);

        $toto->handleRequest($request);

        if ($toto->isSubmitted() && $toto->isValid()) {
            $em->persist($post);
            $em->flush();

            $this->addFlash("success", "Le post à bien été crée.");
            return $this->redirectToRoute("admin_post_list");
        }

        // on envoi dans la vue
        return $this->render("admin/post/new.html.twig", [
            'toto' => $toto->createView()
        ]);
    }

    #[Route("/admin/post/show/{id}", name: "admin_post_show")]
    public function show(int $id, PostRepository $postRepository)
    {
        $post = $postRepository->find($id);

        if (!$post) {
            $this->addflash("danger", "Le post est introuvable.");
            return $this->redirectToRoute("admin_post_list");
        }

        return $this->render("admin/post/show.html.twig", [
            'post' => $post
        ]);
    }

    #[Route("/admin/post/togglestatus/{id}", name: "admin_post_toggle_status")]
    public function toggleRole(int $id, PostRepository $postRepository, EntityManagerInterface $em)
    {
        //Je vais chercher en BDD le post correspondant à l'id envoyé
        $post = $postRepository->find($id);

        // Si il n'hésiste pas, je renvoi un message d'erreur
        if (!$post) {
            $this->addFlash("danger", "Post introuvable.");
            return $this->redirectToRoute("admin_post_list");
        }
        //JE vais chercher le role actuel du user
        $status = $post->getStatus();

        //Si son status actuel est brouillon, je lui attribue le status publié
        if ($status === PostStatus::STATUS_BROUILLON) {
            $post->setStatus(PostStatus::STATUS_PUBLISHED);
        }
        //Si son status actuel est publié, je lui attribue le status brouillon
        else {
            $post->setStatus(PostStatus::STATUS_BROUILLON);
        }

        //Grace à l'entity Manager, j'envoie cette modification en BDD
        $em->flush();

        //Ensuite j'envoie le msg flash
        $this->addFlash("success", "Le status du post a bien été modifié.");

        //Je redirige vers la liste des users
        return $this->redirectToRoute("admin_post_show", ['id' => $id]);
    }
}
