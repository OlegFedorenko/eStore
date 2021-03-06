<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 15.10.18
 * Time: 21:04
 */

namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $senderEmail;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, ParameterBagInterface $parameterBag)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->senderEmail = $parameterBag->get('sender_email');
    }

    public function send($to, $templateName, array $params = [])
    {
        $params = $this->twig->mergeGlobals($params);
        $template = $this->twig->load($templateName);
        $subject = $template->renderBlock('subject', $params);
        $body = $template->renderBlock('body', $params);

        $message = new \Swift_Message();
        $message->addFrom($this->senderEmail);
        $message->addTo($to);
        $message->setSubject($subject);
        $message->setBody($body, 'text/html');

        $this->mailer->send($message);
    }

}