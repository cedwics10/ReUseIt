<?php
include('../pdo.php');
// Arrays of example data from pm
const nb_of_answers = 800;

$titres = [
    'Faire des pâtes', 'Devenir développeur',
    'Devenir riche avec la coupe du monde', 'Regarder des streamings',
    'Procrastriner', 'Arrêter de procrastiner', 'Faire de la couture',
    'Regarder la TV', 'Manger des nouilles', 'Refaire du taekwendo',
    'Défier le champion du monde de escrime', 'Sauter en parachute'
];

$pma_id = [];
$pma_id_subject = [];
$pma_id_sender = [];
$pma_message = [];
$pma_time = [];	

$date_first_answer = [];

$sql = '';

# EDIT
$i = 0;
while($i < nb_of_answers)
{
    shuffle($titres);

    $pma_id[] = 'NULL';
    $current_subject = floor($i / 8) + 1;
    $pma_id_subject[] = $current_subject;
    
    $sender_number = mt_rand(1,100);
    $pma_id_sender[] = ($i % 8 == 0) ? $sender_number : mt_rand(0,100);  // number of members.
    
    $pma_message[] = $titres[array_rand($titres)];
    

    if($i % 8 == 0)
        $date_first_answer[] = mktime(0,0,0,mt_rand(1,12), mt_rand(0,31), mt_rand(2020,2022));
    $pma_time[] = $date_first_answer[$current_subject - 1] + 60  * ($i % 8);	
    $i++;
}

$sql = 'INSERT INTO pmanswers VALUES ';
$i = 0;
$dataset = [];
while($i < nb_of_answers)
{
    $dataset[] = "({$pma_id[$i]}, {$pma_id_subject[$i]}, {$pma_id_sender[$i]},{$pdo->quote($pma_message[$i])}, {$pma_time[$i]})" . PHP_EOL;
    $i++;
}
$sql = $sql . ' ' . implode(',' . PHP_EOL , $dataset);
print(nl2br($sql));
?>