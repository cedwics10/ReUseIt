<?php
// Arrays of example data from members
$mem_number = 20;

$i = 0;

$mem_username = [];
$mem_password = [];
$mem_description = [];
$mem_status = [];
$mem_date = [];

while($i < $mem_number)
{
    $random_day = mt_rand(1,31);
    $random_month = mt_rand(1,12);
    $random_year = mt_rand(2010,2022);
    $username = 'member' . $i;

    

    $mem_username[] = $username;
    $mem_password[] = password_hash($username, PASSWORD_DEFAULT);

    $mem_date[] = mktime(0,0,0, $random_month, $random_day, $random_year);
    $mem_description[] = $pdo->quote("<i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum in veniam ducimus vero incidunt molestias est sapiente accusantium quidem aut expedita fugit asperiores harum, a, earum odit explicabo quasi. Commodi!</i>");
    $mem_status[] = mt_rand(0,3); 

    $i++;
}


// Generate data of members
$sql_members = 'INSERT INTO members (mem_id, mem_username, mem_password, mem_photo,
mem_arrival_date, mem_description, mem_status) VALUES ';

$data_member = [];
$i = 0;
while($i < $mem_number) {
    $data_member[] = "(NULL,
    '{$mem_username[$i]}',
    '{$mem_password[$i]}',
    '',
    '{$mem_date[$i]}', 
    {$mem_description[$i]},   
    '{$mem_status[$i]}')";
    $i++;
}

$sql_members .= implode(',', $data_member) . ';';
$pdo->exec($sql_members);