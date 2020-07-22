<?php
require_once ('channels.php');
require_once ('settings.php');
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
require_once 'madeline.php';


function parse_telegram_channels($channels){
  for($i=0;$i<count($channels);$i++){
    echo $channels[$i];
  }
}

function main($channels){
    parse_telegram_channels($channels);
    
}
main($telegram_channels);
