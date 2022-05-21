<?php
    include_once('session/dbconnect.php');

    session_start();
    $tour = 0;

    date_default_timezone_set("Asia/Manila");
	$date1 = date("m/d/Y");
    $date2 = date("Y-m-d");
	$datetime1 = date("Y-m-d h:i:sa");
    $time1 = date("h:i A");

    if(isset($_GET['login_validate'])){
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        $query = "SELECT * FROM users WHERE username='".$username."' AND password='".md5($password)."'";
        $result=mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result) > 0){
            session_regenerate_id();
            $user = mysql_fetch_array($result);

            if($user['status']=="Active")
            {
                $_SESSION['SESS_ID'] = $user['user_id'];
                $_SESSION['SESS_USERNAME'] = $user['username'];
                $_SESSION['SESS_PASSWORD'] = $user['password'];
                $_SESSION['FULL_NAME'] = $user['full_name'];
                session_write_close();
                echo 'success';
            }
            else
            {
                echo 'inactive';
            }
            
        }else{
            echo 'try';
        }
    }
    elseif(isset($_GET['user_settings'])){
        echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$_POST['ids'].'">
        <input type="hidden" class="form-control" name="password" id="password" autocomplete="off" value="'.$_SESSION['SESS_PASSWORD'].'">
        <input type="hidden" class="form-control" name="uname" id="uname" autocomplete="off" value="'.$_SESSION['SESS_USERNAME'].'">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Full Name</span>
            </div>
            <input type="text" class="form-control" name="fullname" id="fullname" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$_SESSION['FULL_NAME'].'" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Username</span>
            </div>
            <input type="text" class="form-control" name="username" id="username" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" value="'.$_SESSION['SESS_USERNAME'].'" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Current Password</span>
            </div>
            <input type="password" class="form-control" name="current_password" id="current_password" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">New Password</span>
            </div>
            <input type="password" class="form-control" name="new_password" id="new_password" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Confirm Password</span>
            </div>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
    }
    elseif(isset($_GET['change_user_settings'])){
        $query5 = "UPDATE users SET full_name='".$_POST['fullname']."' WHERE user_id=".$_POST['id']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $_SESSION['FULL_NAME'] = $_POST['fullname'];

        if($_POST['uname']!=$_POST['username']){
            $query1 = "SELECT * FROM users WHERE username='".$_POST['username']."' AND user_id!=".$_POST['id']."";
            $result1=mysql_query($query1,$conn) or die(mysql_error());
            if(mysql_num_rows($result1) > 0){
                echo 'exist';
                die();
            }
        }

        if($_POST['current_password']!=""){
            $query2 = "SELECT * FROM users WHERE password='".md5($_POST['current_password'])."' AND user_id=".$_POST['id']."";
            $result2=mysql_query($query2,$conn) or die(mysql_error());
            if(mysql_num_rows($result2) < 1){
                echo 'wrong';
                die();
            }
        }

        if($_POST['uname']!=$_POST['username']){
            $query3 = "UPDATE users SET username='".$_POST['username']."' WHERE user_id=".$_POST['id']."";
            mysql_query($query3,$conn) or die(mysql_error());

            $_SESSION['SESS_USERNAME'] = $_POST['username'];

            echo 'user';
        }
        if($_POST['current_password']!="" && $_POST['new_password']!=""){
            $query4 = "UPDATE users SET password='".md5($_POST['new_password'])."' WHERE user_id=".$_POST['id']."";
            mysql_query($query4,$conn) or die(mysql_error());

            $_SESSION['SESS_PASSWORD'] = md5($_POST['current_password']);

            echo 'pass';
        }
        else{
            echo 'huhuy';
        }
        // echo 'okay';
    }
    elseif(isset($_GET['add_user'])){
        echo '<div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Full Name</span>
            </div>
            <input type="text" class="form-control" name="fullname" id="fullname" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Username</span>
            </div>
            <input style="width:110px" type="text" class="form-control" name="username" id="username" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" >
            <div class="input-group-prepend">
                <span class="input-group-text">Status</span>
            </div>
            <select class="form-control" name="status" id="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Password</span>
            </div>
            <input type="password" class="form-control" name="password" id="password" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Confirm Password</span>
            </div>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    }
    elseif(isset($_GET['insert_user'])){
        $query1 = "SELECT * FROM users WHERE username='".$_POST['username']."'";
        $result1=mysql_query($query1,$conn) or die(mysql_error());
        if(mysql_num_rows($result1) > 0){
            echo 'exist';
        }
        else{
            $query = "INSERT INTO users VALUES(null,'".$_POST['username']."','".md5($_POST['password'])."','".$_POST['fullname']."','".$_POST['status']."','".$date1."')";
            mysql_query($query,$conn) or die(mysql_error());

            echo 'okay';
        }
    }
    elseif(isset($_GET['reset_password'])){
        $default_password = "ssrs2022";
        $query = "UPDATE users SET password='".md5($default_password)."' WHERE user_id=".$_POST['ids']."";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['delete_user'])){
        $query = "DELETE FROM users WHERE user_id=".$_POST['ids']."";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['edit_user'])){
        $query = "SELECT * FROM users WHERE user_id=".$_POST['ids']."";
        $result = mysql_query($query,$conn) or die(mysql_error());
        $row = mysql_fetch_array($result);
        if($row['status']=='Active'){$stat1='selected';}else{$stat1='';}
        if($row['status']=='Inactive'){$stat2='selected';}else{$stat2='';}
        echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$_POST['ids'].'">
        <input type="hidden" class="form-control" name="uname" id="uname" autocomplete="off" value="'.$row['username'].'">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Full Name</span>
            </div>
            <input type="text" class="form-control" name="fullname" id="fullname" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$row['full_name'].'" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Username</span>
            </div>
            <input style="width:110px" type="text" class="form-control" name="username" id="username" value="'.$row['username'].'" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" >
            <div class="input-group-prepend">
                <span class="input-group-text">Status</span>
            </div>
            <select class="form-control" name="status" id="status" value="'.$row['status'].'">
                <option value="Active" '.$stat1.'>Active</option>
                <option value="Inactive" '.$stat2.'>Inactive</option>
            </select>
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
    }
    elseif(isset($_GET['update_user'])){
        $flag = 0;
        if($_POST['uname']!=$_POST['username']){
            $query1 = "SELECT * FROM users WHERE username='".$_POST['username']."' AND user_id!=".$_POST['id']."";
            $result1=mysql_query($query1,$conn) or die(mysql_error());
            if(mysql_num_rows($result1) > 0){
                echo 'exist';
                $flag = 1;
            }
        }
        if($flag==0){
            $query3 = "UPDATE users SET username='".$_POST['username']."' WHERE user_id=".$_POST['id']."";
            mysql_query($query3,$conn) or die(mysql_error());

            echo 'user';
        }

        $query5 = "UPDATE users SET full_name='".$_POST['fullname']."',status='".$_POST['status']."' WHERE user_id=".$_POST['id']."";
        mysql_query($query5,$conn) or die(mysql_error());
    }
    elseif(isset($_GET['add_sports'])){
        echo '<div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Sport Name</span>
            </div>
            <input type="text" class="form-control" name="sportsname" id="sportsname" style="text-transform:uppercase" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" autocomplete="off" >
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    }
    elseif(isset($_GET['insert_sports'])){
        $query1 = "SELECT * FROM sports WHERE sports_name='".strtoupper($_POST['sportsname'])."'";
        $result1=mysql_query($query1,$conn) or die(mysql_error());
        if(mysql_num_rows($result1) > 0){
            echo 'exist';
        }
        else{
            $query = "INSERT INTO sports VALUES(null,'".strtoupper($_POST['sportsname'])."')";
            mysql_query($query,$conn) or die(mysql_error());

            echo 'okay';
        }
    }
    elseif(isset($_GET['edit_sports'])){
        $query = "SELECT * FROM sports WHERE sports_id=".$_POST['ids']."";
        $result = mysql_query($query,$conn) or die(mysql_error());
        $row = mysql_fetch_array($result);
        echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$_POST['ids'].'">
        <input type="hidden" class="form-control" name="sname" id="sname" autocomplete="off" value="'.$row['sports_name'].'">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Sport Name</span>
            </div>
            <input type="text" class="form-control" name="sportsname" id="sportsname" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$row['sports_name'].'" >
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    }
    elseif(isset($_GET['update_sports'])){
        $flag = 0;
        if($_POST['sname']!=$_POST['sportsname']){
            $query1 = "SELECT * FROM sports WHERE sports_name='".strtoupper($_POST['sportsname'])."' AND sports_id!=".$_POST['id']."";
            $result1=mysql_query($query1,$conn) or die(mysql_error());
            if(mysql_num_rows($result1) > 0){
                echo 'exist';
                $flag = 1;
            }
        }
        if($flag==0){
            $query3 = "UPDATE sports SET sports_name='".strtoupper($_POST['sportsname'])."' WHERE sports_id=".$_POST['id']."";
            mysql_query($query3,$conn) or die(mysql_error());

            echo 'sports';
        }
    }
    elseif(isset($_GET['delete_sports'])){
        $query = "DELETE FROM sports WHERE sports_id=".$_POST['ids']."";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    // elseif(isset($_GET['add_events'])){
    //     echo '<div class="input-group mb-3">
    //         <div class="input-group-prepend">
    //             <span class="input-group-text">Event Name</span>
    //         </div>
    //         <input type="text" class="form-control" name="eventsname" id="eventsname" autocomplete="off" required>
    //     </div>
    //     <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
    //     <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    // }
    // elseif(isset($_GET['insert_events'])){
    //     $query1 = "SELECT * FROM events WHERE events_name='".$_POST['eventsname']."'";
    //     $result1=mysql_query($query1,$conn) or die(mysql_error());
    //     if(mysql_num_rows($result1) > 0){
    //         echo 'exist';
    //     }
    //     else{
    //         $query = "INSERT INTO events VALUES(null,'".$_POST['eventsname']."')";
    //         mysql_query($query,$conn) or die(mysql_error());

    //         echo 'okay';
    //     }
    // }
    // elseif(isset($_GET['edit_events'])){
    //     $query = "SELECT * FROM events WHERE events_id=".$_POST['ids']."";
    //     $result = mysql_query($query,$conn) or die(mysql_error());
    //     $row = mysql_fetch_array($result);
    //     echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$_POST['ids'].'">
    //     <input type="hidden" class="form-control" name="ename" id="ename" autocomplete="off" value="'.$row['events_name'].'">
    //     <div class="input-group mb-3">
    //         <div class="input-group-prepend">
    //             <span class="input-group-text">Event Name</span>
    //         </div>
    //         <input type="text" class="form-control" name="eventsname" id="eventsname" autocomplete="off" value="'.$row['events_name'].'" required>
    //     </div>
    //     <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
    //     <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    // }
    // elseif(isset($_GET['update_events'])){
    //     $flag = 0;
    //     if($_POST['ename']!=$_POST['eventsname']){
    //         $query1 = "SELECT * FROM events WHERE events_name='".$_POST['eventsname']."' AND events_id!=".$_POST['id']."";
    //         $result1=mysql_query($query1,$conn) or die(mysql_error());
    //         if(mysql_num_rows($result1) > 0){
    //             echo 'exist';
    //             $flag = 1;
    //         }
    //     }
    //     if($flag==0){
    //         $query3 = "UPDATE events SET events_name='".$_POST['eventsname']."' WHERE events_id=".$_POST['id']."";
    //         mysql_query($query3,$conn) or die(mysql_error());

    //         echo 'sports';
    //     }
    // }
    // elseif(isset($_GET['delete_events'])){
    //     $query = "DELETE FROM events WHERE events_id=".$_POST['ids']."";
    //     mysql_query($query,$conn) or die(mysql_error());

    //     echo 'okay';
    // }
    elseif(isset($_GET['add_venue'])){
        echo '<div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Venue Name</span>
            </div>
            <input type="text" class="form-control" name="venuename" id="venuename" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" autocomplete="off" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Venue Address</span>
            </div>
            <input type="text" class="form-control" name="address" id="address" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" autocomplete="off" >
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    }
    elseif(isset($_GET['insert_venue'])){
        $query1 = "SELECT * FROM venue WHERE venue_name='".strtoupper($_POST['venuename'])."'";
        $result1=mysql_query($query1,$conn) or die(mysql_error());
        if(mysql_num_rows($result1) > 0){
            echo 'exist';
        }
        else{
            $query = "INSERT INTO venue VALUES(null,'".strtoupper($_POST['venuename'])."','".strtoupper($_POST['address'])."')";
            mysql_query($query,$conn) or die(mysql_error());

            echo 'okay';
        }
    }
    elseif(isset($_GET['edit_venue'])){
        $query = "SELECT * FROM venue WHERE venue_id=".$_POST['ids']."";
        $result = mysql_query($query,$conn) or die(mysql_error());
        $row = mysql_fetch_array($result);
        echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$_POST['ids'].'">
        <input type="hidden" class="form-control" name="vname" id="vname" autocomplete="off" value="'.$row['venue_name'].'">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Venue Name</span>
            </div>
            <input type="text" class="form-control" name="venuename" id="venuename" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$row['venue_name'].'" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Venue Address</span>
            </div>
            <input type="text" class="form-control" name="address" id="address" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$row['venue_address'].'" >
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    }
    elseif(isset($_GET['update_venue'])){
        $flag = 0;
        if($_POST['vname']!=$_POST['venuename']){
            $query1 = "SELECT * FROM venue WHERE venue_name='".strtoupper($_POST['venuename'])."' AND venue_id!=".$_POST['id']."";
            $result1=mysql_query($query1,$conn) or die(mysql_error());
            if(mysql_num_rows($result1) > 0){
                echo 'exist';
                $flag = 1;
            }
        }
        if($flag==0){
            $query3 = "UPDATE venue SET venue_name='".strtoupper($_POST['venuename'])."',venue_address='".strtoupper($_POST['address'])."' WHERE venue_id=".$_POST['id']."";
            mysql_query($query3,$conn) or die(mysql_error());

            echo 'venue';
        }
    }
    elseif(isset($_GET['delete_venue'])){
        $query = "DELETE FROM venue WHERE venue_id=".$_POST['ids']."";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['add_team'])){
        echo '<div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" class="form-control" name="teamname" id="teamname" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" autocomplete="off" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Acronym</span>
            </div>
            <input type="text" class="form-control" name="teamacro" id="teamacro" maxlength="25" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" autocomplete="off" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">In-Charge Name</span>
            </div>
            <input type="text" class="form-control" name="coach" id="coach" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">In-Charge Mobile No.</span>
            </div>
            <input type="text" class="form-control" name="coach_contact" id="coach_contact" onkeypress="return event.charCode >= 48 && event.charCode <= 57" autocomplete="off" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Logo</span>
            </div>
            <input type="file" class="form-control" name="logo" id="logo" autocomplete="off">
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    }
    elseif(isset($_GET['insert_team'])){
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['logo']['name']);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(file_exists($target_file) && $_FILES['logo']['name']!=''){
            echo "logo-exist";
        }
        else{
            if($_FILES["logo"]["size"] > 500000){
                echo "toobig";
            }
            else{
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $_FILES['logo']['name']!=''){
                    echo "invalid";
                }
                else{
                    $query1 = "SELECT * FROM team WHERE team_name='".strtoupper($_POST['teamname'])."'";
                    $result1=mysql_query($query1,$conn) or die(mysql_error());
                    if(mysql_num_rows($result1) > 0){
                        echo 'exist';
                    }
                    else{
                        $query = "INSERT INTO team VALUES(null,'".strtoupper($_POST['teamname'])."','".strtoupper($_POST['teamacro'])."','".$_POST['coach']."','".$_POST['coach_contact']."','".$_FILES['logo']['name']."')";
                        mysql_query($query,$conn) or die(mysql_error());

                        move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);

                        echo 'okay';
                    }
                }
            }
        }
    }
    elseif(isset($_GET['edit_team'])){
        $query = "SELECT * FROM team WHERE team_id=".$_POST['ids']."";
        $result = mysql_query($query,$conn) or die(mysql_error());
        $row = mysql_fetch_array($result);
        echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$_POST['ids'].'">
        <input type="hidden" class="form-control" name="tname" id="tname" autocomplete="off" value="'.$row['team_name'].'">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" class="form-control" name="teamname" id="teamname" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$row['team_name'].'">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Acronym</span>
            </div>
            <input type="text" class="form-control" name="teamacro" id="teamacro" autocomplete="off" maxlength="25" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$row['team_acro'].'">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">In-Charge Name</span>
            </div>
            <input type="text" class="form-control" name="coach" id="coach" autocomplete="off" value="'.$row['team_coach'].'" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">In-Charge Mobile No.</span>
            </div>
            <input type="text" class="form-control" name="coach_contact" id="coach_contact" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="'.$row['coach_contact'].'" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Logo</span>
            </div>
            <input type="file" class="form-control" name="logo" id="logo" autocomplete="off">
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save </button>';
    }
    elseif(isset($_GET['update_team'])){
        $logo_flag = 0;
        $logo_empty = 0;
        $query5 = "SELECT * FROM team WHERE team_id=".$_POST['id']."";
        $row2 = mysql_query($query5,$conn) or die(mysql_error());
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['logo']['name']);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(basename($_FILES['logo']['name'])!=""){
            $logo_empty = 1;
        }
        if($row2['logo']!=basename($_FILES['logo']['name'])){
            $logo_flag = 1;
        }
        if(file_exists($target_file) && $logo_flag==1 && $logo_empty==1){
            echo "logo-exist";
        }
        else{
            if($_FILES["logo"]["size"] > 500000 && $logo_empty==1){
                echo "toobig";
            }
            else{
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $logo_empty==1){
                    echo "invalid";
                }
                else{
                    $flag = 0;
                    if($_POST['tname']!=$_POST['teamname']){
                        $query1 = "SELECT * FROM team WHERE team_name='".strtoupper($_POST['teamname'])."' AND team_id!=".$_POST['id']."";
                        $result1=mysql_query($query1,$conn) or die(mysql_error());
                        if(mysql_num_rows($result1) > 0){
                            echo 'exist';
                            $flag = 1;
                        }
                    }
                    if($flag==0){
                        if($logo_empty==1){
                            $query3 = "UPDATE team SET team_name='".strtoupper($_POST['teamname'])."',team_acro='".strtoupper($_POST['teamacro'])."',team_coach='".$_POST['coach']."',coach_contact='".$_POST['coach_contact']."',logo='".$_FILES['logo']['name']."' WHERE team_id=".$_POST['id']."";
                        }else{
                            $query3 = "UPDATE team SET team_name='".strtoupper($_POST['teamname'])."',team_acro='".strtoupper($_POST['teamacro'])."',team_coach='".$_POST['coach']."',coach_contact='".$_POST['coach_contact']."' WHERE team_id=".$_POST['id']."";
                        }
                        
                        mysql_query($query3,$conn) or die(mysql_error());

                        move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);

                        echo 'team';
                    }
                }
            }
        }
    }
    elseif(isset($_GET['delete_team'])){
        $query1 = "SELECT * FROM team WHERE team_id=".$_POST['ids']."";
        $result = mysql_query($query1,$conn) or die(mysql_error());
        $row = mysql_fetch_array($result);

        $query = "DELETE FROM team WHERE team_id=".$_POST['ids']."";
        mysql_query($query,$conn) or die(mysql_error());

        unlink('img/'.$row['logo']);

        echo 'okay';
    }
    elseif(isset($_GET['add_tournament'])){
        $tour = 1;
        echo '<div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" class="form-control" name="tname" id="tname" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
        </div>
        <div class="form-group" id="simple-date4">
            <label for="dateRangePicker">Tournament Duration</label>
            <div class="input-daterange input-group">
                <input type="text" class="input-sm form-control" name="start" id="start" readonly required/>
                <div class="input-group-prepend">
                <span class="input-group-text">to</span>
                </div>
                <input type="text" class="input-sm form-control" name="end" id="end" readonly required/>
            </div>
        </div>
        <label for="dateRangePicker">Description<i style="font-size:12px">(optional)</i></label>
        <textarea class="form-control" name="description" id="description" rows="3" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)"></textarea><br/>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Organizer</span>
            </div>
            <input type="text" class="form-control" name="organizer" id="organizer" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
        </div>';
        echo '<button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submittournament()> Save </button>';
    }
    elseif(isset($_GET['save_tournament'])){
        $query1 = "SELECT * FROM tournament WHERE tournament_name='".strtoupper($_POST['tname'])."' AND start_date='".$_POST['tstart']."' AND end_date='".$_POST['tend']."'";
        $result1=mysql_query($query1,$conn) or die(mysql_error());
        if(mysql_num_rows($result1) > 0){
            echo 'exist';
        }
        else{
            $query = "INSERT INTO tournament VALUES(null,'".strtoupper($_POST['tname'])."','".$_POST['tstart']."','".$_POST['tend']."','".$_POST['desc']."','".strtoupper($_POST['organizer'])."','".$date1."')";
            mysql_query($query,$conn) or die(mysql_error());

            echo 'okay';
        }
    }
    elseif(isset($_GET['add_team_event'])){
        $tour = 1;
        echo '<input type="hidden" class="form-control" name="pid" id="pid" autocomplete="off" value="'.$_GET['add_team_event'].'">';
        echo '<label for="sport" style="margin-right:18px">Sport</label>
        <select class="select-sport form-control" style="width:70%" name="sport" id="sport" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT * FROM sports ORDER BY sports_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                echo '<option value="'.$row['sports_id'].'">'.$row['sports_name'].'</option>';
            }
        echo '</select><br/><br/>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Coach</span>
            </div>
            <input type="text" class="form-control" name="coach_name" id="coach_name" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Mobile No.</span>
            </div>
            <input type="text" class="form-control" name="contact_no" id="contact_no" onkeypress="return event.charCode >= 48 && event.charCode <= 57" autocomplete="off" required>
        </div>';
        echo '<button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submitteamevent()> Save </button>';
    }
    elseif(isset($_GET['save_team_sports'])){
        $query = mysql_query("SELECT * FROM team_sports WHERE team_id=".$_POST['team_id']." AND sports_id=".$_POST['sport']."") or die(mysql_error());
        if(mysql_num_rows($query) > 0){
            echo 'exist';
            die();
        }

        $query = "INSERT INTO team_sports VALUES(null,".$_POST['team_id'].",".$_POST['sport'].",'".$_POST['coach']."','".$_POST['contact_no']."')";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['edit_team_sport'])){
        $query = mysql_query("SELECT * FROM team_sports WHERE team_sports_id=".$_POST['ids']."") or die(mysql_error());
        $result3 = mysql_fetch_array($query);
        $tour = 1;
        echo '<input type="hidden" class="form-control" name="pid" id="pid" autocomplete="off" value="'.$result3['team_id'].'">';
        echo '<input type="hidden" class="form-control" name="psid" id="psid" autocomplete="off" value="'.$_POST['ids'].'">';
        echo '<input type="hidden" class="form-control" name="sid" id="sid" autocomplete="off" value="'.$result3['sports_id'].'">';
        echo '<label for="sport" style="margin-right:18px">Sport</label>
        <select class="select-sport form-control" style="width:70%" name="sport" id="sport" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT * FROM sports ORDER BY sports_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                if($row['sports_id']==$result3['sports_id']){$selected='selected';}else{$selected='';}
                echo '<option value="'.$row['sports_id'].'" '.$selected.'>'.$row['sports_name'].'</option>';
            }
        echo '</select><br/><br/>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Coach</span>
            </div>
            <input type="text" class="form-control" name="coach_name" id="coach_name" autocomplete="off" value="'.$result3['coach_name'].'" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Mobile No.</span>
            </div>
            <input type="text" class="form-control" name="contact_no" id="contact_no" autocomplete="off" value="'.$result3['contact_no'].'" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
        </div>';
        echo '<button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submiteditteamevent()> Save </button>';
    }
    elseif(isset($_GET['update_team_sports'])){
        if($_POST['sport']!=$_POST['s_id']){
            $query = mysql_query("SELECT * FROM team_sports WHERE team_id=".$_POST['team_id']." AND sports_id=".$_POST['sport']."") or die(mysql_error());
            if(mysql_num_rows($query) > 0){
                echo 'exist';
                die();
            }
        }

        $query = "UPDATE team_sports SET sports_id=".$_POST['sport'].",coach_name='".$_POST['coach']."',contact_no='".$_POST['contact_no']."' WHERE team_sports_id=".$_POST['ps_id']."";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['add_event'])){
        $tour = 1;
        echo '<input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$_GET['add_event'].'">
        <div class="row">
        <div class="col-lg-6">';
        echo '<label for="sport" style="margin-right:18px">Sport</label>
        <select class="select-sport form-control" style="width:80%" name="sport" id="sport" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT * FROM sports ORDER BY sports_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                echo '<option value="'.$row['sports_id'].'">'.$row['sports_name'].'</option>';
            }
        echo '</select><br/><br/>
        <label for="dateRangePicker">Description<i style="font-size:12px">(optional)</i></label>
        <textarea class="form-control" name="description" id="description" rows="3" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)"></textarea><br/>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Manager</span>
            </div>
            <input type="text" class="form-control" name="manager" id="manager" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" required>
        </div>';
        echo '<label for="sport" style="margin-right:13px">Venue</label>
        <select class="select-venue form-control" style="width:80%" name="venue" id="venue" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT * FROM venue ORDER BY venue_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                echo '<option value="'.$row['venue_id'].'">'.$row['venue_name'].'</option>';
            }
        echo '</select><br/><br/>';
        echo '<label for="sport" style="margin-right:23px">Type</label>
        <select class="select-type form-control" style="width:80%" name="type" id="type" required>
            <option value=""></option>
            <option value="Single Elimination">Single Elimination</option>
            <option value="Double Elimination">Double Elimination</option>
            <option value="Round Robin">Round Robin</option>
        </select><br/><br/>
        </div>
        <div class="col-lg-6">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Max # of Participants</span>
            </div>
            <input type="number" max="16" min="2" step="1" value="2" class="form-control max-part" name="max_part" id="max_part" onfocusout="checkMin()" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"p required>
        </div>';
        echo '<label for="sport" style="margin-right:26px">Pariticpants</label><br/>
        <select class="select-team form-control" style="width:100%" name="team[]" multiple="multiple" id="team" onchange=countteam() required>';
            $query1 = mysql_query("SELECT * FROM team ORDER BY team_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                echo '<option value="'.$row['team_id'].'">'.$row['team_name'].' - '.$row['team_acro'].'</option>';
            }
        echo '</select>
        <label>No. of Selected Participants : <b id="noteam">0</b></label>
        <br/><br/>
        </div>
        </div>';
        // echo '<label id="debug"></label>';
        echo '<button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submitevent()> Save </button>';
    }
    elseif(isset($_GET['edit_event'])){
        $tour = 1;
        $query = mysql_query("SELECT * FROM tournament_sports WHERE tour_sports_id=".$_GET['edit_event']) or die(mysql_error());
        $row1 = mysql_fetch_array($query);
        
        echo '<input type="hidden" class="form-control" name="tsid" id="tsid" autocomplete="off" value="'.$_GET['edit_event'].'">
        <input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$row1['tournament_id'].'">
        <input type="hidden" class="form-control" name="sid" id="sid" autocomplete="off" value="'.$row1['sports_id'].'">';
        echo '<label for="sport" style="margin-right:18px">Sport</label>
        <select class="select-sport form-control" style="width:80%" name="sport" id="sport" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT * FROM sports ORDER BY sports_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                if($row['sports_id']==$row1['sports_id']){$selected='selected';}else{$selected='';}
                echo '<option value="'.$row['sports_id'].'" '.$selected.'>'.$row['sports_name'].'</option>';
            }
        echo '</select><br/><br/>
        <label for="dateRangePicker">Description<i style="font-size:12px">(optional)</i></label>
        <textarea class="form-control" name="description" id="description" rows="3" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">'.$row1['description'].'</textarea><br/>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Manager</span>
            </div>
            <input type="text" class="form-control" name="manager" id="manager" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$row1['manager'].'" required>
        </div>';
        echo '<label for="sport" style="margin-right:13px">Venue</label>
        <select class="select-venue form-control" style="width:80%" name="venue" id="venue" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT * FROM venue ORDER BY venue_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                if($row['venue_id']==$row1['venue_id']){$selected='selected';}else{$selected='';}
                echo '<option value="'.$row['venue_id'].'" '.$selected.'>'.$row['venue_name'].'</option>';
            }
        echo '</select><br/>';
        echo '<div class="input-group mb-3">
            
            <input type="number" max="16" min="2" step="1" value="2" class="form-control max-part" name="max_part" id="max_part" onfocusout="checkMin()" style="display:none" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"p required>
        </div>';
        // echo '<label id="debug"></label>';
        echo '<button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submiteditevent()> Save </button>';
    }
    elseif(isset($_GET['edit_tournament'])){
        $tour = 1;
        $query = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$_POST['ids']) or die(mysql_error());
        $result = mysql_fetch_array($query);
        echo '<input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$_POST['ids'].'">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" class="form-control" name="tname" id="tname" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$result['tournament_name'].'">
        </div>
        <div class="form-group" id="simple-date4">
            <label for="dateRangePicker">Tournament Duration</label>
            <div class="input-daterange input-group">
                <input type="text" class="input-sm form-control" name="start" id="start" value="'.$result['start_date'].'" readonly required/>
                <div class="input-group-prepend">
                <span class="input-group-text">to</span>
                </div>
                <input type="text" class="input-sm form-control" name="end" id="end" value="'.$result['end_date'].'" readonly required/>
            </div>
        </div>
        <label for="dateRangePicker">Description<i style="font-size:12px">(optional)</i></label>
        <textarea class="form-control" name="description" id="description" rows="3" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">'.$result['description'].'</textarea><br/>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Organizer</span>
            </div>
            <input type="text" class="form-control" name="organizer" id="organizer" autocomplete="off" style="text-transform:uppercase" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" value="'.$result['organizer'].'" >
        </div>';
        echo '<button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submitedittournament()> Save Changes</button>';
    }
    elseif(isset($_GET['update_tournament'])){
        $query5 = "UPDATE tournament SET tournament_name='".strtoupper($_POST['tname'])."',start_date='".$_POST['tstart']."',end_date='".$_POST['tend']."',description='".$_POST['desc']."',organizer='".strtoupper($_POST['organizer'])."' WHERE tournament_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        echo 'ok';
    }
    elseif(isset($_GET['edit_participant'])){
        $tour = 1;
        echo '<input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$_POST['ids'].'">
        <input type="hidden" class="form-control" name="pid" id="pid" autocomplete="off" value="'.$_POST['ids2'].'">
        <input type="hidden" class="form-control" name="tsid" id="tsid" autocomplete="off" value="'.$_POST['ids3'].'">
        <label for="sport" style="margin-right:18px">Participant</label>
        <select class="select-team2 form-control" style="width:100%" name="team" id="team" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT * FROM team ORDER BY team_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                if($row['team_id']==$_POST['ids2']){$selected='selected';}else{$selected='';}
                echo '<option value="'.$row['team_id'].'" '.$selected.'>'.$row['team_name'].'</option>';
            }
        echo '</select><br/><br/>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submiteditparticipant()> Save Changes</button>';
    }
    elseif(isset($_GET['update_event'])){
        if($_POST['sport']!=$_POST['sid']){
            $query2 = mysql_query("SELECT * FROM tournament_sports WHERE tournament_id=".$_POST['tid']." AND sports_id=".$_POST['sport']) or die(mysql_error());
            if(mysql_num_rows($query2) > 0)
            {
                echo 'exist';
                die();
            }
        }

        $query2 = "UPDATE tournament_sports SET sports_id=".$_POST['sport'].",description='".$_POST['desc']."',manager='".$_POST['manager']."',venue_id=".$_POST['venue']." WHERE tour_sports_id=".$_POST['tsid']."";
        mysql_query($query2,$conn) or die(mysql_error());
    }
    elseif(isset($_GET['update_participant'])){
        if($_POST['team']!=$_POST['ids2']){
            $query4 = mysql_query("SELECT * FROM tournament_team WHERE tournament_id=".$_POST['ids']." AND tour_sports_id=".$_POST['ids3']." AND team_id=".$_POST['team']."") or die(mysql_error());
            if(mysql_num_rows($query4) > 0)
            {
                echo 'exist';
                die();
            }
        }

        $query5 = "UPDATE tournament_team SET team_id=".$_POST['team']." WHERE tournament_id=".$_POST['ids']." AND tour_sports_id=".$_POST['ids3']." AND team_id=".$_POST['ids2']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "UPDATE tournament_match SET team_id_1=".$_POST['team']." WHERE tournament_id=".$_POST['ids']." AND tour_sports_id=".$_POST['ids3']." AND team_id_1=".$_POST['ids2']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "UPDATE tournament_match SET team_id_2=".$_POST['team']." WHERE tournament_id=".$_POST['ids']." AND tour_sports_id=".$_POST['ids3']." AND team_id_2=".$_POST['ids2']."";
        mysql_query($query5,$conn) or die(mysql_error());

        echo 'ok';
        die();
    }
    elseif(isset($_GET['delete_team_event'])){
        $query5 = "DELETE FROM team_sports WHERE team_sports_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['delete_tournament'])){
        $query5 = "DELETE FROM tournament WHERE tournament_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "DELETE FROM tournament_team WHERE tournament_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "DELETE FROM tournament_match WHERE tournament_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "DELETE FROM tournament_sports WHERE tournament_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['delete_event'])){
        $query5 = "DELETE FROM tournament_team WHERE tour_sports_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "DELETE FROM tournament_match WHERE tour_sports_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "DELETE FROM tournament_sports WHERE tour_sports_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        $query5 = "DELETE FROM tournament_schedule WHERE tour_sports_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['tag_winner'])){
        $query = mysql_query("SELECT a.*,IFNULL(b.team_name,'TBD') AS team_1,IFNULL(c.team_name,'TBD') AS team_2 FROM tournament_match a LEFT JOIN team b ON a.team_id_1=b.team_id LEFT JOIN team c ON a.team_id_2=c.team_id WHERE a.match_id=".$_POST['ids']) or die(mysql_error());
        $row = mysql_fetch_array($query);
        echo '<input type="hidden" class="form-control" name="mid" id="mid" autocomplete="off" value="'.$_POST['ids'].'">
        <input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$_POST['ids2'].'">
        <div class="form-check" style="text-align:center;font-size:16px;font-weight:bold">
        <input type="radio" class="form-check-input" id="radio1" name="winradio" value="'.$row['team_id_1'].'">'.$row['team_1'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label class="form-check-label" for="radio1"></label>
        <input type="radio" class="form-check-input" id="radio2" name="winradio" value="'.$row['team_id_2'].'">'.$row['team_2'].'
        <label class="form-check-label" for="radio2"></label>
      </div><br/>
      <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
      <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submittagwinner()> Save</button>';
    }
    elseif(isset($_GET['set_schedule'])){
        $tour = 1;
        // echo $date2;
        echo '<input type="hidden" class="form-control" name="mid" id="mid" autocomplete="off" value="'.$_POST['match_id'].'">
        <input type="hidden" class="form-control" name="sid" id="sid" autocomplete="off" value="'.$_POST['sports_id'].'">
        <input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$_POST['tour_id'].'">
        <input type="hidden" class="form-control" name="vid" id="vid" autocomplete="off" value="'.$_POST['venue_id'].'">
        <div class="form-group" id="simple-date1">
            <label for="sched_date">Date</label>
            <div class="input-group date">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control" name="sched_date" id="sched_date" readonly required>
            </div>
        </div>
        <label for="start_time">Start Time</label>
        <input type="time" class="form-control" id="start_time" name="start_time"><br/>
        <label for="end_time">End Time</label>
        <input type="time" class="form-control" id="end_time" name="end_time"><br/>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=submitsched()> Save</button>';
    }
    elseif(isset($_GET['save_schedule'])){
        $time_range = strtotime($_POST['end_time']) - strtotime($_POST['start_time']);
        if(strtotime($_POST['start_time']) > strtotime($_POST['end_time'])){
            echo 'invalid';
            die();
        }
        if($time_range < 3540){
            echo 'less';
            die();
        }

        if($_POST['sched_date']==$date2){
            if(strtotime($_POST['start_time']) < strtotime($time1)){
                echo 'invalid2';
                die();
            }
        }

        $query = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$_POST['tid']) or die(mysql_error());
        $result = mysql_fetch_array($query);

        if(strtotime($_POST['sched_date']) < strtotime($result['start_date'])){
            echo 'in-out';
            die();
        }

        if(strtotime($_POST['sched_date']) > strtotime($result['end_date'])){
            echo 'out';
            die();
        }

        $query1 = mysql_query("SELECT * FROM tournament_schedule WHERE tournament_id=".$_POST['tid']." AND venue_id=".$_POST['vid']." AND sched_date='".$_POST['sched_date']."' AND (start_time BETWEEN '".$_POST['start_time']."' AND '".$_POST['end_time']."' OR end_time BETWEEN '".$_POST['start_time']."' AND '".$_POST['end_time']."')") or die(mysql_error());
        if(mysql_num_rows($query1) > 0)
        {
            echo 'exist';
            die();
        }

        $query = "INSERT INTO tournament_schedule VALUES(null,".$_POST['mid'].",".$_POST['tid'].",".$_POST['sid'].",".$_POST['vid'].",'".$_POST['sched_date']."','".$_POST['start_time']."','".$_POST['end_time']."','".$date1."')";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['view_schedule'])){
        $tour = 1;
        $query = mysql_query("SELECT * FROM tournament_schedule WHERE schedule_id=".$_POST['sched_id']) or die(mysql_error());
        $result = mysql_fetch_array($query);
        echo '<div class="form-group" id="simple-date155">
            <label for="sched_date" style="padding-right:55px">Date</label>
            <span style="font-weight:bold">'.date_format(date_create($result['sched_date']), "F d, Y").'</span>
        </div>
        <label for="start_time" style="padding-right:15px">Start Time</label>
        <span style="font-weight:bold">'.date_format(date_create($result['start_time']), "g:i A").'</span><br/>
        <label for="end_time" style="padding-right:23px">End Time</label>
        <span style="font-weight:bold">'.date_format(date_create($result['end_time']), "g:i A").'</span><br/>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>';
    }
    elseif(isset($_GET['modify_schedule'])){
        $tour = 1;
        $query = mysql_query("SELECT * FROM tournament_schedule WHERE schedule_id=".$_POST['sched_id']) or die(mysql_error());
        $result = mysql_fetch_array($query);
        echo '<input type="hidden" class="form-control" name="sid" id="sid" autocomplete="off" value="'.$_POST['sched_id'].'">
        <input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$_POST['tid'].'">
        <input type="hidden" class="form-control" name="vid" id="vid" autocomplete="off" value="'.$_POST['vid'].'">
        <div class="form-group" id="simple-date1">
            <label for="sched_date">Date</label>
            <div class="input-group date">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control" name="sched_date" id="sched_date" value='.$result['sched_date'].' readonly required>
            </div>
        </div>
        <label for="start_time">Start Time</label>
        <input type="time" class="form-control" id="start_time" name="start_time" value='.$result['start_time'].'><br/>
        <label for="end_time">End Time</label>
        <input type="time" class="form-control" id="end_time" name="end_time" value='.$result['end_time'].'><br/>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=editsched()> Save</button>';
    }
    elseif(isset($_GET['edit_schedule'])){
        $time_range = strtotime($_POST['end_time']) - strtotime($_POST['start_time']);
        if(strtotime($_POST['start_time']) > strtotime($_POST['end_time'])){
            echo 'invalid';
            die();
        }
        if($time_range < 3540){
            echo 'less';
            die();
        }

        if($_POST['sched_date']==$date2){
            if(strtotime($_POST['start_time']) < strtotime($time1)){
                echo 'invalid2';
                die();
            }
        }

        $query = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$_POST['tid']) or die(mysql_error());
        $result = mysql_fetch_array($query);

        if(strtotime($_POST['sched_date']) < strtotime($result['start_date'])){
            echo 'in-out';
            die();
        }

        if(strtotime($_POST['sched_date']) > strtotime($result['end_date'])){
            echo 'out';
            die();
        }

        $query1 = mysql_query("SELECT * FROM tournament_schedule WHERE tournament_id=".$_POST['tid']." AND venue_id=".$_POST['vid']." AND schedule_id!=".$_POST['sid']." AND sched_date='".$_POST['sched_date']."' AND (start_time BETWEEN '".$_POST['start_time']."' AND '".$_POST['end_time']."' OR end_time BETWEEN '".$_POST['start_time']."' AND '".$_POST['end_time']."')") or die(mysql_error());
        if(mysql_num_rows($query1) > 0)
        {
            echo 'exist';
            die();
        }

        $query = "UPDATE tournament_schedule SET sched_date='".$_POST['sched_date']."',start_time='".$_POST['start_time']."',end_time='".$_POST['end_time']."' WHERE schedule_id=".$_POST['sid']."";
        mysql_query($query,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['delete_sched'])){
        $query5 = "DELETE FROM tournament_schedule WHERE schedule_id=".$_POST['ids']."";
        mysql_query($query5,$conn) or die(mysql_error());

        echo 'okay';
    }
    elseif(isset($_GET['schedules'])){
        $tour = 1;
        $query = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$_POST['ids']) or die(mysql_error());
        $result = mysql_fetch_array($query);
        echo '<input type="hidden" class="form-control" name="tid" id="tid" autocomplete="off" value="'.$_POST['ids'].'">
        <div class="form-group" id="simple-date5">
            <label for="dateRangePicker">Generate Date</label>
            <div class="input-daterange input-group">
                <input type="text" class="input-sm form-control" name="start" id="start" value='.$result['start_date'].' readonly required/>
                <div class="input-group-prepend">
                <span class="input-group-text">to</span>
                </div>
                <input type="text" class="input-sm form-control" name="end" id="end" value='.$result['end_date'].' readonly required/>
            </div>
        </div>
        <div class="form-check" style="text-align:center;font-size:16px;font-weight:bold">
            <input type="radio" class="form-check-input" id="radio1" name="genradio" value="All" checked>All Events
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" class="form-check-input" id="radio2" name="genradio" value="Single">By Event&nbsp;&nbsp;&nbsp;&nbsp;';
            echo '<select class="select-sport2 form-control" style="width:40%" name="sport2" id="sport2" required>';
            echo '<option value="">Select</option>';
            $query1 = mysql_query("SELECT a.*,b.sports_name FROM tournament_sports a INNER JOIN sports b ON a.sports_id=b.sports_id WHERE a.tournament_id=".$_POST['ids']." ORDER BY b.sports_name ASC") or die(mysql_error());
            while($row = mysql_fetch_array($query1))
            {
                echo '<option value="'.$row['sports_id'].'">'.$row['sports_name'].'</option>';
            }
        echo '</select><br/><br/>
        </div>
        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
        <button type="button" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save" onclick=generatesched()> Generate</button>';
    }
    elseif(isset($_GET['checkdate'])){
        $query = mysql_query("SELECT * FROM tournament WHERE tournament_id=".$_POST['tid']) or die(mysql_error());
        $result = mysql_fetch_array($query);

        if(strtotime($_POST['tstart']) < strtotime($result['start_date'])){
            echo 'invalid-start';
            die();
        }

        if(strtotime($_POST['tstart']) > strtotime($result['end_date'])){
            echo 'invalid-start2';
            die();
        }

        if(strtotime($_POST['tend']) > strtotime($result['end_date'])){
            echo 'invalid-end';
            die();
        }
    }
