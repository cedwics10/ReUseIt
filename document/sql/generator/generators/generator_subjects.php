<?php
// Arrays of example data from lists
$number_of_subjects = 400;

$titres = [
    'Faire des pâtes', 'Devenir développeur',
    'Devenir riche avec la coupe du monde', 'Regarder des streamings',
    'Procrastriner', 'Arrêter de procrastiner', 'Faire de la couture',
    'Regarder la TV', 'Manger des nouilles', 'Refaire du taekwendo',
    'Défier le champion du monde de escrime', 'Sauter en parachute'
];

$sub_id_forum = [];
$sub_id_member = [];
$sub_id_task = [];
$sub_name = [];
$sub_pinned = [];
$sub_status = [];
$sub_date = [];

$i = 0;
while ($i < $number_of_subjects) {

    $sub_id_forum[] = mt_rand(1, 10);
    $id_member = mt_rand(1, 20);
    $sub_id_member[] = $id_member;

    $sub_id_task[] = ($i % 3 == 0) ?  mt_rand($id_member * 20 + 1, $id_member * 20 + 21) : NULL;
    $sub_name[] = $titres[mt_rand(0, 10)];

    $random_day = mt_rand(1, 31);
    $random_month = mt_rand(1, 12);
    $random_year = mt_rand(2010, 2022);

    $sub_pinned[] = mt_rand(0, 1);
    $sub_status[] = mt_rand(0, 2);

    $sub_date[] = mktime(0, 0, 0, $random_month, $random_day, $random_year);


    $i++;
}

// Generate data of members
$sql_list = 'INSERT INTO subjects VALUES ';

$data_lists = [];

$i = 0;
while ($i < $number_of_subjects) {
    $data_lists[] = "(NULL,
    {$sub_id_forum[$i]},
    {$sub_id_member[$i]},  
    '{$sub_id_task[$i]}',
    '{$sub_name[$i]}',
    '{$sub_pinned[$i]}',
    '{$sub_status[$i]}',
    '{$sub_date[$i]}'
    )";

    $i++;
}

$sql_list .= implode(',', $data_lists) . ';';
$pdo->exec($sql_list);
