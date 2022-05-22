<?php
  $menu="utilities";
  $submenu="tournament";
  include('header.php');

  $tour_id = $_GET['tour_id'];
  $tour_sports_id = $_GET['tour_sports_id'];

  $query2 = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$tour_id) or die(mysql_error());
  $result = mysql_fetch_array($query2);

  $query3 = mysql_query("SELECT a.*,b.sports_name,c.venue_name FROM tournament_sports a INNER JOIN sports b ON a.sports_id=b.sports_id INNER JOIN venue c ON a.venue_id=c.venue_id WHERE a.tour_sports_id=".$tour_sports_id) or die(mysql_error());
  $result1 = mysql_fetch_array($query3);
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tournament Matches<br/><a href="tournament_sports?tour_id=<?php echo $tour_id; ?>"><button class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back</button></a></h1>
    
    <!-- <ol class="breadcrumb"> -->
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addTournamentModal" data-backdrop="static" onclick=addtournament()><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Tournament</button> -->
    <!-- </ol> -->
    <button class="btn btn-warning" data-toggle="modal" data-target="#schedulesModal" onclick=schedule(<?php echo $tour_id; ?>)><i class="fa fa-clock"></i> Schedules</button>
</div>
<div class="row">
    <div class="col-lg-12">
    <label style="font-size: 18px;margin-right:50px"><b>Tournament: </b><?php echo $result['tournament_name']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Event: </b><?php echo $result1['sports_name']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Type: </b><?php echo $result1['tournament_type']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Duration: </b><?php echo date_format(date_create($result['start_date']), "F d, Y"); ?> - <?php echo date_format(date_create($result['end_date']), "F d, Y"); ?></label>
        <br/>
        <label style="font-size: 18px;margin-right:50px"><b>Manager: </b><?php echo $result1['manager']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Venue: </b><?php echo $result1['venue_name']; ?></label>
        <!-- <button title="Modify" data-toggle="modal" data-target="#editTournamentModal" class="btn btn-success btn-sm" onclick=edittournament(<?php echo $tour_id; ?>)><i class="fa fa-edit"></i></button> -->
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTable2">
            <thead class="thead-light">
                <tr style="text-align:center">
                <th>Game</th>
                <th>Participant</th>
                <th style="width:10px;text-align:center"></th>
                <th>Participant</th>
                <th>Winner</th>
                <th>Scheduled</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT a.*,IFNULL(b.team_acro,'TBD') AS team_1,IFNULL(c.team_acro,'TBD') AS team_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id) or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                        $query4 = mysql_query("SELECT * FROM tournament_schedule WHERE match_id=".$row['match_id']) or die(mysql_error());
                        $row1 = mysql_num_rows($query4);
                        $row2 = mysql_fetch_array($query4);
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['bracket_no']; ?></td>
                            <td><?php echo $row['team_1']; ?></td>
                            <td style="width:10px;text-align:center">vs</td>
                            <td><?php echo $row['team_2']; ?></td>
                            <td><?php if($row['status_1']=='' && $row['status_2']==''){echo '<span class="badge badge-danger">Pending</span>';}elseif($row['status_1']=='winner'){echo '<span class="badge badge-success" style="font-size:15px">'.$row['team_1'].'</span>';}elseif($row['status_2']=='winner'){echo '<span class="badge badge-success" style="font-size:15px">'.$row['team_2'].'</span>';} ?></td>
                            <td><?php if($row1>0){ echo '<a href="#" data-toggle="modal" data-target="#viewScheduleModal" onclick=viewschedule('.$row2["schedule_id"].')><span class="badge badge-info">View</span></a>&nbsp;<a href="#" data-toggle="modal" data-target="#modifyScheduleModal" onclick=modifyschedule('.$row2["schedule_id"].','.$row['tournament_id'].','.$result1['venue_id'].')><span class="badge badge-success">Modify</span></a>&nbsp;<a href="#" onclick=deletesched('.$row2["schedule_id"].')><span class="badge badge-danger">Delete</span></a>'; }else{ echo '<span class="badge badge-warning">None</span>'; } ?></td>
                            <td>
                                <?php //if($row['team_1']!='TBD' && $row['team_2']!='TBD'){ ?>
                                    <?php if($row1<1){?>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#setScheduleModal" onclick=setschedule(<?php echo $row['match_id']; ?>,<?php echo $row['tour_sports_id']; ?>,<?php echo $row['tournament_id']; ?>,<?php echo $result1['venue_id']; ?>)><i class="fa fa-clock"></i>  Set Schedule</button>
                                    <?php } ?>
                                    <?php if($row1>0){?>
                                        <?php if($row['team_1']!='TBD' && $row['team_2']!='TBD'){ ?>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tagWinnerModal" onclick=tagwinner(<?php echo $row['match_id']; ?>,<?php echo $row['tour_sports_id']; ?>)><i class="fa fa-pen"></i>  Tag Winner</button>
                                <?php }} ?>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="schedulesModal" tabindex="-1" role="dialog" aria-labelledby="exampleschedulesModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleschedulesModal">Schedules</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="schedules">
                <div id="schedules"></div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modifyScheduleModal" tabindex="-1" role="dialog" aria-labelledby="examplemodifyScheduleModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="examplemodifyScheduleModal">Modify Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="modify_schedule">
                <div id="modify_schedule"></div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleviewScheduleModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleviewScheduleModal">Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="view_schedule">
                <div id="view_schedule"></div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="setScheduleModal" tabindex="-1" role="dialog" aria-labelledby="examplesetScheduleModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="examplesetScheduleModal">Set Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="set_schedule">
                <div id="set_schedule"></div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tagWinnerModal" tabindex="-1" role="dialog" aria-labelledby="exampletagWinnerModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampletagWinnerModal">Tag Winner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="tag_winner">
                <div id="tag_winner"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
  include('footer.php');
?>