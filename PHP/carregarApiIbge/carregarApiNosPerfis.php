<?php
function getEstados() {
    $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function getMunicipios($estadoSigla) {
    $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$estadoSigla}/municipios";
    $response = file_get_contents($url);
    return json_decode($response, true);
}
?>
