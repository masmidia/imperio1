<?php




class Previsao
{
    function Parametros($cidade,$estado,$pais,$idioma){
        $parametros['cidade'] = $cidade;
        $parametros['estado'] = $estado;
        $parametros['pais'] = $pais;
        $parametros['idioma'] = $idioma;
        $parametros['urlapi'] = 'http://www.google.com/ig/api';		
        return $parametros;
    }
		
    function GeneratePrevTempo($parametros){		
        $url = $parametros['urlapi']."?weather='" . urlencode($parametros['cidade']) ."','" . urlencode($parametros['estado']) . "','" . urlencode($parametros['pais']) . "'&hl=" . $parametros['idioma'];
        /* A $url_alternativa é usada para que você possa acompanhar esse tutorial de forma offline */
        $url_alternativa = "previsao.xml";
		
        $resultado = file_get_contents($url_alternativa);
        $xml = simplexml_load_string(utf8_encode($resultado));
		
        $dados['info'] = $xml->xpath('/xml_api_reply/weather/forecast_information');
        $dados['atual'] = $xml->xpath('/xml_api_reply/weather/current_conditions');
        $dados['proximos'] = $xml->xpath('/xml_api_reply/weather/forecast_conditions');

        return $dados;
    }
}
?>