?>
<?php if($tour==0){die();} ?>
<script>
    function checkMin() {
        var x = document.getElementById("max_part");
        if(x.value < 2){
            x.value = 2;
        }

        $('.select-team').val(null);
        
        var count = $("#team :selected").length;
        $("#noteam").html(count);

        $('.select-team').select2({
            maximumSelectionLength: x.value
        });
    }

    function myFunction() {

        var x = document.getElementById("fname");
        x.value = x.value.toUpperCase();
    }

    $('.select-sport2').select2({
        placeholder: "Select Sport",
        allowClear: true
    });

    $('.select-sport').select2({
        placeholder: "Select Sport",
        allowClear: true
    });

    $('.select-team').select2({
        maximumSelectionLength: 2
    });

    $('.select-venue').select2({
        placeholder: "Select Venue",
        allowClear: true
    });

    $('.select-type').select2({
        placeholder: "Select Tournament Type",
        allowClear: true
    });

    $('.select-team2').select2({
        placeholder: "Select Event",
        allowClear: true
    });

    $('#simple-date4 .input-daterange').datepicker({        
        format: 'yyyy-mm-dd',
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
        startDate: new Date()
    });

    $('#simple-date5 .input-daterange').datepicker({        
        format: 'yyyy-mm-dd',
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked'
    });

    $('#simple-date1 .input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
        startDate: new Date()
    });

    document.getElementsByClassName('max-part')[0].oninput = function () {
        var max = parseInt(this.max);

        if (parseInt(this.value) > max) {
            this.value = max; 
        }
    }
</script>