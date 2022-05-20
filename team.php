<?php
  $menu="masterfile";
  $submenu="team";
  include('header.php');
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Participant</h1>
    <!-- <ol class="breadcrumb"> -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addTeamModal" onclick=addteam()><i class="fa fa-circle"></i>&nbsp;&nbsp;Add Participant</button>
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
                <th>Acronym</th>
                <th>In-Charge</th>
                <th>Contact No.</th>
                <th>Logo</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT * FROM team") or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['team_name']; ?></td>
                            <td><?php echo $row['team_acro']; ?></td>
                            <td><?php echo $row['team_coach']; ?></td>
                            <td><?php echo $row['coach_contact']; ?></td>
                            <td><?php if($row['logo']==''){echo '<img src="img/nologo.png" heigh="25px" width="25px"/>';}else{echo '<img src="img/'.$row['logo'].'" heigh="25px" width="25px"/>';} ?></td>
                            <td>
                                <a href="team-sports.php?team_id=<?php echo $row['team_id']; ?>"><button class="btn btn-info btn-sm"><i class="fa fa-book"></i>  Coach</button></a>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editTeamModal" onclick=editteam(<?php echo $row['team_id']; ?>)><i class="fa fa-pen"></i>  Modify</button>
                                <button class="btn btn-danger btn-sm" onclick=deleteteam(<?php echo $row['team_id']; ?>)><i class="fa fa-trash"></i>  Delete</button>
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

<div class="modal fade" id="addTeamModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddTeamModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddTeamModal">Add Participant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="add_team">
                <div id="add_team"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddTeamModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddTeamModal">Modify Participant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_team">
                <div id="edit_team"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
  include('footer.php');
?>