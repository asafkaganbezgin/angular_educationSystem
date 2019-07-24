<?php

include "../settings.php";


/*
 *
 *  Token ? ya da session ? 7
 *
 * Token ya da session bilgisinden grup ve haklarını çekcez
 * */


$userArrayList = array(
    array("email" => "emre.karatasoglu@hotmail.com","name"=>"emre","id"=>1),
    array("email" => "emre.karatasoglu@hotmail.com2","name"=>"emre2","id"=>2),
    array("email" => "emre.karatasoglu@hotmail.com3","name"=>"emre3","id"=>3),
);

echo json_encode($userArrayList);

?>
