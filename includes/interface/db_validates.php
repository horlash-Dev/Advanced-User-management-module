<?php 

interface database{
function insert($fname,$lname,$email,$user,$password);
function login($data);
function userInfo($edata);
function fgtDel($edata);
function fgtInsert($edata,$everify,$etoken);
function authToken($vtoken);	
}

 ?>