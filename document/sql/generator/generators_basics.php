<?php
$sql = file_get_contents('../reuseit.sql');
$pdo->exec($sql);


// Generate data of members
include('generators/generator_member.php');

// Generate data of forum
include('generators/generator_forum.php');



