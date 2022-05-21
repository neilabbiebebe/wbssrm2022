$('#login_form').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: 'function.php?login_validate',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data == 'try')
            {
                $("#msg").show();
                $("#msg2").hide();
                $("#username").val('');
                $("#password").val('');
                $("#username").focus();
            }
            else
            {
                if(data=='inactive')
                {
                    $("#msg").hide();
                    $("#msg2").show();
                    $("#username").val('');
                    $("#password").val('');
                    $("#username").focus();
                }
                else
                {
                    window.location.replace('dashboard');
                }
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function swal_message(msg_type,msg){
    var Toast = Swal.mixin({
        toast: true,
        animation: false,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        }
      });
    Toast.fire({
        icon: msg_type,
        title: msg
    })
}

function user_settings(ids)
{
    $.ajax({
        url: 'function.php?user_settings',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {            
            $("#user_content").html(data);
        }
    });
}

function adduser()
{   
    $.ajax({
        url: 'function.php?add_user',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_user").html(data);                
        }                
    });
}

$('#user_settings').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    //var uname = $("[name='uname']").val();
    //var username = $("[name='username']").val();
    //var password = $("[name='password']").val();
    var curpassword = $("[name='current_password']").val();
    var newpass = $("[name='new_password']").val();
    var confirmpass = $("[name='confirm_password']").val();
    var flag = 0;
    if(newpass!="" || confirmpass!="")
    {
        if(curpassword=="")
        {
            swal_message('error','Current password is empty');
            return false;
        }
    }
    if(curpassword!="")
    {
        if(newpass=="")
        {
            swal_message('error','New password is empty');
            return false;
        }
        if(confirmpass=="")
        {
            swal_message('error','Confirm password is empty');
            return false;
        }
        if(newpass!=confirmpass)
        {
            swal_message('error','Password did not match');
            return false;
        }
    }
    $.ajax({
        url: 'function.php?change_user_settings',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            // alert(data);
            if(data=="exist")
            {
                swal_message('error','Username already exist');
            }
            else
            {
                if(data=="wrong")
                {
                    swal_message('error','Current password is incorrect');
                }
                else
                {
                    $("#userSettingsModal").modal("hide");
                    swal_message('success','User settings successfully updated');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#add_user').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var name = $("[name='fullname']").val();
    var username = $("[name='username']").val();
    var pass = $("[name='password']").val();
    var confirmpass = $("[name='confirm_password']").val();
    if(name==''){
        swal_message('error','Fullname is empty')
        return false;
    }
    if(username==''){
        swal_message('error','Username is empty')
        return false;
    }
    if(pass==''){
        swal_message('error','Password is empty')
        return false;
    }
    if(confirmpass==''){
        swal_message('error','Confirm password is empty')
        return false;
    }
    if(pass!=confirmpass){
        swal_message('error','Password did not match')
        return false;
    }
    
    $.ajax({
        url: 'function.php?insert_user',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=="exist")
            {
                swal_message('error','Username already exist');
            }
            else
            {
                $("#addUserModal").modal("hide");
                swal_message('success','User successfully added');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function resetpassword(ids,ids2)
{
    if (ids==ids2)
    {
        swal_message('error','You cannot reset your own password! Please go to user settings to change your password');
    }
    else
    {
        Swal.fire({
            title: 'Are you sure to reset the password of this user?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '',
            confirmButtonText: 'Yes, reset it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'function.php?reset_password',
                    type: 'POST',
                    data: {ids:ids},
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {            
                        swal_message('success','Password successfully reset');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                });
            }
          })
    }
}

function deleteuser(ids,ids2)
{
    if (ids==ids2)
    {
        swal_message('error','Cannot delete user! User is currently logged in');
    }
    else
    {
      Swal.fire({
        title: 'Are you sure to delete this user?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?delete_user',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal_message('success','User successfully deleted');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        }
      })
    }
}

function edituser(ids,ids2)
{
    $.ajax({
        url: 'function.php?edit_user',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#edit_user").html(data);
        }
    });
}

$('#edit_user').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var name = $("[name='fullname']").val();
    var username = $("[name='username']").val();
    if(name==''){
        swal_message('error','Fullname is empty')
        return false;
    }
    if(username==''){
        swal_message('error','Username is empty')
        return false;
    }
    
    $.ajax({
        url: 'function.php?update_user',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=='exist')
            {
                swal_message('error','Username already exist');
            }
            else
            {
                $("#editUserModal").modal("hide");
                swal_message('success','User successfully updated');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function addsports()
{   
    $.ajax({
        url: 'function.php?add_sports',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_sports").html(data);                
        }                
    });
}

$('#add_sports').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var sport = $("[name='sportsname']").val();
    if(sport==''){
        swal_message('error','Sport is empty');
        return false;
    }
    $.ajax({
        url: 'function.php?insert_sports',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=="exist")
            {
                swal_message('error','Sport already exist');
            }
            else
            {
                $("#addSportsModal").modal("hide");
                swal_message('success','Sport successfully added');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function editsports(ids)
{
    $.ajax({
        url: 'function.php?edit_sports',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#edit_sports").html(data);
        }
    });
}

$('#edit_sports').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var sport = $("[name='sportsname']").val();
    if(sport==''){
        swal_message('error','Sport is empty');
        return false;
    }
    $.ajax({
        url: 'function.php?update_sports',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=='exist')
            {
                swal_message('error','Sport already exist');
            }
            else
            {
                $("#editSportsModal").modal("hide");
                swal_message('success','Sport successfully updated');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function deletesports(ids)
{
    Swal.fire({
    title: 'Are you sure to delete this sport?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: 'function.php?delete_sports',
            type: 'POST',
            data: {ids:ids},
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {            
                swal_message('success','Sport successfully deleted');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    }
    })
}

function addevents()
{   
    $.ajax({
        url: 'function.php?add_events',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_events").html(data);
        }                
    });
}

$('#add_events').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: 'function.php?insert_events',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=="exist")
            {
                swal_message('error','Event already exist');
            }
            else
            {
                $("#addEventsModal").modal("hide");
                swal_message('success','Event successfully added');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function editevents(ids)
{
    $.ajax({
        url: 'function.php?edit_events',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#edit_events").html(data);
        }
    });
}

$('#edit_events').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: 'function.php?update_events',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=='exist')
            {
                swal_message('error','Event already exist');
            }
            else
            {
                $("#editEventsModal").modal("hide");
                swal_message('success','Event successfully updated');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function deleteevents(ids)
{
    Swal.fire({
    title: 'Are you sure to delete this event?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: 'function.php?delete_events',
            type: 'POST',
            data: {ids:ids},
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {            
                swal_message('success','Event successfully deleted');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    }
    })
}

function addvenue()
{   
    $.ajax({
        url: 'function.php?add_venue',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_venue").html(data);
        }                
    });
}

$('#add_venue').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var venue = $("[name='venuename']").val();
    var address = $("[name='address']").val();
    if(venue==''){
        swal_message('error','Venue is empty');
        return false;
    }
    if(address==''){
        swal_message('error','Address is empty');
        return false;
    }
    $.ajax({
        url: 'function.php?insert_venue',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=="exist")
            {
                swal_message('error','Venue already exist');
            }
            else
            {
                $("#addVenueModal").modal("hide");
                swal_message('success','Venue successfully added');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function editvenue(ids)
{
    $.ajax({
        url: 'function.php?edit_venue',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#edit_venue").html(data);
        }
    });
}

$('#edit_venue').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var venue = $("[name='venuename']").val();
    var address = $("[name='address']").val();
    if(venue==''){
        swal_message('error','Venue is empty');
        return false;
    }
    if(address==''){
        swal_message('error','Address is empty');
        return false;
    }
    $.ajax({
        url: 'function.php?update_venue',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data=='exist')
            {
                swal_message('error','Venue already exist');
            }
            else
            {
                $("#editVenueModal").modal("hide");
                swal_message('success','Venue successfully updated');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function deletevenue(ids)
{
    Swal.fire({
    title: 'Are you sure to delete this venue?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: 'function.php?delete_venue',
            type: 'POST',
            data: {ids:ids},
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {            
                swal_message('success','Venue successfully deleted');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    }
    })
}

function addteam()
{   
    $.ajax({
        url: 'function.php?add_team',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_team").html(data);
        }                
    });
}

$('#add_team').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var name = $("[name='teamname']").val();
    var acro = $("[name='teamacro']").val();
    var coach = $("[name='coach']").val();
    var contact = $("[name='coach_contact']").val();
    var contact_no = document.getElementById('coach_contact').value;
    if(name==''){
        swal_message('error','Name is empty');
        return false;
    }
    if(acro==''){
        swal_message('error','Acronym is empty');
        return false;
    }
    if(coach==''){
        swal_message('error','In-charge Name is empty');
        return false;
    }
    if(contact==''){
        swal_message('error','Mobile number is empty');
        return false;
    }
    if(contact_no.length < 11 || contact_no.length > 11)
    {
        swal_message('error','Invalid mobile number');
        return false;
    }
    $.ajax({
        url: 'function.php?insert_team',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            // alert(data);
            if(data=='logo-exist')
            {
                swal_message('error','Image filename already exist! Please rename your image filename first before uploading');
            }
            else
            {
                if(data=='toobig')
                {
                    swal_message('error','Image file size is too large');
                }
                else
                {
                    if(data=='invalid')
                    {
                        swal_message('error','Invalid file type! Only PNG, JPG & JPEG are allowed');
                    }
                    else
                    {
                        if(data=="exist")
                        {
                            swal_message('error','Participant already exist');
                        }
                        else
                        {
                            $("#addTeamModal").modal("hide");
                            swal_message('success','Participant successfully added');
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        }
                    }
                }
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function editteam(ids)
{
    $.ajax({
        url: 'function.php?edit_team',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#edit_team").html(data);
        }
    });
}

$('#edit_team').on("submit", function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var name = $("[name='teamname']").val();
    var acro = $("[name='teamacro']").val();
    var coach = $("[name='coach']").val();
    var contact = $("[name='coach_contact']").val();
    var contact_no = document.getElementById('coach_contact').value;
    if(name==''){
        swal_message('error','Name is empty');
        return false;
    }
    if(acro==''){
        swal_message('error','Acronym is empty');
        return false;
    }
    if(coach==''){
        swal_message('error','In-charge name is empty');
        return false;
    }
    if(contact==''){
        swal_message('error','Contact number is empty');
        return false;
    }
    if(contact_no.length < 11 || contact_no.length > 11)
    {
        swal_message('error','Invalid mobile number');
        return false;
    }
    $.ajax({
        url: 'function.php?update_team',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data=='logo-exist')
            {
                swal_message('error','Image filename already exist! Please rename your image filename first before uploading');
            }
            else
            {
                if(data=='toobig')
                {
                    swal_message('error','Image file size is too large');
                }
                else
                {
                    if(data=='invalid')
                    {
                        swal_message('error','Invalid file type! Only PNG, JPG & JPEG are allowed');
                    }
                    else
                    {
                        if(data=="exist")
                        {
                            swal_message('error','Participant already exist');
                        }
                        else
                        {
                            $("#addTeamModal").modal("hide");
                            swal_message('success','Participant successfully added');
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        }
                    }
                }
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function deleteteam(ids)
{
    Swal.fire({
    title: 'Are you sure to delete this participant?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: 'function.php?delete_team',
            type: 'POST',
            data: {ids:ids},
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {            
                swal_message('success','Participant successfully deleted');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    }
    })
}

function addtournament()
{   
    $.ajax({
        url: 'function.php?add_tournament',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_tournament").html(data);
        }                
    });
}

function addevent(ids)
{
    $.ajax({
        url: 'function.php?add_event='+ids,
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_event").html(data);
        }                
    });
}

function addteamevent(ids)
{
    $.ajax({
        url: 'function.php?add_team_event='+ids,
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#add_team_event").html(data);
        }                
    });
}

function editevent(ids)
{
    $.ajax({
        url: 'function.php?edit_event='+ids,
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#edit_event").html(data);
        }                
    });
}

function submittournament()
{
    var tname = $("[name='tname']").val();
    var tstart = $("[name='start']").val();
    var tend = $("[name='end']").val();
    var organizer = $("[name='organizer']").val();
    var desc = document.getElementById("description").value;
    if(tname=='')
    {
        swal_message('error','Tournament name is empty');
        return false;
    }
    if(tstart=='' || tend=='')
    {
        swal_message('error','Tournament duration is empty');
        return false;
    }
    if(organizer=='')
    {
        swal_message('error','Tournament organizer is empty');
        return false;
    }
    Swal.fire({
        title: 'Proceed saving this tournament?',
        text: "Please double check the tournament details before saving!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, proceed saving!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?save_tournament',
                type: 'POST',
                data: {tname:tname,tstart:tstart,tend:tend,organizer:organizer,desc:desc},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    if(data=='exist')
                    {
                        swal_message('error','Tournament already exist with the same duration');
                    }
                    else
                    {
                        $("#addTournamentModal").modal("hide");
                        swal_message('success','Tournament successfully added');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
    })
}

function submitteamevent()
{
    var team_id = $("[name='pid']").val();
    var sport = $('#sport').select2("val");
    var coach = $("[name='coach_name']").val();
    var contact_no = $("[name='contact_no']").val();
    var contact = document.getElementById('contact_no').value;
    if (sport=="")
    {
        swal_message('error','Sport is empty');
        return false;
    }
    if (coach=="")
    {
        swal_message('error','Coach is empty');
        return false;
    }
    if (contact_no=="")
    {
        swal_message('error','Mobile number is empty');
        return false;
    }
    else if(contact.length < 11 || contact.length > 11)
    {
        swal_message('error','Invalid mobile number');
        return false;
    }
    Swal.fire({
        title: 'Proceed saving this event on this participant?',
        text: "Please double check the details before saving!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, proceed saving!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?save_team_sports',
                type: 'POST',
                data: {team_id:team_id,sport:sport,coach:coach,contact_no:contact_no},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    // $("#debug").html(data);
                    if(data=='exist')
                    {
                        swal_message('error','Event already exist in this participant');
                    }
                    else
                    {
                        $("#addTeamEventModal").modal("hide");
                        swal_message('success','Event successfully added to participant');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
    })
}

function editteamsport(ids)
{
    $.ajax({
        url: 'function.php?edit_team_sport',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#edit_team_event").html(data);
        }
    });
}

function submitevent()
{
    var count = $("#team :selected").length;
    var venue = $('#venue').select2("val");
    var sport = $('#sport').select2("val");
    var type = $('#type').select2("val");
    var team = $('#team').select2("val");
    var jsonTeam = JSON.stringify(team);
    var manager = $("[name='manager']").val();
    var desc = document.getElementById("description").value;
    var tid = $("[name='tid']").val();
    if (sport=="")
    {
        swal_message('error','Sport is empty');
        return false;
    }
    if(manager=="")
    {
        swal_message('error','Manager is empty');
        return false;
    }
    if (venue=="")
    {
        swal_message('error','Venue is empty');
        return false;
    }
    if (type=="")
    {
        swal_message('error','Tournament type is empty');
        return false;
    }
    if(count==0)
    {
        swal_message('error','No participant selected');
        return false;
    }
    if(type=="Single Elimination")
    {
        if(count<2)
        {
            swal_message('error','Minimum participants in '+type+' is 2');
            return false;
        }
    }
    else
    {
        if(count<3)
        {
            swal_message('error','Minimum participants in '+type+' is 3');
            return false;
        }
    }
    
    if(count>16)
    {
        swal_message('error','Maximum participants is 16');
        return false;
    }
    if(type=="Single Elimination")
    {
        Swal.fire({
            title: 'Proceed saving this tournament?',
            text: "You won't be able to add or delete a participant in this tournament nor change the tournament type after saving! But you can modify the participant, event and sport!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '',
            confirmButtonText: 'Yes, proceed saving!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'function_single.php?save_tournament',
                    type: 'POST',
                    data: {tid:tid,count:count,sport:sport,desc:desc,manager:manager,venue:venue,type:type,team:jsonTeam},
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {       
                        // alert(data);
                        if(data=='exist')
                        {
                            swal_message('error','Event already exist in this tournament');
                        }
                        else
                        {
                            $("#addTournamentModal").modal("hide");
                            swal_message('success','Tournament successfully added');
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        }
                    }
                });
            }
        })
    }
    if(type=="Double Elimination")
    {
        Swal.fire({
            title: 'Proceed saving this tournament?',
            text: "You won't be able to add or delete a participant in this tournament nor change the tournament type after saving! But you can modify the participant, event and sport!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '',
            confirmButtonText: 'Yes, proceed saving!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'function_double.php?save_tournament',
                    type: 'POST',
                    data: {tid:tid,count:count,sport:sport,desc:desc,manager:manager,venue:venue,type:type,team:jsonTeam},
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {       
                        // $("#debug").html(data);
                        if(data=='exist')
                        {
                            swal_message('error','Event already exist in this tournament');
                        }
                        else
                        {
                            $("#addTournamentModal").modal("hide");
                            swal_message('success','Tournament successfully added');
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        }
                    }
                });
            }
        })
    }
    if(type=="Round Robin")
    {
        Swal.fire({
            title: 'Proceed saving this tournament?',
            text: "You won't be able to add or delete a participant in this tournament nor change the tournament type after saving! But you can modify the participant, event and sport!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '',
            confirmButtonText: 'Yes, proceed saving!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'function_roundrobin.php?save_tournament',
                    type: 'POST',
                    data: {tid:tid,count:count,sport:sport,desc:desc,manager:manager,venue:venue,type:type,team:jsonTeam},
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {       
                        // $("#debug").html(data);
                        if(data=='exist')
                        {
                            swal_message('error','Event already exist in this tournament');
                        }
                        else
                        {
                            $("#addTournamentModal").modal("hide");
                            swal_message('success','Tournament successfully added');
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        }
                    }
                });
            }
        })
    }
}

