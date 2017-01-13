<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use tests\AppBundle\Controller\LoginControllerTest;

class UsuariosControllerTest extends WebTestCase
{
    private static $cliente;

    public static function setUpBeforeClass()
    {
        static::$cliente = static::createClient();
        $loginTest = new LoginControllerTest();
        $loginTest->login(static::$cliente);
    }

    public function testListaUsuarios()
    {
        $crawler = static::$cliente->request('GET', '/usuarios');

        $this->assertGreaterThan(
            0,
            $crawler->filter('div#tabela-usuarios table tbody tr')->count()
        );
    }

    public function testEmailInvalido()
    {
        $crawler = static::$cliente->request('GET', '/usuarios/novo');

        $form = $crawler->selectButton('criar_usuario[salvar]')->form();
        $form['criar_usuario[nome]']  = 'Nome usuário';
        $form['criar_usuario[email]'] = 'email inválido';
        $form['criar_usuario[senha]'] = 'Senha usuário';
        $form['criar_usuario[tipo]']  = 'ROLE_USER';

        $crawler = static::$cliente->submit($form);
        $this->assertEquals(
            1,
            $crawler->filter('div.callout-danger:contains("E-mail inválido")')
                ->count()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTipoInvalido()
    {
        $crawler = static::$cliente->request('GET', '/usuarios/novo');

        $form = $crawler->selectButton('criar_usuario[salvar]')->form();
        $form['criar_usuario[nome]']  = 'Nome usuário';
        $form['criar_usuario[email]'] = 'email@valido.com';
        $form['criar_usuario[senha]'] = 'Senha usuário';
        $form['criar_usuario[tipo]']  = 'tipo inválido';

        // Deve lançar uma exceção, pois o tipo é inválido
        static::$cliente->submit($form);
    }
}
