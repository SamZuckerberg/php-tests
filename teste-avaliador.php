<?php

require 'vendor/autoload.php';

$leilao = new \Alura\Leilao\Model\Leilao('fiat');

$maria = new \Alura\Leilao\Model\Usuario('Maria');
$joao = new \Alura\Leilao\Model\Usuario('joao');

$leilao->recebeLance(new \Alura\Leilao\Model\Lance($joao, 2000));
$leilao->recebeLance(new \Alura\Leilao\Model\Lance($maria, 2500));

$leiloeiro = new \Alura\Leilao\Service\Avaliador();

$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();
$valorEsperado = 2500;

echo $maiorValor == $valorEsperado ? 'TESTE PASSSOU' : 'TESTE REPROVADO';