function edittournament(ids)
{
    $.ajax({
        url: 'function.php?edit_tournament',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#edit_tournament").html(data);
        }
    });
}

function submiteditteamevent()
{
    var team_id = $("[name='pid']").val();
    var ps_id = $("[name='psid']").val();
    var s_id = $("[name='sid']").val(); 
    var sport = $('#sport').select2("val");
    var coach = $("[name='coach_name']").val();
    var contact_no = $("[name='contact_no']").val();
    var contact = document.getElementById('contact_no').value;
    if (sport=="")
    {
        swal_message('error','Sport is empty');
        return false;
    }
    if (coach=="")
    {
        swal_message('error','Coach is empty');
        return false;
    }
    if (contact_no=="")
    {
        swal_message('error','Mobile number is empty');
        return false;
    }
    if(contact.length < 11 || contact.length > 11)
    {
        swal_message('error','Invalid mobile number');
        return false;
    }
    Swal.fire({
        title: 'Proceed saving this event on this participant?',
        text: "Please double check the details before saving!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, proceed saving!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?update_team_sports',
                type: 'POST',
                data: {team_id:team_id,ps_id:ps_id,sport:sport,coach:coach,contact_no:contact_no,s_id:s_id},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    // $("#debug").html(data);
                    if(data=='exist')
                    {
                        swal_message('error','Event already exist in this participant');
                    }
                    else
                    {
                        $("#addTeamEventModal").modal("hide");
                        swal_message('success','Participant event successfully updated');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
    })
}

function submiteditevent()
{
    var venue = $('#venue').select2("val");
    var sport = $('#sport').select2("val");
    var manager = $("[name='manager']").val();
    var desc = document.getElementById("description").value;
    var tid = $("[name='tid']").val();
    var tsid = $("[name='tsid']").val();
    var sid = $("[name='sid']").val();
    if (sport=="")
    {
        swal_message('error','Sport is empty');
        return false;
    }
    if(manager=="")
    {
        swal_message('error','Manager is empty');
        return false;
    }
    if (venue=="")
    {
        swal_message('error','Venue is empty');
        return false;
    }
    Swal.fire({
        title: 'Proceed saving this event changes?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, proceed saving!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?update_event',
                type: 'POST',
                data: {tid:tid,sport:sport,venue:venue,manager:manager,desc:desc,sid:sid,tsid:tsid},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    // alert(data);
                    if(data=='exist')
                    {
                        swal_message('error','Event already exist in this tournament');
                    }
                    else
                    {
                        $("#editEventModal").modal("hide");
                        swal_message('success','Event successfully updated');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
        })
}

function submitedittournament()
{
    var tname = $("[name='tname']").val();
    var tstart = $("[name='start']").val();
    var tend = $("[name='end']").val();
    var organizer = $("[name='organizer']").val();
    var desc = document.getElementById("description").value;
    var ids = $("[name='tid']").val();
    if(tname=='')
    {
        swal_message('error','Tournament name is empty');
        return false;
    }
    if(tstart=='' || tend=='')
    {
        swal_message('error','Tournament duration is empty');
        return false;
    }
    if(organizer=='')
    {
        swal_message('error','Tournament organizer is empty');
        return false;
    }
    Swal.fire({
        title: 'Proceed saving this tournament changes?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, proceed saving!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?update_tournament',
                type: 'POST',
                data: {ids:ids,tname:tname,tstart:tstart,tend:tend,organizer:organizer,desc:desc},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    // $("#debug").html(data);
                    $("#editTournamentModal").modal("hide");
                    swal_message('success','Tournament successfully updated');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        }
        })
}

function editparticipant(ids,ids2,ids3)
{
    $.ajax({
        url: 'function.php?edit_participant',
        type: 'POST',
        data: {ids:ids,ids2:ids2,ids3:ids3},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#edit_participant").html(data);
        }
    });
}

