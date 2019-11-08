<?php 
include 'includes/session.php';
if($_SESSION['role'] == 'Admin'){
include 'includes/header.php';
include 'includes/nav-bar.php';
}
else
{
include 'includes/header.php';
include 'includes/nav-bar-staff-student.php';
} 
include 'inserting/confiq.php';
 ?>
 <div class="container mt-4">
    <!-- <h1 class="d-inline">Welcome,</h1><p class="d-inline">Admin</p> -->
 </div>
 <div class="container mt-4">
     <p class="text-light bg-primary px-5 py-2" style="border-radius:30px;">ADD USER LOGIN DETAILS</p>
 </div>
 <div class="container px-4">
    <div class="card p-3">
    <div class="row">
        <div class="col-md-6">
            <div class="row mt-2">
                        <div class="col-md-6 text-primary">  
                            <label for="usr">Username:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username">
                        </div>
            </div>
            <!-- <div class="row mt-2">
                        <div class="col-md-6 text-primary">  
                            <label for="usr">UserId:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="userid">
                        </div>
            </div> -->
            <div class="row mt-2">
                        <div class="col-md-6 text-primary">  
                            <label for="usr">Department:</label>
                            <p class="text-danger">*If department not found cilck here!</p>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="dept" >
                            <?php 
                                $sql = "SELECT deptid,deptname, graduation,Class FROM department ";
                                $result = mysqli_query($conn, $sql);    
                                if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?= $row['deptid']?>"><?= $row['deptname']?> [<?= $row['graduation']?>] <?= $row['Class'] ?></option>
                            <?php 
                                }
                            }
                            ?>
                                
                            </select>
                        </div>
            </div>
            <div class="row mt-2 mb-5">
                        <div class="col-md-6 text-primary">  
                            <label for="usr">Role:</label>
                            
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="role">
                                <option>Staff</option>
                                <option>Student</option>
                                <option>Admin</option>
                                
                            </select>
                        </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row mt-2">
                    <div class="col-md-6 text-primary">  
                        <label for="usr">Password:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="pass">
                    </div>
             </div>
             <div class="row mt-2">
                    <div class="col-md-6 text-primary">  
                        <label for="usr"> Confirm Password:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="cpass">
                    </div>
             </div>
             <div class="row mt-2">
                    <div class="col-md-6 text-primary">  
                        <label for="usr"> Status:</label>
                    </div>
                    <div class="col-md-6">
                    <select class="form-control" id="status">
                                <option value="Enable">Enable</option>
                                <option value="Disable">Disable</option>
                                                           
                            </select>
                    </div>
             </div>
        </div>
        <div class="col-md-12">
            <button href="" class="btn btn-success mx-auto d-block w-50" id="adduser"> Add User</button>
        </div>
    </div>
    </div>
 </div>
<!-- user details views -->
 <div class="container mt-4">
     <p class="text-light bg-primary px-5 py-2" style="border-radius:30px;">USER LOGIN DETAILS</p>
 </div>
 <div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
            <select class="form-control" id="deptid">
            <?php 
                                $sql = "SELECT deptid,deptname, graduation FROM department ";
                                $result = mysqli_query($conn, $sql);    
                                if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?= $row['deptid']?>"><?= $row['deptname']?></option>
                            <?php
                                }
                            }
                            ?>
                            </select>
                <div class="input-group-append">
                    <button class="btn btn-success " id="sortdept" >Filter</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
            <select class="form-control" id="sorole">
                                <option value="all">Select Role</option>
                                <option value="Student">Student</option>
                                <option value="Staff">Staff</option>
                                
                            </select>
                <div class="input-group-append">
                    <button class="btn btn-success" id="sortrole">Filter</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="seruser" placeholder="Enter userId">
                <div class="input-group-append">
                    <button class="btn btn-info" id="searchuser">Search</button>
                </div>
            </div>
        </div>
    </div>
 </div>
 <div class="container">
    <table class="table table-bordered table-hover table-striped    " id="usertbl">
       
    </table>
 </div>


 <script src="css/js/jquery-3.4.1.js"></script>
