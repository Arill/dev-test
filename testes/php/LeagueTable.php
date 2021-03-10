<?php
/* ----------------- DESCRIÇÃO DO TESTE -----------------------*/

/*

A classe LeagueTable acompanha o score de cada jogador em uma liga. Depois de cada jogo, o score do jogador é salvo utilizando a função recordResult.

O Rank de jogar na liga é calculado utilizando a seguinte lógica:

1- O jogador com a pontuação mais alta fica em primeiro lugar. O jogador com a pontuação mais baixa fica em último.
2- Se dois jogadores estiverem empatados, o jogador que jogou menos jogos é melhor posicionado.
3- Se dois jogadores estiverem empatados na pontuação e no número de jogos disputados, então o jogador que foi o primeiro na lista de jogadores é classificado mais alto.


Implemente a funação playerRank que retorna o jogador de uma posição escolhida do ranking.

Exemplo:

$table = new LeagueTable(array('Mike', 'Chris', 'Arnold'));
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);
echo $table->playerRank(1);


Todos os jogadores têm a mesma pontuação. No entanto, Arnold e Chris jogaram menos jogos do que Mike, e como Chris está acima de Arnold na lista de jogadores, ele está em primeiro lugar.

Portanto, o código acima deve exibir "Chris".
*/

class LeagueTable
{
	public function __construct($players)
    {
		$this->standings = array();
		foreach($players as $index => $p)
        {
			$this->standings[$p] = array
            (
                'index' => $index,
                'games_played' => 0, 
                'score' => 0
            );
        }
	}
		
	public function recordResult($player, $score)
    {
		$this->standings[$player]['games_played']++;
		$this->standings[$player]['score'] += $score;
	}
	
	public function playerRank($rank)
    {
		//Constrói a lista de ranking
		$Ranking = array();
		//Lista auxiliar
		$ListaAux = $this->standings;
		/* Este "for" constrói um ranking do Jogador #1 até o Jogador #N, de cima para baixo. A cada iteração, o jogador colocado mais acima é removido da lista auxiliar.
		Ex:	Iteração 1 - Chris, Mike, Arnold : Chris é #1, removido da lista auxiliar.
			Iteração 2 - Mike, Arnold : Mike é #2, removido.
			Iteração 3 - Arnold : Caso base, Arnold é #3. */
		for ($i = 0; $i < count($this->standings); $i++) {
			$MaxScore = NULL;
			foreach ($ListaAux as $index => $p) {
				//Caso base
				if ($MaxScore == NULL)
					$MaxScore = $index;
				else {
					//Condição 1: Score mais alto
					if ($p['score'] > $ListaAux[$MaxScore]['score'])
						$MaxScore = $index;
					else
						//Condição 2: Desempate - Quantidade de jogos menor
						if ($p['score'] == $ListaAux[$MaxScore]['score'] && $p['games_played'] < $ListaAux[$MaxScore]['games_played'])
							$MaxScore = $index;
						else
							//Condição 3: Desempate - Ordem na lista
							if ($p['score'] == $ListaAux[$MaxScore]['score'] && $p['games_played'] == $ListaAux[$MaxScore]['games_played'] && $p['index'] < $ListaAux[$MaxScore]['index'])
								$MaxScore = $index;
				}
				
			}
			unset($ListaAux[$MaxScore]);
			$Ranking[$i] = $MaxScore;
		}
		//Remove-se 1, pois a colocação não começa em 0
        return $Ranking[$rank-1];
	}
}
      
$table = new LeagueTable(array('Mike', 'Chris', 'Arnold'));
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);
echo $table->playerRank(1);
?>