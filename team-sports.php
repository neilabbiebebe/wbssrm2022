<?php
  $menu="masterfile";
  $submenu="team";
  include('header.php');

  $team_id = $_GET['team_id'];

  $query2 = mysql_query("SELECT * FROM team WHERE team_id=".$team_id) or die(mysql_error());
  $result = mysql_fetch_array($query2);
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Participant Events<br/><a href="team.php"><button class="btn btn-info"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back</button></a></h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addTeamEventModal" data-backdrop="static" onclick=addteamevent(<?php echo $team_id; ?>)><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Coach</button>
    <!-- <ol class="breadcrumb"> -->
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addTournamentModal" data-backdrop="static" onclick=addtournament()><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Tournament</button> -->
    <!-- </ol> -->
    
</div>
<div class="row">
    <div class="col-lg-12">
        <label style="font-size: 18px;margin-right:50px"><b>Participant Name: </b><?php echo $result['team_name']; ?></label>
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTable">
            <thead class="thead-light">
                <tr style="text-align:center">
                <th>Event</th>
                <th>Coach</th>
                <th>Contact No.</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT a.*,b.sports_name,c.team_name FROM team_sports a INNER JOIN sports b ON a.sports_id=b.sports_id INNER JOIN team c ON a.team_id=c.team_id WHERE a.team_id=".$team_id) or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['sports_name']; ?></td>
                            <td><?php echo $row['coach_name']; ?></td>
                            <td><?php echo $row['contact_no']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editTeamEventModal" onclick=editteamsport(<?php echo $row['team_sports_id']; ?>)><i class="fa fa-pen"></i>  Modify</button>
                                <button class="btn btn-danger btn-sm" onclick=deleteteamevent(<?php echo $row['team_sports_id']; ?>)><i class="fa fa-trash"></i>  Delete</button>
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

<div class="modal fade" id="addTeamEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddTeamEventModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddTeamEventModal">Add Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="add_team_event">
                <div id="add_team_event"></div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTeamEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleeditTeamEventModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleeditTeamEventModal">Modify Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_team_event">
                <div id="edit_team_event"></div>
            </form>
        </div>
        </div>
    </div>
</div>