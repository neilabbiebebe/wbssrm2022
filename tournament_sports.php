<?php
  $menu="utilities";
  $submenu="tournament";
  include('header.php');

  $tour_id = $_GET['tour_id'];

  $query2 = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$tour_id) or die(mysql_error());
  $result = mysql_fetch_array($query2);
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tournament Events<br/><a href="tournament"><button class="btn btn-info"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back</button></a></h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addEventModal" data-backdrop="static" onclick=addevent(<?php echo $tour_id; ?>)><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Event</button>
    <!-- <ol class="breadcrumb"> -->
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addTournamentModal" data-backdrop="static" onclick=addtournament()><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Tournament</button> -->
    <!-- </ol> -->
    
</div>
<div class="row">
    <div class="col-lg-12">
        <label style="font-size: 18px;margin-right:50px"><b>Tournament Name: </b><?php echo $result['tournament_name']; ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Duration: </b><?php echo date_format(date_create($result['start_date']), "F d, Y"); ?> - <?php echo date_format(date_create($result['end_date']), "F d, Y"); ?></label>
        <label style="font-size: 18px;margin-right:50px"><b>Organizer: </b><?php echo $result['organizer']; ?></label>
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTable">
            <thead class="thead-light">
                <tr style="text-align:center">
                <th>Event</th>
                <th>Manager</th>
                <th>Venue</th>
                <th>Type</th>
                <th>Max # of Part.</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT a.*,b.sports_name,c.venue_name FROM tournament_sports a INNER JOIN sports b ON a.sports_id=b.sports_id INNER JOIN venue c ON a.venue_id=c.venue_id WHERE a.tournament_id=".$tour_id) or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                        if($row['tournament_type']=="Single Elimination"){$ttype='single';}elseif($row['tournament_type']=='Double Elimination'){$ttype='double';}else{$ttype='round';}
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['sports_name']; ?></td>
                            <td><?php echo $row['manager']; ?></td>
                            <td><?php echo $row['venue_name']; ?></td>
                            <td><?php echo $row['tournament_type']; ?></td>
                            <td><?php echo $row['no_of_teams']; ?></td>
                            <td>
                                <a href="tournament_teams?tour_id=<?php echo $tour_id; ?>&tour_sports_id=<?php echo $row['tour_sports_id']; ?>"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editParticipantModal" onclick=editparticipant(<?php echo $tour_id; ?>,<?php echo $row['tour_sports_id']; ?>)><i class="fa fa-pen"></i>  Modify</button></a>
                                <a href="tournament_match?tour_id=<?php echo $tour_id; ?>&tour_sports_id=<?php echo $row['tour_sports_id']; ?>"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editParticipantModal" onclick=editparticipant(<?php echo $tour_id; ?>,<?php echo $row['tour_sports_id']; ?>)><i class="fa fa-cubes"></i>  Matches</button></a>
                                <button class="btn btn-warning btn-sm" onclick=viewbracket(<?php echo $tour_id; ?>,<?php echo $row['tour_sports_id']; ?>,"<?php echo $ttype; ?>",<?php echo $row['no_of_teams']; ?>)><i class="fa fa-eye"></i>  Bracket</button>
                                <button class="btn btn-danger btn-sm" onclick=deleteevent(<?php echo $row['tour_sports_id']; ?>)><i class="fa fa-trash"></i>  Delete</button>
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
<?php
  include('footer.php');
?>

<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddEventModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddEventModal">Add Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="add_event">
                <div id="add_event"></div>
            </form>
        </div>
        </div>
    </div>
</div>