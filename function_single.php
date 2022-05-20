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

        $query1 = mysql_query("SELECT MAX(tour_sports_id) AS last_id FROM tournament_sports") or die(mysql_error());
        $result = mysql_fetch_array($query1);

        foreach($data as $d){
            $query2 = "INSERT INTO tournament_team VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$d.")";
            mysql_query($query2,$conn) or die(mysql_error());
        }

        shuffle($data);
        
        if($_POST['count']==2){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==3){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',0,'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==4){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==5){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',0,'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==6){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',0,'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==6){
                    $team6 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team6.",'',0,'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==7){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',0,'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==8){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==9){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',0,'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==10){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',0,'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==10){
                    $team10 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team10.",'',0,'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',9)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==11){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',0,'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==10){
                    $team10 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team10.",'',0,'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==11){
                    $team11 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team11.",'',0,'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',9)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',10)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==12){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',0,'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==10){
                    $team10 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team10.",'',0,'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==11){
                    $team11 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team11.",'',0,'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==12){
                    $team12 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team12.",'',0,'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',9)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',10)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',11)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==13){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;
                }
                elseif($count==10){
                    $team10 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',".$team10.",'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==11){
                    $team11 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team11.",'',0,'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==12){
                    $team12 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team12.",'',0,'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==13){
                    $team13 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team13.",'',0,'',9)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',10)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',11)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',12)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==14){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;
                }
                elseif($count==10){
                    $team10 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',".$team10.",'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==11){
                    $team11 = $t;
                }
                elseif($count==12){
                    $team12 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team11.",'',".$team12.",'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==13){
                    $team13 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team13.",'',0,'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==14){
                    $team14 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team14.",'',0,'',9)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',10)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',11)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',12)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',13)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==15){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;
                }
                elseif($count==10){
                    $team10 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',".$team10.",'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==11){
                    $team11 = $t;
                }
                elseif($count==12){
                    $team12 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team11.",'',".$team12.",'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==13){
                    $team13 = $t;
                }
                elseif($count==14){
                    $team14 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team13.",'',".$team14.",'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==15){
                    $team15 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team15.",'',0,'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',9)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',10)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',11)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',12)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',13)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',14)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
        elseif($_POST['count']==16){
            $count = 1;
            foreach($data as $t){
                if($count==1){
                    $team1 = $t;
                }
                elseif($count==2){
                    $team2 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team1.",'',".$team2.",'',1)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==3){
                    $team3 = $t;
                }
                elseif($count==4){
                    $team4 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team3.",'',".$team4.",'',2)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==5){
                    $team5 = $t;
                }
                elseif($count==6){
                    $team6 = $t;
                    
                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team5.",'',".$team6.",'',3)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==7){
                    $team7 = $t;
                }
                elseif($count==8){
                    $team8 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team7.",'',".$team8.",'',4)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==9){
                    $team9 = $t;
                }
                elseif($count==10){
                    $team10 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team9.",'',".$team10.",'',5)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==11){
                    $team11 = $t;
                }
                elseif($count==12){
                    $team12 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team11.",'',".$team12.",'',6)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==13){
                    $team13 = $t;
                }
                elseif($count==14){
                    $team14 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team13.",'',".$team14.",'',7)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                elseif($count==15){
                    $team15 = $t;
                }
                elseif($count==16){
                    $team16 = $t;

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",".$team15.",'',".$team16.",'',8)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',9)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',10)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',11)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',12)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',13)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',14)";
                    mysql_query($query3,$conn) or die(mysql_error());

                    $query3 = "INSERT INTO tournament_match VALUES(null,".$_POST['tid'].",".$result['last_id'].",0,'',0,'',15)";
                    mysql_query($query3,$conn) or die(mysql_error());
                }
                $count++;
            }
        }
    }
?>