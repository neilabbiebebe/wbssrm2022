<?php
  $menu="utilities";
  $submenu="tournament";
  include('header.php');
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tournament</h1>
    <!-- <ol class="breadcrumb"> -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addTournamentModal" data-backdrop="static" onclick=addtournament()><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Tournament</button>
    <!-- </ol> -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTable">
            <thead class="thead-light">
                <tr style="text-align:center">
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Organizer</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT * FROM tournament") or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['tournament_name']; ?></td>
                            <td><?php echo date_format(date_create($row['start_date']), "F d, Y"); ?></td>
                            <td><?php echo date_format(date_create($row['end_date']), "F d, Y"); ?></td>
                            <td><?php echo $row['organizer']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editTournamentModal" onclick=edittournament(<?php echo $row['tournament_id']; ?>)><i class="fa fa-pen"></i>  Modify</button>
                                <a href="tournament_sports?tour_id=<?php echo $row['tournament_id']; ?>"><button class="btn btn-info btn-sm"><i class="fa fa-book"></i>  Events</button></a>
                                <button class="btn btn-danger btn-sm" onclick=deletetournament(<?php echo $row['tournament_id']; ?>)><i class="fa fa-trash"></i>  Delete</button>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#schedulesModal" onclick=schedule(<?php echo $row['tournament_id']; ?>)><i class="fa fa-clock"></i> Schedules</button>
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

<div class="modal fade" id="addTournamentModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddTournamentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddTournamentModal">Add Tournament</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="add_tournament">
                <div id="add_tournament"></div>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTournamentModal" tabindex="-1" role="dialog" aria-labelledby="exampleeditTournamentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleeditTournamentModal">Modify Tournament</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_tournament">
                <div id="edit_tournament"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
  include('footer.php');
?>