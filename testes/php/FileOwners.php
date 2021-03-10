<?php
/* ----------------- DESCRIÇÃO DO TESTE -----------------------*/

/*
Implemente uma função que ao receber um array associativo contendo arquivos e donos, retorne os arquivos agrupados por dono. 

Por exempolo, um array ["Input.txt" => "Jose", "Code.py" => "Joao", "Output.txt" => "Jose"] a função groupByOwners deveria retornar ["Jose" => ["Input.txt", "Output.txt"], "Joao" => ["Code.py"]].
*/

class FileOwners
{
    public static function groupByOwners($files)
    {
		//$files_aux = explode("=>", $files);
		//Para Donos não sendo case-sensitive
		$Donos = array_values(array_intersect_key($files, array_unique(array_map("strtolower", $files))));
		//Donos são case-sensitive? Se sim, ao invés disso, usar:
		//$Donos = array_values($files);
		//Lista de arquivos, com índice numérico
		$Arquivos = array_keys($files);
		//Lista resultante
		$Lista = array();for ($i = 0; $i < count($Donos); $i++) {
			//Lista auxiliar, para as sublistas de cada dono
			$Arq = array();
			for ($j = 0; $j < count($files); $j++) {
				//Se o dono do arquivo é igual ao dono avaliado, adiciona o arquivo à sublista.
				if ($files[$Arquivos[$j]] == $Donos[$i])
					array_push($Arq, $Arquivos[$j]);
			}
			//Adiciona o par Dono => Sublista(Arquivos) à lista resultante
			$Lista[$Donos[$i]] = $Arq;
		}
        return $Lista;
    }
}

$files = array
(
    "Input.txt" => "Jose",
    "Code.py" => "Joao",
    "Output.txt" => "Jose",
    "Click.js" => "Maria",
    "Out.php" => "maria",
);
var_dump(FileOwners::groupByOwners($files));
?>