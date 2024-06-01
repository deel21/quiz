<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Quiz App </title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/font.css">
  <link rel="stylesheet" href="style.css">

  <script src="js/jquery.js" type="text/javascript"></script>


  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>


</head>
<?php
include_once 'functions.php';
$user_id = $_SESSION["user_id"];
RedirectToLogin();
?>

<body>

  <div class="bg">

    <!--navigation menu-->
    <nav class="navbar navbar-default title1">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if (@$_GET['q'] == 1)
              echo 'class="active"'; ?>><a href="account.php?q=1"><span
                  class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;All Quizzes<span
                  class="sr-only">(current)</span></a></li>
            <li <?php if (@$_GET['q'] == 2)
              echo 'class="active"'; ?>><a href="account.php?q=2"><span
                  class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
            <li>
              <a href="logout.php?q=account.php" ><span class="glyphicon glyphicon-log-out"
                  aria-hidden="true"></span>&nbsp;Logout</a>
            </li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav><!--navigation menu closed-->
    <div class="container"><!--container start-->
      <div class="row">
        <div class="col-md-12">



          <!--home start-->
          <?php if (@$_GET['q'] == 1) {

            echo "<h3 class='text-center' style='color: #fff;'>Available Quizzes</h3>";

            $result = mysqli_query($con, "SELECT * FROM quizzes ORDER BY date DESC") or die('Error');
            echo '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total Question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
            $c = 1;
            while ($row = mysqli_fetch_array($result)) {
              $title = $row['title'];
              $total = $row['questions_count'];
              $sahi = $row['score_per_q'];
              $time = $row['time_limit'];
              $eid = $row['id'];

              echo '<tr><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $sahi * $total . '</td><td>' . $time . '&nbsp;min</td>
	<td><b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:#2db44a; border-radius:0%"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';

            }
            $c = 0;
            echo '</table></div>';

          } ?>

          <!--quiz start-->
          <?php
          if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
            ?>
            <div class="app">
              <h1 id="title">Quiz App</h1>
              <div class="quiz">

                <?php
                $eid = @$_GET['eid'];
                $counter = @$_GET['n'];
                $total = @$_GET['t'];
                $offset = $counter - 1;
                $q = mysqli_query($con, "SELECT * FROM questions WHERE quiz_id=$eid limit 1 offset $offset  ");

                while ($row = mysqli_fetch_array($q)) {
                  $qns = $row['question_text'];
                  $qid = $row['id'];
                  $option_a = $row['option_a'];
                  $option_b = $row['option_b'];
                  $option_c = $row['option_c'];
                  $option_d = $row['option_d'];
                  $correct_op = $row['correct_option'];

                  echo "<h2 id='question'>Question $counter: $qns?</h2>";
                }
                ?>

                <div id="answer-buttons">
                  <button class="btn btn-option" name="a" onclick="checkAnswer(this,'<?= $correct_op; ?>')">
                    <?= $option_a; ?>
                  </button>
                  <button class="btn btn-option" name="b" onclick="checkAnswer(this,'<?= $correct_op; ?>')">
                    <?= $option_b; ?>
                  </button>
                  <button class="btn btn-option" name="c" onclick="checkAnswer(this,'<?= $correct_op; ?>')">
                    <?= $option_c; ?>
                  </button>
                  <button class="btn btn-option" name="d" onclick="checkAnswer(this,'<?= $correct_op; ?>')">
                    <?= $option_d; ?>
                  </button>
                </div>
                <?php

                echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $counter . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
             <br />';
                ?>
                <input type="hidden" id="user-choice" name="ans" value="">
                <button id="next-btn" type="submit">Next</button>
                </form>
              </div>
            </div>
            <?php

          }
          //result display
          if (@$_GET['q'] == 'result' && @$_GET['eid']) {
            $eid = @$_GET['eid'];
            $q = mysqli_query($con, "SELECT * FROM history inner join quizzes on quizzes.id = history.quiz_id  WHERE quiz_id=$eid AND user_id=$user_id  ") or die('Error157');
            echo '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

            while ($row = mysqli_fetch_array($q)) {
              $s = $row['score_per_q'] * $row['correct'];
              $w = $row['wrong'];
              $r = $row['correct'];
              $qa = $row['questions_count'];
              echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>' . $qa . '</td></tr>
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>' . $r . '</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>' . $w . '</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>' . $s . '</td></tr>';
            }

            echo '</table></div>';

          }
          ?>
          <!--quiz end-->
          <?php
          //history start
          if (@$_GET['q'] == 2) {
            $q = mysqli_query($con, "SELECT * FROM history inner join quizzes on quizzes.id = history.quiz_id  WHERE user_id=$user_id  ") or die('Error157');

            // $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
            echo '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Exams</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
            $c = 0;
            while ($row = mysqli_fetch_array($q)) {
              $eid = $row['quiz_id'];
              $s = $row['score_per_q'];
              $w = $row['wrong'];
              $r = $row['correct'];
              $qa = $row['questions_count'];

              $title = $row['title'];

              $c++;
              echo '<tr><td>' . $c . '</td><td>' . $title . '</td><td>' . $qa . '</td><td>' . $r . '</td><td>' . $w . '</td><td>' . $s . '</td></tr>';
            }
            echo '</table></div>';
          }

          ?>



        </div>
      </div>
    </div>
  </div>
  <!--Footer start-->





</body>
<script src="main.js" type="text/javascript"></script>

</html>