<?php
// Arrays of example data from tasks
$tasks_number = 400;



$tas_title = [];
$tas_id_list = [];
$tas_description = [];
$tas_due_date = [];
$tas_importance = [];
$tas_visibility = [];

$i = 0;
while ($i < $tasks_number) {

    $tas_id_list[] = $i + 1;

    $tas_name[] = 'task' . $i;
    $tas_description[] = $pdo->quote("<i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum in veniam ducimus vero incidunt molestias est sapiente accusantium quidem aut expedita fugit asperiores harum, a, earum odit explicabo quasi. Commodi!</i>");

    $random_day = mt_rand(1, 31);
    $random_month = mt_rand(1, 12);
    $random_year = mt_rand(2010, 2022);

    $tas_importance[] = mt_rand(1, 3);

    $tas_due_date[] = mktime(0, 0, 0, $random_month, $random_day, $random_year);
    # add tas_reminder

    $tas_status[] = mt_rand(0, 1);

    $tas_visibility[] = mt_rand(0, 2);

    $i++;
}


// Generate data of members
$sql_tasks = 'INSERT INTO tasks (tas_id,tas_id_list,tas_name,tas_description,tas_importance,tas_due_date,tas_status) VALUES ';

$data_tasks = [];

$i = 0;
while ($i < $tasks_number) {

    $data_tasks[] = "('NULL',
    {$tas_id_list[$i]},
    '{$tas_name[$i]}',
    {$tas_description[$i]},
    {$tas_importance[$i]},
    '{$tas_due_date[$i]}',  
    {$tas_visibility[$i]}
    )";

    $i++;
}

$sql_tasks .= implode(',', $data_tasks) . ';';
$pdo->exec($sql_tasks);
