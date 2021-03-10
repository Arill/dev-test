// Escreva uma função que converta a data de entrada do usuário formatada como MM/DD/YYYY em um formato exigido por uma API (YYYYMMDD). O parâmetro "userDate" e o valor de retorno são strings.

// Por exemplo, ele deve converter a data de entrada do usuário "31/12/2014" em "20141231" adequada para a API.

function formatDate(userDate) {
  //Formata data de M/D/YYYY para YYYYMMDD
  var DataSeparada = userDate.split('/');
  //Retorna data normalizada (adiciona 0 se for fornecido apenas 1 dígito na string)
  return DataSeparada[2] + ((DataSeparada[0].length == 1) ? "0" : "") + DataSeparada[0] + ((DataSeparada[1].length == 1) ? "0" : "") +  DataSeparada[1];  
}

console.log(formatDate("12/31/2014"));