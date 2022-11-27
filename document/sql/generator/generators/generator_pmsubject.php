<?php
// Arrays of example data from pm
const nb_answer_per_subjet = 8;
const nb_of_subjects = 100;
const nb_of_messages =  nb_of_subjects * nb_answer_per_subjet;

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

$data_subject = [];

$subj = 1;
while($subj <= nb_of_subjects)
{
    shuffle($titres);

    $pms_id[] = 'NULL';
    $id_member = mt_rand(1,20);
    $pms_id_author[] = $id_member;
    
    shuffle($titres);
    $pms_name[] = 'Aide : ' . $titres[0];
    
    $pms_task[] = ($subj % 5 == 0) ? 'NULL' : mt_rand(($id_member -1) * 20 + 1, ($id_member-2)*20 + 21);
    
    $pms_status[] = mt_rand(0,1);
    
    $ip_member = strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255)) . '.' . strval(mt_rand(0,255));
    $pms_ip[] = $ip_member;
    
    $subj++;
}

$sql = 'INSERT INTO pmsubjects VALUES ';
$subj = 0;
$dataset = [];
while($subj < nb_of_subjects)
{
    $dataset[] = "({$pms_id[$subj]}, {$pms_id_author[$subj]},
    ". ($pdo->quote($pms_name[$subj])) .",{$pms_task[$subj]},
    {$pms_status[$subj]}, '{$pms_ip[$subj]}')";
    $subj++;
}
$sql = $sql . ' ' . implode(',' . PHP_EOL , $dataset);
$pdo->query($sql);
?>