<?php
const ONE_HOUR = 60 * 60;

$pmr_id_pmsubject = [];
$pmr_id_answer = [];
$pmr_id_reciever = [];
$pmr_date_recieved = [];
$pmr_date_read = [];

for($answer_no = 1; $answer_no < nb_of_messages;$answer_no++)
{
    $subj_no = $pma_id_subject[$answer_no];
    foreach($subjet_viewers[$subj_no-1] as $viewer_id)
    {
        $pmr_id_pmsubject[] = $subj_no;
        $pmr_id_answer[] = $answer_no;
        $pmr_id_reciever[] = $viewer_id;
        $pmr_date_recieved[] =  $pma_time[$answer_no-1];
        $pmr_date_read[] = $pma_time[$answer_no-1] + ONE_HOUR;
    }
}
$sql = 'INSERT INTO pmrecievers VALUES ';
$dataset = [];

$read_no = 0;
while($read_no < count($pmr_id_pmsubject)) {
    $dataset[] = "('NULL',
    $pmr_id_pmsubject[$read_no],
    $pmr_id_answer[$read_no],
    $pmr_id_reciever[$read_no],
    $pmr_date_recieved[$read_no],
    $pmr_date_read[$read_no])";
    $read_no++;
}

$sql .= implode(',', $dataset);
$pdo->query($sql);
?>