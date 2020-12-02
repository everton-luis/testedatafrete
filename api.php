<?php

class ServiceAPI {

    private $key = 'Token token=d586ec7f3cb2908414616bc377f5c7c4';

   

    // Function responsible for making requests in the API and returning the information in json.
    function request($uri, $type_request) {
        if (!empty($uri)){
            try {
                $request = curl_init();
                curl_setopt ($request, CURLOPT_HTTPHEADER, array('Authorization: ' . $this->key)); // Access token for request.
                curl_setopt ($request, CURLOPT_URL, $uri); // Request URL.
                curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, 5); // Connect time out.
                curl_setopt ($request, CURLOPT_CUSTOMREQUEST, $type_request); // HTPP Request Type.
                $file_contents = curl_exec($request);
                

                curl_close($request);

        
        
                return $file_contents;

            } catch (Exception $e){
                return $e->getMessage();
            }
        }
    }

    // Preparation of parameters and URL for searching zip codes.
    function getCep($cep){
        $type_request = "GET";
        $params = 'cep='.$cep;
        $uri = "https://www.cepaberto.com/api/v3/cep?". $params;

        
        if (!empty($params)){
            return $this->request($uri, $type_request);
            $json_str = $this->request($uri, $type_request);
            $obj = $json_decode($json_str);
            echo $obj->cep;
            
        }
    }

    

    // Preparation of parameters and URL for search of Addresses.
    function getAddress(){
        $link = null;
        $type_request = "GET";
        $params = array(
            "estado" => "RS",
            "cidade" => "Flores da Cunha",
        );

        if (is_array($params)){
            foreach ($params as $type_key => $value){
                if (empty($value)) continue;
                $link .= $type_key . '=' . urlencode($value) . '&';
            }

            $params = substr($link, 0, -1);

            if (!empty($params)){
                $uri = "https://www.cepaberto.com/api/v3/address?". $params;
                return $this->request($uri, $type_request);
                
            }
        }
    }

    // Preparation of parameters and URL for listing cities in a state.
    function getCities(){
        $type_request = "GET";
        $params = 'RS';
        $uri = "https://www.cepaberto.com/api/v3/cities?estado=". $params;
    
        if (!empty($params)){
            return $this->request($uri, $type_request);
            
        }
    }
}

    /*===============================TEST================================*/
    //$api = new ServiceAPI();
    //echo "<p style='color: #062cfb'>getCep </p>" . $api->getCep();
    //$lista = $api->getCep();
    //echo $lista;

    //echo '<br/>';
    //echo "teste";
    //echo '<br/>';

    // Para rodar o obj não deve escrever o echo $lista, apenas instanciar

    //por exemplo
    // $lista = $api->getCep();
    //$obj = json_decode($lista);

        //echo $obj->cep;
        //echo '<br/>';
        //echo $obj->latitude;
        //echo '<br/>';
        //echo $obj->altitude;
    //

    //ou
    //$lista = $api->getCep();
    //echo $lista;

    // ----------------------------------------------

    //$obj = json_decode($lista);

    //echo $obj->cep;
    //echo '<br/>';
    //echo $obj->latitude;
    //echo '<br/>';
    //echo $obj->altitude;
    

    

    



    //foreach($dadosJson as $lista){
        //echo $lista->latitude;
    //}


    //echo '<br/>';
    

    //echo $api->getCep();
    //sleep(1);
    //echo "<p style='color: #062cfb'>getAddress </p>" . $api->getAddress();
    //sleep(1);
    //echo "<p style='color: #062cfb'>getCities </p>" . $api->getCities();
    /*===============================TEST================================*/

    /*
    $api = new ServiceAPI();
    //echo $api->getCep(89216210);
    $lista = $api->getCep(89216210);

    //echo $api->getCep(89010003);
    $obj = json_decode($lista);

        echo $obj->altitude;
        echo '<br/>';
        echo $obj->cep;
        echo '<br/>';
        echo $obj->latitude;
        echo '<br/>';
        echo $obj->longitude;
        echo '<br/>';
        echo $obj->logradouro;
        echo '<br/>';
        echo $obj->bairro;
        echo '<br/>';
        //echo $obj->cidade->ddd;
        echo '<br/>';
        //echo $obj->cidade->ibge;
        echo '<br/>';
        echo $obj->cidade->nome;
        echo '<br/>';
        echo $obj->estado->sigla;

        */

    

?>