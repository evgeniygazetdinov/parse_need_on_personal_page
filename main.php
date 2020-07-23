<?php
require_once ('channels.php');
require_once ('settings.php');
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';



function make_data_based_on_channels_list($channels){
  $data = array(
          'peer' => '@'.$channels[0], //название_канала, должно начинаться с @, например @breakingmash, все остальные параметры, кроме limit, можно оставить равными 0
          'offset_id' => 0, 
          'offset_date' => 0, 
          'add_offset' => 0, 
          'limit' => 10, //Количество постов, которые вернет клиент
          'max_id' => 0, //Максимальный id поста
          'min_id' => 0, //Минимальный id поста - использую для пагинации, при  0 возвращаются последние посты.
          'hash' => 0
          );
  return $data;
}



function parse_telegram_channels($channels){
  $data = make_data_based_on_channels_list($channels);
  return $data;
}

function main($channels){
    $MadelineProto = new \danog\MadelineProto\API('session.madeline');
    $MadelineProto->async(true);
    $data = parse_telegram_channels($channels);
    $MadelineProto->loop(function () use ($MadelineProto) {
      yield $MadelineProto->start();
  
      $me = yield $MadelineProto->getSelf();
  
      $MadelineProto->logger($me);
    
    if (!$me['bot']) {
      $response = $MadelineProto->messages->getHistory($data);
    }
    
  }

);
}

 main($telegram_channels);