<script >
    $(document).ready(function(){
		// showUser();
        showuser();
		//Add New
		$(document).on('click', '#adduser', function(){
            if ($('#username').val()=="" || $('#userid').val()=="" || $('#pass').val()=="" )
            {
				alert('Please insert all the details!!');
            }
            else if($('#pass').val() == $('#cpass').val()=="")
            {
                alert('Password and confirm password are not equal');
            }
            else
            {
                $username=$('#username').val();	
                // $userid=$('#userid').val();	
                $dept=$('#dept').val();
                $role=$('#role').val();	
                $pass=$('#pass').val();
                $status=$('#status').val();			
				$.ajax({
					type: "POST",
					url: "inserting/user.php",
					data: {
                        username: $username,
                        // userid :$userid,
                        dept:$dept,
                        role:$role,
                        pass:$pass,
                        status:$status,
						add: 1,
					},
					success: function(){
                        showuser();
                        $('#username').val('');	
                        // $('#userid').val('');	
                        // $('#dept').val('');	
                        // $('#role').val('');	
                        $('#pass').val('');	
                        // $('#status').val('');	
                        $('#cpass').val('');	
                        alert('Successfully added!');
					}
				});
            }
            // function showuser(){

            // }
        });

        $(document).on('click','.edit',function()
        {
            var r = confirm("Are you sure!!! you want to Update???");
            if (r == true) {
                $id=$(this).val();
                $statusid = '#updatestat'+$id;
                $status=$($statusid).val();
                $.ajax({
                    type: "POST",
                    url: "inserting/user.php",
                    data: {
                        id: $id,
                        status : $status,
                        edit: 1,
                    },
                    success: function(){
                        showuser();
                        alert("Successfully Updated the User");

                    }
                });
            } 

            });

            $(document).on('click','.pass',function()
        {
            var r = confirm("Are you sure!!! you want to Reset???");
            if (r == true) {
                $id=$(this).val();
                $statusid = '#updatepass'+$id;
                $status=$($statusid).val();
                $.ajax({
                    type: "POST",
                    url: "inserting/user.php",
                    data: {
                        id: $id,
                        status : $status,
                        edit: 1,
                    },
                    success: function(){
                        showuser();
                        alert("Successfully Updated the User");

                    }
                });
            } 

            });


        $(document).on('click','.delete',function(){

            var r = confirm("Are you sure!!! you want to delete???");
            if (r == true) {
                $id=$(this).val();
				$.ajax({
					type: "POST",
					url: "inserting/user.php",
					data: {
						id: $id,
						del: 1,
					},
					success: function(){
						showuser();
                        alert("Deleted the year");

					}
				});
            } 
            
        });

       $(document).on('click','#sortdept',function(){
        $deptid=$('#deptid').val();
            $.ajax({
					type: "POST",
					url: "inserting/user.php",
					data: {
                        deptid: $deptid,
                        showuser:1
					},
					success: function(response){
                        $('#usertbl').html(response)
					}
				});
       });
       $(document).on('click','#search',function(){
            $userid = $('#sorole').val();
            //    if($role.val()=='all'){
            //        location.reload();
            //    }
                $.ajax({
                        type: "POST",
                        url: "inserting/user.php",
                        data: {
                            userid:$userid,
                            showuser:1
                        },
                        success: function(response){
                            $('#usertbl').html(response)
                        }
                    });
       });
       $(document).on('click','#searchuser',function(){
        $role = $('#seruser').val();
            $.ajax({
					type: "POST",
					url: "inserting/user.php",
					data: {
                        user:$role,
                        showuser:1
					},
					success: function(response){
                        $('#usertbl').html(response)
					}
				});
       });

       $(document).on('click','#sortrole',function(){
           $role = $('#sorole').val();
        //    if($role.val()=='all'){
        //        location.reload();
        //    }
            $.ajax({
					type: "POST",
					url: "inserting/user.php",
					data: {
                        role:$role,
                        showuser:1
					},
					success: function(response){
                        $('#usertbl').html(response)
					}
				});
       });

        function showuser(){
            $.ajax({
					type: "POST",
					url: "inserting/user.php",
					data: {
                        showuser:1
					},
					success: function(response){
                        $('#usertbl').html(response)
					}
				});
        }

        
        
    });
</script>
