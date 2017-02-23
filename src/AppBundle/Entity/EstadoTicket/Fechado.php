<?php
namespace AppBundle\Entity\EstadoTicket;

use AppBundle\Entity\Ticket;

class Fechado implements EstadoTicket
{
    public function getCor(): string
    {
        return 'gray';
    }

    public function __toString(): string
    {
        return 'Fechado';
    }

    public function ehAberto(): bool
    {
        return false;
    }

    public function fechar(Ticket $ticket): void
    {
        throw new \BadMethodCallException("Ticket #{$ticket->getId()} já fechado");
    }

    public function getDbValue(): int
    {
        return 4;
    }
}
