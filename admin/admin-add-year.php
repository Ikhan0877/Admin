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

$sql = "SELECT yearid,year, status FROM year ";
$result = mysqli_query($conn, $sql);

 ?>
 <div class="container mt-4">
    <!-- <h1 class="d-inline">Welcome,</h1><p class="d-inline">Admin</p> -->
 </div>
 <div class="container mt-4">
     <p class="text-light bg-primary px-5 py-2" style="border-radius:30px;">ADD ACADEMIC YEAR</p>
 </div>
 <div class="container px-4">
    <div class="card p-3">
    
        <!-- <form id="#year" method="post"> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="row mt-2">
                                <div class="col-md-6 text-primary">  
                                    <label for="usr">YEAR:</label>
                                </div>
                                
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="yearval">
                                </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="row mt-2">
                                    <div class="col-md-6 text-primary">  
                                        <label for="usr">Status:</label>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <select name="" id="status" class="form-control">
                                            <option value="Enable">Enable</option>
                                            <option value="Disable">Disable</option>
                                        </select>
                                    </div>
                        </div>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" id="addyear" class="btn btn-success mx-auto d-block w-50"> Add Year</button>
                </div>
            </div>
        <!-- </form> -->
    
    </div>
 </div>
<!-- user details views -->
 <div class="container mt-4">
     <p class="text-light bg-primary px-5 py-2" style="border-radius:30px;">YEAR DETAILS</p>
 </div>
 <div class="container">
    <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>

        If you want to edit year details.. you have delete the year then, Add the correct year.
        <br>
        you can enable and disable the year to restrict the user from adding reports to that year.
    </div>
 </div>
 <div class="container mt-4">
   
 <div class="container">
    <table class="table table-bordered table-hover table-striped" id="yeartbl">
   
        
    </table>
 </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script >
    $(document).ready(function(){
		// showUser();
        showyear();
		//Add New
		$(document).on('click', '#addyear', function(){
            if ($('#yearval').val()=="" && $('#status').val()=="")
            {
				alert('Please insert year and status');
			}
            else
            {
			 $yearval=$('#yearval').val();	
             $status=$('#status').val();	
				$.ajax({
					type: "POST",
					url: "inserting/year.php",
					data: {
                        year: $yearval,
                        status : $status, 
						add: 1,
					},
					success: function(){
                        showyear();
                        // $('#yearval').val()="";	
                        // $('#status').val()="";	
                        alert('Successfully added!');
					}
				});
            }
            // function showuser(){

            // }
        });

        $(document).on('click','.delete',function(){

            var r = confirm("Are you sure!!! you want to delete???");
            if (r == true) {
                $id=$(this).val();
				$.ajax({
					type: "POST",
					url: "inserting/year.php",
					data: {
						id: $id,
						del: 1,
					},
					success: function(){
						showyear();
                        alert("Deleted the year");

					}
				});
            } 
            
        });

        $(document).on('click','.edit',function(){

            var r = confirm("Are you sure!!! you want to Update???");
            if (r == true) {
                $id=$(this).val();
                $statusid = '#updatestat'+$id;
                $status=$($statusid).val();
                $.ajax({
                    type: "POST",
                    url: "inserting/year.php",
                    data: {
                        id: $id,
                        status : $status,
                        edit: 1,
                    },
                    success: function(){
                        showyear();
                        alert("Updated the year");

                    }
                });
            } 

            });


        function showyear(){
            $.ajax({
					type: "POST",
					url: "inserting/year.php",
					data: {
                        showyear:1
					},
					success: function(response){
                        $('#yeartbl').html(response)
					}
				});
        }

        
        
    });
</script>

 <?php include 'includes/footer.php'?>