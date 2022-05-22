
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href='../img/logo/urlogo.png' rel="icon">
	<link href="../css/bracket-css.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/css.css" rel='stylesheet' type='text/css'>
	<link href="../css/css1.css" rel='stylesheet' type='text/css'>
	<link href="../css/css2.css" rel='stylesheet' type='text/css'>
	<link href="../css/css3.css" rel='stylesheet' type='text/css'>

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

	<script type = "text/JavaScript">
		function AutoRefresh( t ) {
			setTimeout("location.reload(true);", t);
		}
	</script>

	<title>WBSSRM-Single's Bracket</title>
</head>
<body onload = "JavaScript:AutoRefresh(2000);">
<?php
    include_once('../session/dbconnect.php');

    $tour_id = $_GET['ids'];
	$tour_sports_id = $_GET['ids2'];
	$target_dir = "../img/";

	$query2 = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$tour_id) or die(mysql_error());
	$result1 = mysql_fetch_array($query2);

    $query = mysql_query("SELECT a.*,c.sports_name,d.venue_name FROM tournament_sports a INNER JOIN sports c ON a.sports_id=c.sports_id INNER JOIN venue d ON a.venue_id=d.venue_id WHERE tour_sports_id=".$tour_sports_id." AND tournament_id=".$tour_id) or die(mysql_error());
    $result = mysql_fetch_array($query);
?>
	<section id="bracket">
	<p class="intro" id="intro"><?php echo $result1['tournament_name']; ?> - <span id="headline"><?php echo $result['sports_name']; ?></span></p>
	<!-- <h1 id="headline">Basketball</h1> -->
		 <p class="year"><?php echo $result['tournament_type']; ?></i></p>
     <p><img src="../img/black-user.png" width="20px" height="15px"/>&nbsp;<?php echo $result['no_of_teams']; ?> Participants&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../img/location.png" width="12px" height="15px"/>&nbsp;<?php echo $result['venue_name']; ?></p>
     <button class="btn no-print" onclick="window.print()">Print Bracket</button>
	 <?php
        $query1 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=1 ORDER BY a.match_id ASC") or die(mysql_error());
        $row1 = mysql_fetch_array($query1);
        $query2 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=2 ORDER BY a.match_id ASC") or die(mysql_error());
        $row2 = mysql_fetch_array($query2);
    ?>
	<div class="container">
	<div class="split split-one">
		<div class="round round-one current">
			<!-- <div class="round-details">Round 1<br/><span class="date">March 16</span></div> -->
            <ul class="matchup">
				<li class="team team-top disable"><span class="score"></span></li>
				<li class="team team-bottom disable"><span class="score"></span></li>
			</ul>

			<ul class="matchup">
				<center style="font-weight:bold">1</center>
				<li class="team team-top <?php echo $row1['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row1['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row1['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row1['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1['team_2']; ?></li>
			</ul>
		</div>
        <div class="round round-two current">
			<!-- <div class="round-details">Round 1<br/><span class="date">March 16</span></div> -->
			<ul class="matchup">
				<center style="font-weight:bold">2</center>
				<li class="team team-top <?php echo $row2['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row2['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row2['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row2['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['team_2']; ?></li>
			</ul>
            
		</div>
	</div> 
	</div>
	</section>