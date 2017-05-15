<?php
/**
 * Created by PhpStorm.
 * User: miharizoravonison
 * Date: 20/02/2017
 * Time: 16:57
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MailController extends Controller
{
    public function sendMail()
    {
        $post = new Post();
        $message = \Swift_Message::newInstance()
            ->setSubject('Accusé de réception: Portfolio RAVONISON')
            ->setFrom('ravonison.miharizo@gmail.com')
            ->setTo($post->getMail())
            ->setBody(
                $this->renderView('email/emailPage.html.twig'), 'text/html');
        $this->get('mailer')->send($message);

    }
}