<?php
include('pdo.php');

// Generate members and forums data
include('generators_basics.php');

// Generate lists and tasks data
include('generators_tasks.php');

// Generate topics and messages data
include('generators_forum_messages.php');

?>