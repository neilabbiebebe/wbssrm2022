<?php
  $menu="masterfile";
  $submenu="user";
  include_once('header.php');
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
    <!-- <ol class="breadcrumb"> -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal" onclick=adduser()><i class="fa fa-user"></i>&nbsp;&nbsp;Add User</button>
    <!-- </ol> -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTable">
            <thead class="thead-light">
                <tr style="text-align:center">
                <th>Full Name</th>
                <th>Username</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once('session/dbconnect.php');

                    $query = mysql_query("SELECT * FROM users") or die(mysql_error());
                    while($row = mysql_fetch_array($query))
                    {
                    ?>  <tr style="text-align:center">
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <?php if($row['user_id']!=$_SESSION['SESS_ID']){ ?>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editUserModal" onclick=edituser(<?php echo $row['user_id']; ?>,<?php echo $_SESSION['SESS_ID']; ?>)><i class="fa fa-pen"></i>  Modify</button>
                                <button class="btn btn-danger btn-sm" onclick=deleteuser(<?php echo $row['user_id']; ?>,<?php echo $_SESSION['SESS_ID']; ?>)><i class="fa fa-trash"></i>  Delete</button>
                                <button class="btn btn-warning btn-sm" onclick=resetpassword(<?php echo $row['user_id']; ?>,<?php echo $_SESSION['SESS_ID']; ?>)><i class="fa fa-recycle"></i>  Reset</button>
                                <?php } ?>
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

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleaddUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleaddUserModal">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="add_user">
                <div id="add_user"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleeditUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleeditUserModal">Modify User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_user">
                <div id="edit_user"></div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
  include_once('footer.php');
?>