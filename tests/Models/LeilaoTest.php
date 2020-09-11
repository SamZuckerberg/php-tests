<?php


namespace Alura\Leilao\Tests\Model;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function testNaoGuardaDoisLancesSeguidosPelaMesmaPessoa()
    {
        $user = new Usuario('Samir');

        $leilao = new Leilao('XBOX ONE');
        $leilao->recebeLance(new Lance($user, 1000));
        $leilao->recebeLance(new Lance($user, 4000));

        $this->assertCount(1, $leilao->getLances());
    }


    /**
     * @dataProvider geraLances
     *
     * @param int $quantidadeLances
     * @param Leilao $leilao
     * @param array $valores
     */
    public function testLeilaoDeveReceberLances(int $quantidadeLances, Leilao $leilao, array $valores)
    {
        $this->assertCount($quantidadeLances, $leilao->getLances());
        foreach(range(0, $quantidadeLances - 1) as $item){
            $this->assertEquals($valores[$item], $leilao->getLances()[$item]->getValor());
        }
    }

    public function geraLances()
    {
        $user1 = new Usuario('João');
        $user2 = new Usuario('Maria');

        $leilao = new Leilao('Fiat 147 OKM');
        $leilao->recebeLance(new Lance($user1, 1000));
        $leilao->recebeLance(new Lance($user2, 2000));

        $leilao1 = new Leilao('ps4');
        $leilao1->recebeLance(new Lance($user1, 1000));

        return [
            '2-lances' => [2, $leilao, [1000, 2000]],
            '1-lance' => [1, $leilao1, [1000]]
        ];
    }
}