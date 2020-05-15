Para utilizar esta API:

GET > para utilizar a requisicao GET, deverá informar o ID do usuario com o paremetro "usuario_id".

POST> basta informar os campos devidamente preenchidos
                                    {
                                   	"usuario_id": "",
                                   	"tarefa": "",
                                   	"descricao": "",
                                   	"concluido": ""
                                   }
PUT> Basta informar o ID da terefa  que será atualizada com o paremetro "tarefa_id", junto dos campos devidamente preenchidos
                                    {
                                   	"usuario_id": "",
                                   	"tarefa": "",
                                   	"descricao": "",
                                   	"concluido": ""
                                   }

DELETE > Basta informar o ID da tarefa a ser deletado com o paremetro "tarefa_id"


Exemplo utilizando o PHP cURL:

            $URL = "localhost:8080"// URL da API
            $usuarioId = "1" // ID do usuario
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => "$URL",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET", // Metodo utilizado
              CURLOPT_POSTFIELDS => "usuario_id=1", // Parametros Adicionais
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "Cookie: Phpstorm-23d61004=b187614b-471f-43c9-b04b-7554a40398c2"
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;

Exemplo utilizando Jquery:

            var settings = {
              "url": "localhost:8080", // URL
              "method": "GET", //metodo utilizado
              "timeout": 0,
              "headers": {
                "Content-Type": "application/x-www-form-urlencoded",
                "Cookie": "Phpstorm-23d61004=b187614b-471f-43c9-b04b-7554a40398c2"
              },
              "data": {
                "usuario_id": "1" // parametros
              }
            };
            
            $.ajax(settings).done(function (response) {
              console.log(response);
            });