<?php
    include_once('session/dbconnect.php');

    session_start();

    date_default_timezone_set("Asia/Manila");
	$date1 = date("m/d/Y");
	$datetime1 = date("Y-m-d h:i:sa");

    if(isset($_GET['save_tournament'])){
        $query = mysql_query("SELECT * FROM tournament_sports WHERE tournament_id=".$_POST['tid']." AND sports_id=".$_POST['sport']."") or die(mysql_error());
        if(mysql_num_rows($query) > 0)
        {
            echo 'exist';
            die();
        }

        // $query = mysql_query("SELECT * FROM tournament_sports WHERE tournament_id=".$_POST['tid']." AND venue_id=".$_POST['venue']."") or die(mysql_error());
        // if(mysql_num_rows($query) > 0)
        // {
        //     echo 'venue-exist';
        //     die();
        // }

        $query = "INSERT INTO tournament_sports VALUES(null,".$_POST['tid'].",".$_POST['sport'].",'".$_POST['desc']."','".$_POST['manager']."',".$_POST['venue'].",'".$_POST['type']."',".$_POST['count'].",'".$date1."')";
            mysql_query($query,$conn) or die(mysql_error());

        $data = json_decode(stripslashes($_POST['team']));

        $data2 = json_decode(stripslashes($_POST['team']));

        $query1 = mysql_query("SELECT MAX(tour_sports_id) AS last_id FROM tournament_sports") or die(mysql_error());
        $result = mysql_fetch_array($query1);

        foreach($data as $d){
            $query2 = "INSERT INTO tournament_team VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$d.")";
            mysql_query($query2,$conn) or die(mysql_error());
        }

        $sql = "CREATE TABLE match_temp (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, tournament_id INT(11), tour_sports_id INT(11), team_id_1 INT(11), team_id_2 INT(11))";
        mysql_query($sql,$conn) or die(mysql_error());

        foreach($data as $i){
            $team1 = $i;
            foreach($data2 as $x){
                if($team1!=$x){
                    $team2 = $x;
                    $query3 = mysql_query("SELECT * FROM match_temp WHERE (tournament_id=".$result['last_id']." AND tour_sports_id=".$_POST['tid']." AND team_id_1 = ".$team1." AND team_id_2 = ".$team2.") OR (tournament_id=".$result['last_id']." AND tour_sports_id=".$_POST['tid']." AND team_id_1 = ".$team2." AND team_id_2 = ".$team1.")") or die(mysql_error());
                    if(mysql_num_rows($query3) < 1)
                    {
                        $query4 = "INSERT INTO match_temp VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",".$team2.")";
                        mysql_query($query4,$conn) or die(mysql_error());
                    }
                }
            }
        }

        $cnt = 1;
        $query5 = mysql_query("SELECT * FROM match_temp ORDER BY rand()") or die(mysql_error());
        while($row5 = mysql_fetch_array($query5))
        {
            $query6 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$row5['team_id_1'].",'',".$row5['team_id_2'].",'',".$cnt.")";
            mysql_query($query6,$conn) or die(mysql_error());
            $cnt++;
        }

        $sql2 = "DROP TABLE match_temp";
        mysql_query($sql2,$conn) or die(mysql_error());
    }
?>