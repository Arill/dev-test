<?php
/* ----------------- DESCRIÇÃO DO TESTE -----------------------*/

/*

Postmon é uma API para consultar CEP e encomendas de maneira fácil.

Implemente uma função que recebe CEP e retorna todos os dados relativos ao endereço correspondente.

Exemplo:

getAddressByCep('13566400') retorna:
{
	"bairro": "Vila Marina",
	"cidade": "São Carlos",
	"logradouro": "Rua Francisco Maricondi",
	"estado_info": {
	"area_km2": "248.221,996",
	"codigo_ibge": "35",
		"nome": "São Paulo"
	},
	"cep": "13566400",
	"cidade_info": {
		"area_km2": "1136,907",
		"codigo_ibge": "3548906"
	},
	"estado": "SP"
}

Documentação:
https://postmon.com.br/
*/

class CEP
{
    public static function getAddressByCep($cep)
    {
		//Acessa a API Postmon por meio do cURL
		$cURL = curl_init(); //Inicializa a sessão
		curl_setopt_array($cURL, array(
			CURLOPT_URL => "https://api.postmon.com.br/v1/cep/" . $cep, //URL de requisição + CEP
			CURLOPT_TIMEOUT => 30, //30s timeout
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_NONE,
			CURLOPT_RETURNTRANSFER => true, //Retorna o resultado em curl_exec()
			CURLOPT_SSL_VERIFYPEER => false)); //Ignorar certificado SSL
		$DadosCEP = curl_exec($cURL);
		$Erro = curl_error($cURL);
		curl_close($cURL); //Fecha a sessão

		//Os dados são recebidos em JSON de acordo com a documentação, portanto basta decodificá-los
		$DadosCEP = json_decode($DadosCEP, true);
		//Retorna os dados da forma "campo" => "atributo"
        return $DadosCEP;
    }
}

$cep = '13566400';
var_dump(CEP::getAddressByCep($cep));