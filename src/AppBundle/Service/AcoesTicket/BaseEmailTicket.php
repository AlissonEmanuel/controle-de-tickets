<?php
namespace AppBundle\Service\AcoesTicket;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

abstract class BaseEmailTicket
{
    /** @var  \Swift_Mailer */
    protected $mailer;
    /** @var Router $router */
    protected $router;

    public function __construct(\Swift_Mailer $mailer, Router $router)
    {
        $this->mailer = $mailer;
        $this->router = $router;
    }
}
