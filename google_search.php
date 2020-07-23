<?php

require_once ('creditails.php');
require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;



$q = http_build_query(array(
    'key' => $key,
    'cx'  => $cx,
    'q'   => 'веб студия' // запрос для поиска
));
// Инициализация клиента
$client = new Client(array(
   'base_uri' => 'https://www.googleapis.com/customsearch/v1',
    'query'    => $q,
    'timeout'  => 3.0,
    'debug'    => true,
    'headers'  => array(
      'Accept' => 'application/json'
    ),
));

// отправка запроса и получение результатов поиска
$response = $client->request('GET');
$results = json_decode($response->getBody()->getContents(), true);
var_dump($results);
?>