<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use InvalidArgumentException;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 */
class Categoria
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=128, unique=true)
     * @Assert\Length(min=5, minMessage="O nome deve conter pelo menos 5 caracteres")
     */
    private $nome;

    public function __construct()
    {
        $this->nome = '';
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Categoria
     */
    public function setNome(string $nome): self
    {
        if ($nome < 5)
            throw new InvalidArgumentException('O nome deve conter pelo menos 5 caracteres');

        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }
}