function submiteditparticipant()
{
    var team = $('#team').select2("val");
    var ids = $("[name='tid']").val();
    var ids2 = $("[name='pid']").val();
    var ids3 = $("[name='tsid']").val();
    if (team=="")
    {
        swal_message('error','Participant is empty');
        return false;
    }
    Swal.fire({
        title: 'Proceed saving participant change?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, proceed saving!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?update_participant',
                type: 'POST',
                data: {ids:ids,ids2:ids2,team:team,ids3:ids3},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    console.log(data);
                    if(data=='exist')
                    {
                        swal_message('error','Participant already exist in this tournament');
                        return false;
                    }
                    else
                    {
                        // $("#debug").html(data);
                        $("#editParticipantModal").modal("hide");
                        swal_message('success','Participant successfully updated');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
        })
}

function deletetournament(ids)
{
    Swal.fire({
    title: 'Are you sure to delete this tournament?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: 'function.php?delete_tournament',
            type: 'POST',
            data: {ids:ids},
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {            
                swal_message('success','Tournament successfully deleted');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    }
    })
}

function deleteteamevent(ids)
{
    Swal.fire({
        title: 'Are you sure to delete this event for this participant?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?delete_team_event',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal_message('success','Participant event successfully deleted');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        }
        })
}

function deleteevent(ids)
{
    Swal.fire({
    title: 'Are you sure to delete this event?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: 'function.php?delete_event',
            type: 'POST',
            data: {ids:ids},
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {            
                swal_message('success','Event successfully deleted');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
        });
    }
    })
}

