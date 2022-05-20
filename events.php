<?php
  $menu="masterfile";
  $submenu="events";
  include('header.php');
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Events</h1>
    <!-- <ol class="breadcrumb"> -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addEventsModal" onclick=addevents()><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Event</button>
    <!-- </ol> -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTable">
            <thead class="thead-light">
                <tr style="text-align:center">
                <th>Event Name</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT * FROM events") or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['events_name']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editEventsModal" onclick=editevents(<?php echo $row['events_id']; ?>)><i class="fa fa-pen"></i>  Modify</button>
                                <button class="btn btn-danger btn-sm" onclick=deleteevents(<?php echo $row['events_id']; ?>)><i class="fa fa-trash"></i>  Delete</button>
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

<div class="modal fade" id="addEventsModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddEventsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddEventsModal">Add Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="add_events">
                <div id="add_events"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editEventsModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddEventsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddEventsModal">Modify Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_events">
                <div id="edit_events"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
  include('footer.php');
?>