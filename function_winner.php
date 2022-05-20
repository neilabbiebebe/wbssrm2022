<?php
    include('session/dbconnect.php');

    session_start();

    date_default_timezone_set("Asia/Manila");
	$date1 = date("m/d/Y");
    $date2 = date("Y-m-d");
	$datetime1 = date("Y-m-d h:i:sa");
    $time1 = date("h:i A");

    if(isset($_GET['winner_losser'])){
        $query4 = mysql_query("SELECT * FROM tournament_schedule WHERE match_id=".$_POST['ids']."") or die(mysql_error());
        $row3 = mysql_fetch_array($query4);

        if(strtotime($date2) < strtotime($row3['sched_date'])){
            echo 'invalid';
            die();
        }else{
            if(strtotime($time1) < strtotime($row3['start_time']) && strtotime($date2) == strtotime($row3['sched_date'])){
                echo 'invalid';
                die();
            }
        }

        $query = mysql_query("SELECT * FROM tournament_sports WHERE tour_sports_id=".$_POST['ids2']."") or die(mysql_error());
        $row = mysql_fetch_array($query);

        $query1 = mysql_query("SELECT * FROM tournament_match WHERE match_id=".$_POST['ids']."") or die(mysql_error());
        $row1 = mysql_fetch_array($query1);

        if($row['tournament_type']=='Single Elimination'){
            if($row1['team_id_1']==$_POST['winner']){
                $query2 = "UPDATE tournament_match SET status_1='winner', status_2='losser' WHERE match_id=".$_POST['ids'];
                mysql_query($query2,$conn) or die(mysql_error());
            }
            else{
                $query2 = "UPDATE tournament_match SET status_2='winner', status_1='losser' WHERE match_id=".$_POST['ids'];
                mysql_query($query2,$conn) or die(mysql_error());
            }
            
            if($row['no_of_teams']==3){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=2") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=2";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=2";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==4){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==5){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==6){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==7){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==8){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==9){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==10){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==11){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                if($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==12){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                if($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                if($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==13){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==14){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==15){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==16){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
        }
        elseif($row['tournament_type']=='Double Elimination'){
            $losser = 0;
            if($row1['team_id_1']==$_POST['winner']){
                $query2 = "UPDATE tournament_match SET status_1='winner', status_2='losser' WHERE match_id=".$_POST['ids'];
                mysql_query($query2,$conn) or die(mysql_error());
                $losser = $row1['team_id_2'];
            }
            else{
                $query2 = "UPDATE tournament_match SET status_2='winner', status_1='losser' WHERE match_id=".$_POST['ids'];
                mysql_query($query2,$conn) or die(mysql_error());
                $losser = $row1['team_id_1'];
            }

            if($row['no_of_teams']==3){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=2") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=2";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=2";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==4){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==5){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==6){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=3";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==7){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=4";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==8){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());


                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==9){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==10){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==16){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==17){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==11){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==16){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==17){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==18){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==19){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==12){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=5";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==16){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==17){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==18){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==19){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==20){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==21){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==13){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=6";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==16){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==17){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==18){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==19){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==20){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==21){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==22){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==23){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==14){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=7";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==16){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==17){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==18){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==19){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==20){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==21){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==22){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==23){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==24){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==25){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==15){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=8";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==16){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==17){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==18){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==19){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==20){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==21){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==22){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==23){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==24){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==25){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==26){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==27){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
            elseif($row['no_of_teams']==16){
                if($row1['bracket_no']==1){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==2){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=13";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=9";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==3){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==4){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=14";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=10";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==5){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==6){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=15";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=11";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==7){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==8){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=16";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_2=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=12";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==9){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==10){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==11){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==12){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==13){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=17";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==14){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=23";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=18";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==15){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=19";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==16){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=24";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=20";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==17){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==18){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=21";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==19){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==20){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=22";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==21){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==22){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==23){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=25";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==24){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=28";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=26";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_1']!=0){
                        if($_POST['winner']!=$row2['team_id_1']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_1=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==25){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==26){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=27";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==27){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }

                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($row2['team_id_2']!=0){
                        if($_POST['winner']!=$row2['team_id_2']){
                            if($row2['status_1']!='' || $row2['status_2']!=''){
                                $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                                mysql_query($query2,$conn) or die(mysql_error());
                            }
                            
                            $query2 = "UPDATE tournament_match SET team_id_2=0 WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                    }
                }
                elseif($row1['bracket_no']==28){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_1']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_1=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                        mysql_query($query2,$conn) or die(mysql_error());

                        $query2 = "UPDATE tournament_match SET team_id_1=".$losser." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=29";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
                elseif($row1['bracket_no']==29){
                    $query3 = mysql_query("SELECT * FROM tournament_match WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30") or die(mysql_error());
                    $row2 = mysql_fetch_array($query3);

                    if($_POST['winner']!=$row2['team_id_2']){
                        if($row2['status_1']!='' || $row2['status_2']!=''){
                            $query2 = "UPDATE tournament_match SET status_1='',status_2='' WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                            mysql_query($query2,$conn) or die(mysql_error());
                        }
                        
                        $query2 = "UPDATE tournament_match SET team_id_2=".$_POST['winner']." WHERE tour_sports_id=".$_POST['ids2']." AND bracket_no=30";
                        mysql_query($query2,$conn) or die(mysql_error());
                    }
                }
            }
        }
        elseif($row['tournament_type']=='Round Robin'){
            if($row1['team_id_1']==$_POST['winner']){
                $query2 = "UPDATE tournament_match SET status_1='winner', status_2='losser' WHERE match_id=".$_POST['ids'];
                mysql_query($query2,$conn) or die(mysql_error());
            }
            else{
                $query2 = "UPDATE tournament_match SET status_2='winner', status_1='losser' WHERE match_id=".$_POST['ids'];
                mysql_query($query2,$conn) or die(mysql_error());
            }
        }
    }
?>