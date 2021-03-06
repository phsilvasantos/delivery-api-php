<?php
namespace Delivery\Test;

require_once ('vendor/autoload.php');

/** Testes
 * ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/unit/ClientTest.php 
 */

use Delivery\Client;
use Delivery\Exceptions\DeliveryException;
use Delivery\Endpoints\Endpoint;
use Delivery\Endpoints\Ride;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

final class ClientTest extends TestCase
{
    private $optionsEstimate = [
        "user_id" => 35,
        "token" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee",
        'provider_type' => 22,
        'points' => array(
            array(
                "title" => "A",
                "action_type" => 1,
                "action" => "Deve entregar documento 213123",
                "geometry" => array(
                    "location" => array(
                        "lat" => -19.9224004,
                        "lng" => -43.94055579999997
                    )
                ),
            "address" => "Rua dos Goitacazes, 374 - Centro, Belo Horizonte - MG, Brasil"
            ),
            array(
                "title" => "B",
                "action_type" => 1,
                "action" => "Deve entregar documento 213123",
                "geometry" => array(
                    "location" => array(
                        "lat" => -19.9191953,
                        "lng" => -43.917991400000005
                    )
                ),
                "address" => "Av. dos Andradas, 500 - Santa Tereza, Belo Horizonte - MG, Brasil"
            ),
        ),
        'return_to_start' => true,
    ];
    private $optionRequestCreateStore = [
        "person" => 1,
        "user" => [
            "name" => "Loja Teste",
            "document" => "11122233344",
            "email" => "teste@loja.com",
            "phone" => "+5584988885555",
            "password" => "qweqwe",
            "acknowledgement" => "site",
            "confirm_password" => "qweqwe"
        ],
        "address" => [
            "street" => "Rua das ruas",
            "zip_code" => "12312308",
            "state" => "Estado",
            "district" => "Bairro",
            "city" => "Cidade",
            "country" => "Brasil",
            "complement" => "a",
            "number" => "1"
        ]
    ];
    private $optionsRequestCreate = [
        "user_id" => 35,
        "token" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee",
        'type' => 22,
        'points' => array(
            array(
                "title" => "A",
                "action_type" => 1,
                "action" => "Deve entregar documento 213123",
                "geometry" => array(
                    "location" => array(
                        "lat" => -19.9224004,
                        "lng" => -43.94055579999997
                    )
                ),
            "address" => "Rua dos Goitacazes, 374 - Centro, Belo Horizonte - MG, Brasil"
            ),
            array(
                "title" => "B",
                "action_type" => 1,
                "action" => "Deve entregar documento 213123",
                "geometry" => array(
                    "location" => array(
                        "lat" => -19.9191953,
                        "lng" => -43.917991400000005
                    )
                ),
                "address" => "Av. dos Andradas, 500 - Santa Tereza, Belo Horizonte - MG, Brasil"
            ),
        )
    ];

    public function testRequestTrackingSuccessfulResponse()
    {
        $client = new Client();

        $response = $client->store()->create($this->optionRequestCreateStore);
        //$response = $client->ride()->details(["id" => 162,"institution_id" => 1, "token" => '$2y$10$u8aWfSLtr3HwFUwrZXSZh.c5cda.rntSyUwEAbW2OEvGTDUGoaIn6']);
        fwrite(STDERR, print_r($response));
        
    }

    
/*    public function testEstimateSuccessfulResponse()
    {
        $client = new Client(null, true);

        $response = $client->ride()->estimate($this->optionsEstimate);
        
        $this->assertEquals($response->success, true);
    }
*/
    /**
     * @expectException() \Delivery\Exceptions\DeliveryException
     */
    /*
    public function testEstimateProviderTypeDidNotFound()
    {
        $client = new Client(null, true);

        $success = false;
        $errors = ["O campo provider type é necessário."];
        $error_code = 402;
        $this->optionsEstimate['provider_type'] = null;

        $response = $client->ride()->estimate($this->optionsEstimate);
        $this->assertEquals($success, $response->success);
        $this->assertEquals($errors, $response->errors);
        $this->assertEquals($error_code, $response->error_code);
    
    }*/

    /**
     * @expectException() \Delivery\Exceptions\DeliveryException
     */
    /*
    public function testEstimateTokenWrong()
    {
        $client = new Client(null, true);

        $success = false;
        $error = 'Acesso Não Autorizado';
        $error_code = 406;
        $this->optionsEstimate['token'] = 'wrong_token-2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee';

        $response = $client->ride()->estimate($this->optionsEstimate);
        $this->assertEquals($success, $response->success);
        $this->assertEquals($error, $response->error);
        $this->assertEquals($error_code, $response->error_code);
    
    }

    public function testRequestCreateSuccessfulResponse()
    {
        $client = new Client(null, true);

        $response = $client->ride()->create($this->optionsRequestCreate);
        if(!$response->success) {
            $this->assertEquals($response->errors, [""]);    
        }
        $this->assertEquals($response->success, true);
        
    }*/

    /**
     * @expectException() \Delivery\Exceptions\DeliveryException
     */
    /*
    public function testRequestCreateProviderTypeDidNotFound()
    {
        $client = new Client(null, true);

        $success = false;
        $errors = ["O campo type é necessário."];
        $error_code = 402;
        $this->optionsRequestCreate['type'] = null;

        $response = $client->ride()->create($this->optionsRequestCreate);
        $this->assertEquals($success, $response->success);
        $this->assertEquals($errors, $response->errors);
        $this->assertEquals($error_code, $response->error_code);
    
    }

    public function testRequestResendSuccessfulResponse()
    {
        $client = new Client(null, true);

        $response = $client->ride()->resend(["request_id" => 2383]);
        if(!$response->success) {
            $this->assertEquals($response->errors, [""]);    
        }
        $this->assertEquals($response->success, true);
        
    }
*/
    /*public function testRequestTrackingSuccessfulResponse()
    {
        $client = new Client(null, true);

        $response = $client->ride()->tracking(["id" => 2403, "api_key" => '$2y$10$aH0py6.UyUn2k9FTiDw28eLfXcNG0mEaJuy7Ib16gCKZ0NXNNgm9a']);
        fwrite(STDERR, print_r($response, TRUE));
        
    }*/
}
