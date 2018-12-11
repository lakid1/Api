<?php
$a = random_bytes(64);

echo hash('sha256',$a);

$a = "";

if(empty($a)){
    echo("True");
}else{
    echo("False");
}

