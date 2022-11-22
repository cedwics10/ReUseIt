<?php
// Arrays of example data from pm
$number_of_pmsubjects = 400;

$titres = [
    'Faire des pâtes', 'Devenir développeur',
    'Devenir riche avec la coupe du monde', 'Regarder des streamings',
    'Procrastriner', 'Arrêter de procrastiner', 'Faire de la couture',
    'Regarder la TV', 'Manger des nouilles', 'Refaire du taekwendo',
    'Défier le champion du monde de escrime', 'Sauter en parachute'
];

$pms_id = [];
$pms_id_author = [];
$pms_name = [];
$pms_task = [];
$pms_status = [];
$pms_ip = [];

$i = 0;
while($i < $number_of_pmsubjects)
{
    shuffle($titres);

    $pms_id[] = 'NULL';
    $id_member = mt_rand(1,20);
    $pms_id_author[] = $id_member;
    $pms_name[] = 'Aide : ' . $titres[0]; # Quote
    $pms_task[] = ($i % 5 == 0) ? 'NULL' : mt_rand(($id_member -1) * 20 + 1, ($id_member-2)*20 + 21);
    $pms_status[] = mt_rand(0,1);
    $pms_ip[] = strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255));
    $i++;
}

$sql = 'INSERT INTO pmsubjects VALUES ';
$i = 0;
$dataset = [];
while($i < $number_of_pmsubjects)
{
    $dataset[] = "({$pms_id[$i]}, {$pms_id_author[$i]},
    ". ($pdo->quote($pms_name[$i])) .",{$pms_task[$i]},
    {$pms_status[$i]}, '{$pms_ip[$i]}')";
    $i++;
}
$sql = $sql . ' ' . implode(',' . PHP_EOL , $dataset);
$pdo->query($sql);
?>