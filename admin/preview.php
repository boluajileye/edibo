<?php
require "./config/database.php";
if(isset($_POST['preview'])){
  $candidateid = $_POST['candidateid'];
  $voter = $_POST['candidatevoter'];
  for ($i=0; $i < count($candidateid); $i++) {
      $votee = $candidateid[$i];
      $query = "SELECT * FROM candidate LEFT JOIN position ON candidate.candidate_position=position.position_id WHERE `candidate_id` = $votee ";
      $result = $dbconnect->query($query);
      foreach($result as $preview){
          echo $preview['candidate_name'];
          echo $preview['position_name'];
      }
  }
}
if(isset($_POST['vote'])){
    $candidateid = $_POST['candidateid'];
    $voter = $_POST['candidatevoter'];
    for ($i=0; $i < count($candidateid); $i++) { 
        $votee = $candidateid[$i];
        $voter_new = $voter[$i];
        $query = "SELECT * FROM candidate LEFT JOIN position ON candidate.candidate_position=position.position_id WHERE `candidate_id` = $votee ";
        $result = $dbconnect->query($query);
        foreach($result as $preview){
            $candidate = $preview['candidate_id'];
            $positon = $preview['candidate_position'];
            $query = "INSERT INTO `election`(`position_id`, `candidate_id`, `user_id`) VALUES ('$positon', '$candidate', '$voter_new')";
        $result1 = $dbconnect->query($query);
        
            
        }
    }
    if($result1){
        echo "Vote casted successfully";
    }else{
        echo "Vote casted successfully";
    }
}
?>