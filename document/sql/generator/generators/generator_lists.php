<?php
// Arrays of example data from lists
$lists_number = 400;

$i = 0;

$lis_title = [];
$lis_id_member = [];
$lis_description = [];
$lis_visibility = [];


while ($i < $lists_number) {
    $lis_id_member[] = floor($i / 20) + 1;
    
    $random_day = mt_rand(1, 31);
    $random_month = mt_rand(1, 12);
    $random_year = mt_rand(2010, 2022);

    $lis_date[] = mktime(0, 0, 0, $random_month, $random_day, $random_year);

    $lis_name[] = 'list' . $i;

    $lis_description[] = $pdo->quote("<i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum in veniam ducimus vero incidunt molestias est sapiente accusantium quidem aut expedita fugit asperiores harum, a, earum odit explicabo quasi. Commodi!</i>");

    $lis_visibility[] = mt_rand(0, 2);

    $i++;
}


// Generate data of members
$sql_list = 'INSERT INTO lists (lis_id,lis_id_member,lis_date,
lis_name,lis_description,lis_visbility) VALUES ';

$data_lists = [];

$i = 0;
while ($i < $lists_number) {

    $data_lists[] = "(NULL,
    {$lis_id_member[$i]},
    '{$lis_date[$i]}',  
    '{$lis_name[$i]}',
    {$lis_description[$i]},
    '{$lis_visibility[$i]}'
    )";

    $i++;
}

$sql_list .= implode(',', $data_lists) . ';';
$pdo->exec($sql_list);
