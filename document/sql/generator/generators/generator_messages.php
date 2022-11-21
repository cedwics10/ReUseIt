<?php
// Arrays of example data from lists
$number_of_messages = 1200;


$mes_id_member = [];
$sub_id_subject = [];
$mes_date = [];
$mes_content = [];
$mes_status = [];
$mes_ip = [];

$i = 0;
while ($i < $number_of_messages) {

    $mes_id_member[] = mt_rand(1, 20);
    $sub_id_subject[] = mt_rand(1, 400);

    $random_day = mt_rand(1, 31);
    $random_month = mt_rand(1, 12);
    $random_year = mt_rand(2010, 2022);

    $random_hour = mt_rand(0, 23);
    $random_minute = mt_rand(0, 59);
    $random_second = mt_rand(0, 59);

    $mes_date[] = mktime(
        $random_hour,
        $random_minute,
        $random_second,
        $random_month,
        $random_day,
        $random_year
    );

    $mes_content[] = $pdo->quote('<a onclick="alert(\'hacked\')">FINI</a></html>');
    $mes_status[] = mt_rand(0,2);
    $mes_ip[] = strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255)) .'.' . strval(mt_rand(0,255));
    
    $i++;
}

// Generate data of members
$sql_list = 'INSERT INTO messages VALUES ';

$data_lists = [];

$i = 0;
while ($i < $number_of_messages) {
    $data_lists[] = "(NULL,
    {$mes_id_member[$i]},
    {$sub_id_subject[$i]},  
    {$mes_date[$i]},
    {$mes_content[$i]},
    {$mes_status[$i]},
    '{$mes_ip[$i]}')";

    $i++;
}

$sql_list .= implode(',', $data_lists) . ';';
$pdo->exec($sql_list);
