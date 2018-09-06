<?php

class CampoMinado
{	
	/* Inicializa o campo */
	public function __construct() {

		$this->campo = [
			['*', '*', '*', '*', '@'],
			['*', '@', '*', '*', '*'],
			['*', '*', '@', '*', '*'],
			['*', '@', '*', '*', '*'],
			['*', '*', '@', '*', '*'],
		];
	}

	/* Recebe uma coordenada x, y e faz a porra toda */
	public function fazJogada($x, $y) {

		if (!$this->validaPalpite($x, $y)) {
			return false;
		}

		if ($this->verificaBomba($x, $y)) {
			echo "Você perdeu!";
			return false;
		}

		echo $this->contaBombasAoRedor($x, $y);
	}

	/* Verifica se o palpite é um valor válido */
	private function validaPalpite($x, $y) {

		if ($x<0 || $x>count($this->campo)) {
			echo "O primeiro valor digitado excede o tauleiro.";
			return false;
		}
		if ($y<0 || $y>count($this->campo[0])) {
			echo "O segundo valor digitado excede o tauleiro.";
			return false;
		}
		return true;
	}

	/* Verifica se a coordenada passada não é uma bomba */
	private function verificaBomba($x, $y) {
		return $this->campo[$x][$y] == '@';
	}

	/* Conta as bombas ao redor do palpite e retorna o valor */
	private function contaBombasAoRedorSemUsarLacos($x, $y) {
		
		$bombasProximas = 0;

		// Verificação em +
		if ($this->campo[$x-1][$y] == '@') {
			$bombasProximas += 1;
		}
		if ($this->campo[$x+1][$y] == '@') {
			$bombasProximas += 1;
		}
		if ($this->campo[$x][$y+1] == '@') {
			$bombasProximas += 1;
		}
		if ($this->campo[$x][$y-1] == '@') {
			$bombasProximas += 1;
		}

		// Verificação em X
		if ($this->campo[$x-1][$y+1] == '@') {
			$bombasProximas += 1;
		}
		if ($this->campo[$x-1][$y-1] == '@') {
			$bombasProximas += 1;
		}
		if ($this->campo[$x+1][$y+1] == '@') {
			$bombasProximas += 1;
		}
		if ($this->campo[$x+1][$y-1] == '@') {
			$bombasProximas += 1;
		}

		return $bombasProximas;
	}

	private function contaBombasAoRedor($x, $y) {

		$bombasProximas = 0;
		
		for ($linha=$x-1; $linha < $x+2; $linha++) { 
			for ($coluna=$y-1; $coluna < $y+2; $coluna++) { 
				if ($this->campo[$linha][$coluna] == '@') {
					$bombasProximas += 1;
				}
			}
		}

		return $bombasProximas;
	}

}

// Instanciar o jogo
$jogo = new CampoMinado();
$jogo->fazJogada(1, 2);
echo "<br>";
$jogo->fazJogada(-1, 4);
echo "<br>";
$jogo->fazJogada(2, 2);
echo "<br>";
$jogo->fazJogada(1, 1);
echo "<br>";
$jogo->fazJogada(3, 0);
echo "<br>";
$jogo->fazJogada(2, 1);
echo "<br>";
$jogo->fazJogada(2, 4);
echo "<br>";
$jogo->fazJogada(0, 0);
echo "<br>";