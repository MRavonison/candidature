<?php
/**
 * Created by PhpStorm.
 * User: miharizoravonison
 * Date: 09/02/2017
 * Time: 12:30
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="home")
     * @Method({"GET", "POST"})
     */
    public function showHome(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->add('Envoyer', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $post->setCreateAt(new \DateTime());
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('homePage.html.twig', [
            'form' => $form->createView()
        ]);
    }
}