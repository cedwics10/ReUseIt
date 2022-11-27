<?php
// Arrays of example data from pm

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
$subj = 1;
while ($subj <= nb_of_subjects) {
    for ($ans_n = 0; $ans_n < nb_answer_per_subjet; $ans_n++) {
        
        shuffle($titres);
        $pma_id_subject[] = $subj;

        $sender_number = ($ans_n  == 0) ? $pms_id_author[$subj-1] : mt_rand(1, $mem_number);
        
        $pma_id_sender[] = $sender_number;
        $pma_message[] = $titres[array_rand($titres)];

        if ($ans_n == 0)
            $pma_date_first_answer[] = mktime(0, 0, 0, mt_rand(1, 12), mt_rand(0, 31), mt_rand(2020, 2022));
        $pma_time[] = end($pma_date_first_answer) + 60 * ($i % 8);
    }
    $subj++;
}

$sql = 'INSERT INTO pmanswers VALUES ';
$dataset = [];

$mess_no = 0;
while($mess_no < nb_of_messages) {
    $dataset[] = "(NULL, {$pma_id_subject[$mess_no]}, {$pma_id_sender[$mess_no]},{$pdo->quote($pma_message[$mess_no])}, '{$pma_time[$mess_no]}','BONJOUR')" . PHP_EOL;
    $mess_no++;
}

$sql = $sql . ' ' . implode(',' . PHP_EOL, $dataset);
$pdo->query($sql);
$subjet_viewers = array_chunk($pma_id_sender, 8);
?>