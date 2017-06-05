<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 05.06.2017
 * Time: 15:00
 */
$SERVER='127.0.0.1';
$user='root';
$password='';
$db='turnierverwaltung';
$port='3306';
$con=mysqli_connect($SERVER, $user, "",$db, $port);

if(!$con){
    die("Connection failed!: ".mysqli_connect_error());
}
?>