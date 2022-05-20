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
    <h1 class="h3 mb-0 text-gray-800">Tournament Participants<br/><a href="tournament_sports?tour_id=<?php echo $tour_id; ?>"><button class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back</button></a></h1>
    
    <!-- <ol class="breadcrumb"> -->
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addTournamentModal" data-backdrop="static" onclick=addtournament()><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Tournament</button> -->
    <!-- </ol> -->
    
</div>
<div class="row">
    <div class="col-lg-12">
        <label style="font-size: 18px;margin-right:50px"><b>Tournament: </b><?php echo $result['tournament_name']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Event: </b><?php echo $result1['sports_name']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Type: </b><?php echo $result1['tournament_type']; ?></label>
        <br/>
        <label style="font-size: 18px;margin-right:50px"><b>Manager: </b><?php echo $result1['manager']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Venue: </b><?php echo $result1['venue_name']; ?></label>
        <button title="Modify" data-toggle="modal" data-target="#editEventModal" class="btn btn-success btn-sm" onclick=editevent(<?php echo $tour_sports_id; ?>)><i class="fa fa-edit"></i></button>
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTable">
            <thead class="thead-light">
                <tr style="text-align:center">
                <th>Participant</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT a.*,b.team_name FROM tournament_team a INNER JOIN team b ON a.team_id=b.team_id WHERE tour_sports_id=".$tour_sports_id." AND a.tournament_id=".$tour_id) or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['team_name']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editParticipantModal" onclick=editparticipant(<?php echo $tour_id; ?>,<?php echo $row['team_id']; ?>,<?php echo $tour_sports_id; ?>)><i class="fa fa-pen"></i>  Modify</button>
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

<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleeditEventModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleeditEventModal">Modify Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_event">
                <div id="edit_event"></div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editParticipantModal" tabindex="-1" role="dialog" aria-labelledby="exampleeditParticipantModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleeditParticipantModal">Modify Participant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_participant">
                <div id="edit_participant"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
  include('footer.php');
?>