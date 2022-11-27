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

$pma_id_subject = [];
$pma_id_sender = [];
$pma_message = [];
$pma_time = [];	

$pma_date_first_answer = [];

$sql = '';

# EDIT
$subj = 0;
while($subj < nb_of_subjects)
{
    for($ans_n = 0;$ans_n < nb_answer_per_subjet; $ans_n++)
    {
        shuffle($titres);

        $pma_id[] = 'NULL';
        $id_sub = $subj;
        $current_subject = ($id_sub < 100) ? $id_sub : 99;
        $pma_id_subject[] = $current_subject;
        
        $sender_number = mt_rand(1,100);
        $pma_id_sender[] = ($subj % 8 == 0) ? $sender_number : mt_rand(0,100);  // number of members.
        
        $pma_message[] = $titres[array_rand($titres)];
        
        if($ans_n == 0)
            $pma_date_first_answer[] = mktime(0,0,0,mt_rand(1,12), mt_rand(0,31), mt_rand(2020,2022));
        $pma_time[] = $pma_date_first_answer[$current_subject] + 60  * ($i % 8);	
    }
    $subj++;
}

$sql = 'INSERT INTO pmanswers VALUES ';
$dataset = [];

$mess = 0;

while($mess < nb_of_messages)
{
    $dataset[] = "(NULL, '{$pma_id_subject[$mess]}', {$pma_id_sender[$mess]},{$pdo->quote($pma_message[$mess])}, {$pma_time[$mess]})" . PHP_EOL;
    $mess++;
}
$sql = $sql . ' ' . implode(',' . PHP_EOL , $dataset);
$pdo->query($sql);
$member_lists_subjects = array_chunk($pma_id_sender, 8);
?>