function setschedule(match_id,sports_id,tour_id,venue_id)
{
    $.ajax({
        url: 'function.php?set_schedule',
        type: 'POST',
        data: {match_id:match_id,sports_id:sports_id,tour_id:tour_id,venue_id:venue_id},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#set_schedule").html(data);
        }                
    });
}

function viewschedule(sched_id)
{
    $.ajax({
        url: 'function.php?view_schedule',
        type: 'POST',
        data: {sched_id:sched_id},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#view_schedule").html(data);
        }                
    });
}

function modifyschedule(sched_id,tid,vid)
{
    $.ajax({
        url: 'function.php?modify_schedule',
        type: 'POST',
        data: {sched_id:sched_id,tid:tid,vid:vid},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#modify_schedule").html(data);
        }                
    });
}

function editsched()
{
    var sched_date = $("[name='sched_date']").val();
    var start_time = $("[name='start_time']").val();
    var end_time = $("[name='end_time']").val();
    var sid = $("[name='sid']").val();
    var tid = $("[name='tid']").val();
    var vid = $("[name='vid']").val();

    if(sched_date=='')
    {
        swal_message('error','Date is empty');
        return false;
    }
    if(start_time=='')
    {
        swal_message('error','Start time is empty');
        return false;
    }
    if(end_time=='')
    {
        swal_message('error','End time is empty');
        return false;
    }

    Swal.fire({
        title: 'Proceed updating schedule?',
        text: "Please review the schedule you set before saving to avoid conflict of schedule in the future!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?edit_schedule',
                type: 'POST',
                data: {sched_date:sched_date,start_time:start_time,end_time:end_time,sid:sid,tid:tid,vid:vid},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {   
                    if(data=='invalid')
                    {
                        swal_message('error','Invalid time range');
                    }
                    else
                    {
                        if(data=='invalid2')
                        {
                            swal_message('error','Start time should be later today');
                        }
                        else
                        {
                            if(data=='less')
                            {
                                swal_message('error','The minimum time range duration is 1 hour');
                            }
                            else
                            {
                                if(data=='out')
                                {
                                    swal_message('error','Date is greater than the duration of the tournament');
                                }
                                else
                                {
                                    if(data=='in-out')
                                    {
                                        swal_message('error','Date is lesser than the duration of the tournament');
                                    }
                                    else
                                    {
                                        if(data=='exist')
                                        {
                                            swal_message('error','Time range has a conflict in schedule');
                                        }
                                        else
                                        {
                                            swal_message('success','Schedule successfully save');
                                            setTimeout(function(){
                                                window.location.reload();
                                            }, 1000);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }
    })
}

function schedule(ids)
{
    $.ajax({
        url: 'function.php?schedules',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#schedules").html(data);
        }                
    });
}

function generatesched()
{
    var tid = $("[name='tid']").val();
    var tstart = $("[name='start']").val();
    var tend = $("[name='end']").val();
    var sport = $('#sport2').select2("val");
    var sel = $('input[name="genradio"]:checked').val();

    if(sel=='Single' && sport=='')
    {
        swal_message('error','Please select an event');
        return false;
    }

    $.ajax({
        url: 'function.php?checkdate',
        type: 'POST',
        data: {tid:tid,tstart:tstart,tend:tend},
        success: function(data) {
            if(data=='invalid-start')
            {
                swal_message('error','Start date is lesser than the tournament duration');
            }
            else
            {
                if(data=='invalid-start2')
                {
                    swal_message('error','Start date is greater than the tournament duration');
                }
                else
                {
                    if(data=='invalid-end')
                    {
                        swal_message('error','End date is greater than the tournament duration');
                    }
                    else
                    {
                        if(sel=='All')
                        {
                            window.open('schedule?ids='+tid+'&tstart='+tstart+'&tend='+tend+'&sel=All', '_blank');
                        }
                        else
                        {
                            window.open('schedule?ids='+tid+'&tstart='+tstart+'&tend='+tend+'&sel=Single&sid='+sport, '_blank');
                        }
                    }
                }
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
}

function deletesched(ids)
{
    Swal.fire({
        title: 'Are you sure to delete this schedule?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?delete_sched',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal_message('success','Schedule successfully deleted');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        }
        })
}

function submitsched()
{
    var sched_date = $("[name='sched_date']").val();
    var start_time = $("[name='start_time']").val();
    var end_time = $("[name='end_time']").val();
    var mid = $("[name='mid']").val();
    var sid = $("[name='sid']").val();
    var tid = $("[name='tid']").val();
    var vid = $("[name='vid']").val();

    if(sched_date=='')
    {
        swal_message('error','Date is empty');
        return false;
    }
    if(start_time=='')
    {
        swal_message('error','Start time is empty');
        return false;
    }
    if(end_time=='')
    {
        swal_message('error','End time is empty');
        return false;
    }

    Swal.fire({
        title: 'Proceed saving schedule?',
        text: "Please review the schedule you set before saving to avoid conflict of schedule in the future!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '',
        confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'function.php?save_schedule',
                type: 'POST',
                data: {sched_date:sched_date,start_time:start_time,end_time:end_time,mid:mid,sid:sid,tid:tid,vid:vid},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {   
                    if(data=='invalid')
                    {
                        swal_message('error','Invalid time range');
                    }
                    else
                    {
                        if(data=='invalid2')
                        {
                            swal_message('error','Start time should be later today');
                        }
                        else
                        {
                            if(data=='less')
                            {
                                swal_message('error','The minimum time range duration is 1 hour');
                            }
                            else
                            {
                                if(data=='out')
                                {
                                    swal_message('error','Date is greater than the duration of the tournament');
                                }
                                else
                                {
                                    if(data=='in-out')
                                    {
                                        swal_message('error','Date is lesser than the duration of the tournament');
                                    }
                                    else
                                    {
                                        if(data=='exist')
                                        {
                                            swal_message('error','Time range has a conflict in schedule');
                                        }
                                        else
                                        {
                                            swal_message('success','Schedule successfully save');
                                            setTimeout(function(){
                                                window.location.reload();
                                            }, 1000);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }
    })
}

function viewbracket(tourid,tsid,tourtype,cnt)
{
    if(tourtype=='round')
    {
        window.open('round-robin?ids='+tourid+'&ids2='+tsid, '_blank');
    }
    else
    {
        window.open('brackets-'+tourtype+'/'+tourtype+'-'+cnt+'?ids='+tourid+'&ids2='+tsid, '_blank');
    }
}

function countteam()
{
    var count = $("#team :selected").length;
    $("#noteam").html(count);
}

function tagwinner(ids,ids2)
{
    $.ajax({
        url: 'function.php?tag_winner',
        type: 'POST',
        data: {ids:ids,ids2:ids2},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#tag_winner").html(data);
        }
    });
}

function submittagwinner()
{
    var winner = $('input[name="winradio"]:checked').val();
    var ids = $("[name='mid']").val();
    var ids2 = $("[name='tid']").val();

    if(winner==undefined)
    {
        swal_message('error','No winner selected');
    }
    else
    {
        Swal.fire({
            title: 'Are you sure you picked the correct winner?',
            text: "It takes a lot to revert this process if you modify it!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '',
            confirmButtonText: 'Yes, I am sure!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'function_winner.php?winner_losser',
                    type: 'POST',
                    data: {ids:ids,ids2:ids2,winner:winner},
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {   
                        // alert(data);
                        if(data=='invalid')
                        {
                            swal_message('error','Unable to tag winner! It is not yet time of the match schedule');
                        }
                        else
                        {
                            swal_message('success','Winner successfully tagged');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                        }   
                    }
                });
            }
            })
    }
}