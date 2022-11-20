<?php
// Arrays of example data from sujects
$sub_number = 10;

$i = 0;

$for_title = [];
$for_description = [];

while($i < $sub_number)
{
    $random_day = mt_rand(1,31);
    $random_month = mt_rand(1,12);
    $random_year = mt_rand(2010,2022);

    $forum = 'forum' . $i;

    $for_name[] = $forum;
    $for_date[] = mktime(0,0,0, $random_month, $random_day, $random_year);
    $for_description[] = $pdo->quote("<i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum in veniam ducimus vero incidunt molestias est sapiente accusantium quidem aut expedita fugit asperiores harum, a, earum odit explicabo quasi. Commodi!</i>");
    $mem_status[] = mt_rand(0,1); 

    $i++;
}


// Generate data of members
$sql_forum = 'INSERT INTO forums (for_id,for_name,for_description,for_date,for_status) VALUES ';

$data_forum = [];
$i = 0;
while($i < $sub_number) {
    $data_forum[] = "(NULL,
    '{$for_name[$i]}',
    {$for_description[$i]},
    '{$for_date[$i]}',  
    '{$mem_status[$i]}')";
    $i++;
}

$sql_forum .= implode(',', $data_forum) . ';';
$pdo->exec($sql_forum);