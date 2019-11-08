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
                            <label for="usr">Department:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="dept">
                        </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="row mt-2">
                        <div class="col-md-6 text-primary">  
                            <label for="usr">Class:</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="class">
                        </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="row mt-2">
                    <div class="col-md-6 text-primary">  
                        <label for="usr">Pg/Ug:</label>
                    </div>
                    <div class="col-md-6">
                        <select name="" id="grad" class="form-control">
                            <option value="PG">PG</option>
                            <option value="UG">UG</option>
                        </select>
                    </div>
             </div>
             
        </div>
        <div class="col-md-12 mt-4">
            <button class="btn btn-success mx-auto d-block w-50" id="adddept"> Add Department</button>
        </div>
    </div>
    </div>
 </div>
<!-- user details views -->
 <div class="container mt-4">
     <p class="text-light bg-primary px-5 py-2" style="border-radius:30px;">USER LOGIN DETAILS</p>
 </div>
 <div class="container mt-4">
   
 <div class="container">
    <table class="table table-bordered table-hover table-striped" id="depttbl">
        
    </table>
 </div>


 <script src="css/js/jquery-3.4.1.js"></script>
<script >
    $(document).ready(function(){
		// showUser();
        showdept();
		//Add New
		$(document).on('click', '#adddept', function(){
            if ($('#dept').val()=="" || $('#grad').val()=="")
            {
				alert('Please insert Department Name and Grade');
			}
            else
            {
			 $dept=$('#dept').val();	
             $grad=$('#grad').val();	
             $class = $('#class').val();
				$.ajax({
					type: "POST",
					url: "inserting/department.php",
					data: {
                        dept: $dept,
                        grad : $grad,
                        class:$class, 
						add: 1,
					},
					success: function(){
                        showdept();
                        $('#dept').val('');	
                        $('#grad').val('');	
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
					url: "inserting/department.php",
					data: {
						id: $id,
						del: 1,
					},
					success: function(){
						showdept();
                        alert("Deleted the year");

					}
				});
            } 
            
        });

        function showdept(){
            $.ajax({
					type: "POST",
					url: "inserting/department.php",
					data: {
                        showdept:1
					},
					success: function(response){
                        $('#depttbl').html(response)
					}
				});
        }

        
        
    });
</script>
