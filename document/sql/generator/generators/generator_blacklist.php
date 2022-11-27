<?php
// Arrays of example data from lists
$number_of_blacklists = 10;

$bla_id_member = [];
$bla_id_blacklisted = [];

$i = 1;
while ($i <= $number_of_blacklists) {
    $bla_id_member[] = $i;
    $bla_id_blacklisted[] = $i + 5;
    $i++;
}

// Generate data of members
$sql_list = 'INSERT INTO blacklist VALUES ';
$data_lists = [];

$i = 0;
while ($i < $number_of_blacklists) {
    $data_lists[] = "(NULL, {$bla_id_member[$i]},{$bla_id_blacklisted[$i]})";
    $i++;
}

$sql_list .= implode(',', $data_lists) . ';';
$pdo->exec($sql_list);
