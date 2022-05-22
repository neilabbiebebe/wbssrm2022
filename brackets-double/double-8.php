<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href='../img/logo/urlogo.png' rel="icon">
	<link href="../css/bracket-css2.css" rel="stylesheet">
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

	<title>WBSSRM-Double's Bracket</title>
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
        $query3 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=3 ORDER BY a.match_id ASC") or die(mysql_error());
        $row3 = mysql_fetch_array($query3);
        $query4 = mysql_query("SELECT a.*,IF(ISNULL(b.team_acro),'<i>Loser of 2</i>',b.team_acro) AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,IF(ISNULL(c.team_acro),'<i>Loser of 3</i>',c.team_acro) AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=4 ORDER BY a.match_id ASC") or die(mysql_error());
        $row4 = mysql_fetch_array($query4);
        $query5 = mysql_query("SELECT a.*,IF(ISNULL(b.team_acro),'<i>Loser of 1</i>',b.team_acro) AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,IF(ISNULL(c.team_acro),'<i>Loser of 2</i>',c.team_acro) AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=5 ORDER BY a.match_id ASC") or die(mysql_error());
        $row5 = mysql_fetch_array($query5);
        $query6 = mysql_query("SELECT a.*,IF(ISNULL(b.team_acro),'<i>Loser of 3</i>',b.team_acro) AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,IF(ISNULL(c.team_acro),'<i>Loser of 4</i>',c.team_acro) AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=6 ORDER BY a.match_id ASC") or die(mysql_error());
        $row6 = mysql_fetch_array($query6);
        $query7 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=7 ORDER BY a.match_id ASC") or die(mysql_error());
        $row7 = mysql_fetch_array($query7);
        $query8 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=8 ORDER BY a.match_id ASC") or die(mysql_error());
        $row8 = mysql_fetch_array($query8);
        $query9 = mysql_query("SELECT a.*,IF(ISNULL(b.team_acro),'<i>Loser of 7</i>',b.team_acro) AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=9 ORDER BY a.match_id ASC") or die(mysql_error());
        $row9 = mysql_fetch_array($query9);
        $query10 = mysql_query("SELECT a.*,IF(ISNULL(b.team_acro),'<i>Loser of 8</i>',b.team_acro) AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=10 ORDER BY a.match_id ASC") or die(mysql_error());
        $row10 = mysql_fetch_array($query10);
        $query11 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=11 ORDER BY a.match_id ASC") or die(mysql_error());
        $row11 = mysql_fetch_array($query11);
        $query12 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=12 ORDER BY a.match_id ASC") or die(mysql_error());
        $row12 = mysql_fetch_array($query12);
        $query13 = mysql_query("SELECT a.*,IF(ISNULL(b.team_acro),'<i>Loser of 12</i>',b.team_acro) AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,c.team_acro AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=13 ORDER BY a.match_id ASC") or die(mysql_error());
        $row13 = mysql_fetch_array($query13);
        $query14 = mysql_query("SELECT a.*,b.team_acro AS team_1,IF(b.logo='','nologo.png',b.logo) AS logo_1,IF(ISNULL(c.team_acro),'<i>Winner of Losers Bracket</i>',c.team_acro) AS team_2,IF(c.logo='','nologo.png',c.logo) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id." AND a.bracket_no=14 ORDER BY a.match_id ASC") or die(mysql_error());
        $row14 = mysql_fetch_array($query14);
    ?>
	<div class="container">
	<div class="split split-one">
		<div class="round round-one current">
			<!-- <div class="round-details">Round 1<br/><span class="date">March 16</span></div> -->
            <ul class="matchup">
                <center style="font-weight:bold">1</center>
				<li class="team team-top <?php echo $row1['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row1['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row1['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row1['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1['team_2']; ?></li>
			</ul>

			<ul class="matchup">
                <center style="font-weight:bold">2</center>
				<li class="team team-top <?php echo $row2['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row2['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row2['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row2['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['team_2']; ?></li>
			</ul>

            <ul class="matchup">
                <center style="font-weight:bold">3</center>
				<li class="team team-top <?php echo $row3['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row3['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row3['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row3['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row3['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row3['team_2']; ?></li>
			</ul>

            <ul class="matchup">
                <center style="font-weight:bold">4</center>
				<li class="team team-top <?php echo $row4['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row4['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row4['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row4['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row4['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row4['team_2']; ?></li>
			</ul>

            <ul class="matchup">
				<li class="team team-top disable"><span class="score"></span></li>
				<li class="team team-bottom disable"><span class="score"></span></li>
			</ul>

            <ul class="matchup">
                <center style="font-weight:bold">5</center>
				<li class="team team-top <?php echo $row5['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row5['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row5['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row5['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row5['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row5['team_2']; ?></li>
			</ul>

			<ul class="matchup">
				<li class="team team-top disable"><span class="score"></span></li>
				<li class="team team-bottom disable"><span class="score"></span></li>
			</ul>

			<ul class="matchup">
                <center style="font-weight:bold">6</center>
				<li class="team team-top <?php echo $row6['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row6['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row6['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row6['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row6['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row6['team_2']; ?></li>
			</ul>
		</div>
        <div class="round round-two current">
			<!-- <div class="round-details">Round 1<br/><span class="date">March 16</span></div> -->
			<ul class="matchup">
                <center style="font-weight:bold">7</center>
				<li class="team team-top <?php echo $row7['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row7['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row7['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row7['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row7['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row7['team_2']; ?></li>
			</ul>

            <ul class="matchup">
                <center style="font-weight:bold">8</center>
				<li class="team team-top <?php echo $row8['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row8['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row8['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row8['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row8['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row8['team_2']; ?></li>
			</ul>

            <ul class="matchup">
                <center style="font-weight:bold">10</center>
				<li class="team team-top <?php echo $row10['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row10['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row10['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row10['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row10['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row10['team_2']; ?></li>
			</ul>

            <ul class="matchup">
                <center style="font-weight:bold">9</center>
				<li class="team team-top <?php echo $row9['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row9['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row9['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row9['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row9['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row9['team_2']; ?></li>
			</ul>
		</div>
        <div class="round round-three current">
			<!-- <div class="round-details">Round 1<br/><span class="date">March 16</span></div> -->
			<ul class="matchup">
            <center style="font-weight:bold">12</center>
				<li class="team team-top <?php echo $row12['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row12['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row12['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row12['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row12['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row12['team_2']; ?></li>
			</ul>

            <ul class="matchup">
            <center style="font-weight:bold">11</center>
				<li class="team team-top <?php echo $row11['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row11['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row11['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row11['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row11['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row11['team_2']; ?></li>
			</ul>
		</div>
        <div class="round round-four-last current">
			<!-- <div class="round-details">Round 1<br/><span class="date">March 16</span></div> -->
			<ul class="matchup-1st">
                <center style="font-weight:bold">14</center>
				<li class="team team-top <?php echo $row14['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row14['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row14['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row14['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row14['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row14['team_2']; ?></li>
			</ul>

            <ul class="matchup-2nd">
                <center style="font-weight:bold">13</center>
				<li class="team team-top <?php echo $row13['status_1']; ?>"><img style="margin-top:2px;position:absolute" src="<?php echo $target_dir; ?><?php echo $row13['logo_1']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row13['team_1']; ?></li>
				<li class="team team-bottom <?php echo $row13['status_2']; ?>"><img style="margin-top:2px;position:absolute" src="<?php  echo $target_dir; ?><?php echo $row13['logo_2']; ?>" width="15px" AND height="20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row13['team_2']; ?></li>
			</ul>
		</div>
	</div> 
	</div>
	</section>