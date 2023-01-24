<?php
$dir   = 'sqlite:base.sqlite';
$dbh   = new PDO($dir) or die("cannot open the database");


if($url = $_POST['sendurl']){
    if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        die('false');
    }
    else{
        $hash = substr( hash('md2', microtime()), 0, 8);
        
        $qry = $dbh->prepare("INSERT INTO urls (origin,hash) VALUES (?,?)");
        $qry->execute(array($url, $hash));
        
        echo json_encode(['url'=>$url, 'hash'=>'http://'.$_SERVER['HTTP_HOST'].'/'.$hash]);
    }
}