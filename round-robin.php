
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link href='img/logo/urlogo.png' rel="icon">
<link href="css/bracket-css.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/css.css" rel='stylesheet' type='text/css'>
<link href="css/css1.css" rel='stylesheet' type='text/css'>
<link href="css/css2.css" rel='stylesheet' type='text/css'>
<link href="css/css3.css" rel='stylesheet' type='text/css'>

    <script>
        setInterval(function(){window.location.reload();},2000);
    </script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #000000;
  text-align: left;
  padding: 10px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<style>
		button.btn {
			padding: 10px;
			background-color: #6777ef;
			border: none;
			border-radius: .3em;
			color: #fff;
			cursor: pointer;
			font-size: 15px;
		}

		@media print
		{    
			.no-print, .no-print *
			{
				display: none !important;
			}
		}
	</style>
    <title>WBSSRM - Round Robin</title>
<?php
    include_once('session/dbconnect.php');
    session_start();

    $tour_id = $_GET['ids'];
	  $tour_sports_id = $_GET['ids2'];
	  $target_dir = "img/";

    $query2 = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$tour_id) or die(mysql_error());
	  $result1 = mysql_fetch_array($query2);

    $query = mysql_query("SELECT a.*,c.sports_name,d.venue_name FROM tournament_sports a INNER JOIN sports c ON a.sports_id=c.sports_id INNER JOIN venue d ON a.venue_id=d.venue_id WHERE tour_sports_id=".$tour_sports_id." AND tournament_id=".$tour_id) or die(mysql_error());
    $result = mysql_fetch_array($query);

    $array = [];

    $query1 = mysql_query("SELECT a.*,b.team_acro,IF(b.logo='','nologo.png',b.logo) AS logo FROM tournament_team a INNER JOIN team b ON a.team_id=b.team_id WHERE tour_sports_id=".$tour_sports_id." AND tournament_id=".$tour_id) or die(mysql_error());
    while($row1 = mysql_fetch_array($query1)){

    $query2 = mysql_query("SELECT count(*) AS wins FROM `tournament_match` WHERE team_id_1 = ".$row1['team_id']." AND status_1='winner' AND tour_sports_id=".$tour_sports_id." AND tournament_id=".$tour_id) or die(mysql_error());
    $row2 = mysql_fetch_array($query2);

    $query3 = mysql_query("SELECT count(*) AS wins FROM `tournament_match` WHERE team_id_2 = ".$row1['team_id']." AND status_2='winner' AND tour_sports_id=".$tour_sports_id." AND tournament_id=".$tour_id) or die(mysql_error());
    $row3 = mysql_fetch_array($query3);
    
    $query4 = mysql_query("SELECT count(*) AS loss FROM `tournament_match` WHERE team_id_1 = ".$row1['team_id']." AND status_1='losser' AND tour_sports_id=".$tour_sports_id." AND tournament_id=".$tour_id) or die(mysql_error());
    $row4 = mysql_fetch_array($query4);

    $query5 = mysql_query("SELECT count(*) AS loss FROM `tournament_match` WHERE team_id_2 = ".$row1['team_id']." AND status_2='losser' AND tour_sports_id=".$tour_sports_id." AND tournament_id=".$tour_id) or die(mysql_error());
    $row5 = mysql_fetch_array($query5);

    $win_total = $row2['wins'] + $row3['wins'];
    $loss_total = $row4['loss'] + $row5['loss'];

    $array[] = array('logo' => $row1['logo'], 'name' => $row1['team_acro'], 'win' => $win_total, 'loss' => $loss_total);

    }

    $developers = array_map(function ($each) {
      return $each['win'];
  }, $array);
  array_multisort($developers, SORT_DESC, $array);
?>
<p class="intro" style="padding-left:20px;font-size:35px" id="intro"><?php echo $result1['tournament_name']; ?> - <span id="headline"><?php echo $result['sports_name']; ?></span></p>
<p class="year" style="padding-left:20px"><?php echo $result['tournament_type']; ?></i></p>
<p style="margin-top:-1px;padding-left:20px"><img src="img/black-user.png" width="20px" height="15px"/>&nbsp;<?php echo $result['no_of_teams']; ?> Participants&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/location.png" width="12px" height="15px"/>&nbsp;<?php echo $result['venue_name']; ?></p>
<!-- <h3 style="margin-top:-5px;padding-left:20px"><img src="img/black-user.png" width="25px" height="20px"/>&nbsp;&nbsp;<?php echo $result['no_of_teams']; ?> Participants&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/location.png" width="15px" height="20px"/>&nbsp;&nbsp;<?php echo $result['venue_name']; ?></h3> -->
<button style="margin-left:20px" class="btn no-print" onclick="window.print()">Print Bracket</button><br/><br/>
<div class="row" style="padding-left:20px">
    <table style="border:1px solid">
        <thead>
            <tr>
                <th style="text-align:center;width:20px">Rank</th>
                <th>Participant</th>
                <th style="text-align:center">W - L</th>
            </tr>
        </thead>
        <tbody>
<?php
    $count = 1;
    foreach($array as $team){
?>
    <tr>
        <td style="text-align:center;font-weight:bold"><?php if($count <= 16){echo $count;}else{echo '';} ?></td>
        <td><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $team['logo']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $team['name'] ?></td>
        <td style="text-align:center"><?php echo $team['win']; ?> - <?php echo $team['loss']; ?></td>
    </tr>
<?php
  $count++;
  }
?>
    </tbody>
    </table>
</div>