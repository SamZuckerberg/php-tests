<?php


namespace Alura\Leilao\Service;


use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private float $maiorValor = -PHP_INT_MAX;
    private float $menorValor = PHP_INT_MAX;
    private array $maioresLances;

    public function __construct()
    {
        $this->maioresLances = [];
    }

    public function avalia(Leilao $leilao): void
    {
        $lances = $leilao->getLances();
        foreach($lances as $lance){
            if($lance->getValor() > $this->maiorValor){
                $this->maiorValor = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorValor){
                $this->menorValor = $lance->getValor();
            }
        }

        usort($lances, fn(Lance $lance1, Lance $lance2) => $lance1->getValor() < $lance2->getValor() ? 1 : -1);
        $this->maioresLances = array_slice($lances, 0, 3);
    }

    public function getMaiorValor() :float
    {
        return $this->maiorValor;
    }

    public function getMenorValor() :float
    {
        return $this->menorValor;
    }

    public function getMaioresLances() : array
    {
        return $this->maioresLances;
    }

}