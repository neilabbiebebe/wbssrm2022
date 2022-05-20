<link href="css/bracket-css.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/css.css" rel='stylesheet' type='text/css'>
<link href="css/css1.css" rel='stylesheet' type='text/css'>
<link href="css/css2.css" rel='stylesheet' type='text/css'>
<link href="css/css3.css" rel='stylesheet' type='text/css'>
<head>
<title>WBSSRM-Schedule</title>
</head>

<!-- <p class="intro" id="intro">sample - <span id="headline">sample</span></p> -->
<section id="bracket">
<?php
    include_once('session/dbconnect.php');

    session_start();

    date_default_timezone_set("Asia/Manila");
	$date1 = date("m/d/Y");
	$datetime1 = date("Y-m-d h:i:sa");

    $tour_id = $_GET['ids'];
    $start_date = $_GET['tstart'];
    $end_date = $_GET['tend'];
    $start_date2 = $_GET['tstart'];
    $end_date2 = $_GET['tend'];
    $sel = $_GET['sel'];
    @$sid = $_GET['sid'];
    $record_flag = 0;
    $sports_flag = 0;

    $query = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$tour_id) or die(mysql_error());
    $result = mysql_fetch_array($query);
    
    echo '<p class="intro" id="intro" style="font-size:50px">'.$result['tournament_name'].'</p>';

    while (strtotime($start_date) <= strtotime($end_date))
    {
        // echo $start_date.'</br>';

        if($sel=='All'){
            $query1 = mysql_query("SELECT a.*,b.sports_name,c.venue_name FROM tournament_sports a INNER JOIN sports b ON a.sports_id=b.sports_id INNER JOIN venue c ON a.venue_id=c.venue_id WHERE a.tournament_id=".$tour_id) or die(mysql_error());
        }
        else{
            $query1 = mysql_query("SELECT a.*,b.sports_name,c.venue_name FROM tournament_sports a INNER JOIN sports b ON a.sports_id=b.sports_id INNER JOIN venue c ON a.venue_id=c.venue_id WHERE a.sports_id=".$sid." AND a.tournament_id=".$tour_id) or die(mysql_error());
        }
        while($row = mysql_fetch_array($query1)){
            $sports_flag = 0;
            $query2 = mysql_query("SELECT * FROM tournament_schedule WHERE tournament_id=".$tour_id." AND tour_sports_id=".$row['tour_sports_id']." AND sched_date='".$start_date."' ORDER BY start_time ASC") or die(mysql_error());
            while($row1 = mysql_fetch_array($query2)){
                $query3 = mysql_query("SELECT a.*,IF(ISNULL(b.team_name),'TBD',b.team_name) AS team_1,IF(ISNULL(IF(b.logo='','nologo.png',b.logo)),'nologo.png',IF(b.logo='','nologo.png',b.logo)) AS logo_1,IF(ISNULL(c.team_name),'TBD',c.team_name) AS team_2,IF(ISNULL(IF(c.logo='','nologo.png',c.logo)),'nologo.png',IF(c.logo='','nologo.png',c.logo)) AS logo_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.match_id=".$row1['match_id']) or die(mysql_error());
                $row2 = mysql_fetch_array($query3);

                if($row2['status_1']=='' || $row2['status_2']==''){
                $record_flag = 1;
                if(mysql_num_rows($query2) > 0 && $sports_flag == 0){
                    $sports_flag = 1;
                    echo '<span id="headline" style="font-size:35px">'.$row['sports_name'].'</span>';
                    echo '<p style="margin-top:-5px;font-weight:bold;font-size:22px"><img src="img/calendar.png" width="12px" height="15px"/>&nbsp;'.date_format(date_create($start_date), "F d, Y").'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/location.png" width="12px" height="15px"/>&nbsp;'.$row["venue_name"].'</p>';
                }
                // echo '<p style="font-weight:bold;font-size:16px">'.date_format(date_create($row1['start_time']), "g:i A").' - '.date_format(date_create($row1['end_time']), "g:i A").'</p>';
                echo '<p style="font-weight:bold;font-size:22px">'.date_format(date_create($row1['start_time']), "g:i A").'</p>';
                echo '<h2 style="font-size:35px"><img src="img/'.$row2['logo_1'].'" width="24px" height="27px"/>&nbsp;'.$row2['team_1'].'&nbsp;&nbsp;v.s.&nbsp;&nbsp;<img src="img/'.$row2['logo_2'].'" width="24px" height="27px"/>&nbsp;'.$row2['team_2'].'</h2>';
                }
            }
        }
        if(mysql_num_rows($query2) > 0){
            echo '--------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br/>';
        }
        $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
    }
    if($record_flag==0){
        echo "<span id='headline' style='font-size:25px'>No scheduled games for the date(s) that you've chosen!</span>";
    }
?>
</section>