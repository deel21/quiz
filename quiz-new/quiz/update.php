<?php
include_once './functions.php';
RedirectIfNotAdmin();

$user_id = $_SESSION["user_id"];

//remove quiz
  if (@$_GET['q'] == 'rmquiz') {
    $eid = @$_GET['eid'];
    $r = mysqli_query($con, "DELETE FROM quizzes WHERE id='$eid' ") or die('Error in delete quiz');

    header("location:dash.php?q=0");
  }

//add quiz
  if (@$_GET['q'] == 'addquiz' ) {
    $name = $_POST['name'];
    $name = ucwords(strtolower($name));
    $Qcount = $_POST['total'];
    $Qscore = $_POST['right'];
    $time = $_POST['time'];
    $desc = $_POST['desc'];
    $q3 = mysqli_query($con, "INSERT INTO quizzes(title,questions_count,score_per_q,time_limit,description,date) VALUES  ('$name' , $Qcount,$Qscore,$time ,'$desc', NOW())");
    $id = mysqli_insert_id($con);
    header("location:dash.php?q=4&step=2&eid=$id&n=$Qcount");
  }

//add question
  if (@$_GET['q'] == 'addqns' ) {
    $n = @$_GET['n'];
    $Qid = @$_GET['eid'];
    $ch = @$_GET['ch'];

    for ($i = 1; $i <= $n; $i++) {
      $qns = $_POST['qns' . $i];
      $a = $_POST[$i . '1'];
      $b = $_POST[$i . '2'];
      $c = $_POST[$i . '3'];
      $d = $_POST[$i . '4'];
      $e = $_POST['ans' . $i];
      $q3 = mysqli_query($con, "INSERT INTO questions VALUES  (NULL,'$qns' ,'$a','$b','$c','$d', '$e' , $Qid)");

    }
    header("location:dash.php?q=0");
  }


//quiz start
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
  $eid = @$_GET['eid'];
  $sn = @$_GET['n'];
  $total = @$_GET['t'];
  $ans = $_POST['ans'];
  $qid = @$_GET['qid'];
  $correct_ans = "";
  $q = mysqli_query($con, "SELECT * FROM questions WHERE id=$qid ");
  while ($row = mysqli_fetch_array($q)) {
    $correct_ans = $row['correct_option'];
  }



  if ($sn == 1) {
    $q0 = mysqli_query($con, "delete from history where user_id = $user_id and quiz_id = $eid");
    $q = mysqli_query($con, "INSERT INTO history VALUES(NULL,$user_id,$eid,0,0)") or die('Error');
  }
  if ($ans == $correct_ans) {
    $q = mysqli_query($con, "UPDATE history SET correct = correct + 1 where user_id = $user_id and quiz_id = $eid") or die("update error");
  } else {
    $q = mysqli_query($con, "UPDATE history SET wrong = wrong + 1 where user_id = $user_id and quiz_id = $eid") or die("update error");
  }

  if ($sn != $total) {
    $sn++;
    header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total") or die('Error152');
  }  else {
    header("location:account.php?q=result&eid=$eid");
  }
}



?>