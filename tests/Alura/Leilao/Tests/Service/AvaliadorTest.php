<?php


namespace Alura\Leilao\Tests\Service;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMaiorValor(Leilao $leilao)
    {
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        $this->assertEquals(9999999, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMenorValor(Leilao $leilao)
    {
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        $menorValor = $leiloeiro->getMenorValor();

        $this->assertEquals(200, $menorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveBuscar3MaioresValores(Leilao $leilao)
    {
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maioresLances = $leiloeiro->getMaioresLances();
        $this->assertCount(3, $maioresLances);
        $this->assertEquals(9999999, $maioresLances[0]->getValor());
        $this->assertEquals(1400, $maioresLances[1]->getValor());
        $this->assertEquals(1300, $maioresLances[2]->getValor());
    }

    public function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('Ps4');
        $user1 = new Usuario('Pedro');
        $user2 = new Usuario('Ana');
        $user3 = new Usuario('Elsa');
        $user4 = new Usuario('Max steel');

        $leilao->recebeLance(new Lance($user2, 200));
        $leilao->recebeLance(new Lance($user3, 1300));
        $leilao->recebeLance(new Lance($user1, 1400));
        $leilao->recebeLance(new Lance($user4, 9999999));

        return [[$leilao]];
    }

    public function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('Ps4');
        $user1 = new Usuario('Pedro');
        $user2 = new Usuario('Ana');
        $user3 = new Usuario('Elsa');
        $user4 = new Usuario('Max steel');

        $leilao->recebeLance(new Lance($user4, 9999999));
        $leilao->recebeLance(new Lance($user1, 1400));
        $leilao->recebeLance(new Lance($user3, 1300));
        $leilao->recebeLance(new Lance($user2, 200));

        return [[$leilao]];
    }

    public function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Ps4');
        $user1 = new Usuario('Pedro');
        $user2 = new Usuario('Ana');
        $user3 = new Usuario('Elsa');
        $user4 = new Usuario('Max steel');

        $leilao->recebeLance(new Lance($user3, 1300));
        $leilao->recebeLance(new Lance($user2, 200));
        $leilao->recebeLance(new Lance($user4, 9999999));
        $leilao->recebeLance(new Lance($user1, 1400));

        return [[$leilao]];
    }
}