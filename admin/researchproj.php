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
include 'inserting/classes.php';
if(isset($_GET['yearid']) and ($_GET['monthid'])){
    
    $yearid = $_GET['yearid'];
    $monthid = $_GET['monthid'];
    $deptid=$_GET['deptid'];
    $year = new Year();
    $yearname = $year->displayYear($yearid);
    $monthname = $year->displayMonth($monthid,$yearid);
    $monthnum=$year->displayMonthNum($monthid,$yearid);
    
} 
   

 ?>
  <div class="container mt-4">
    <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Note!</strong> Click on the report to download the event report. <br>
  
    </div>
 </div>
<div class="container mt-4 ">
     <div class="row">
     <div class="col-md-6">
             <a href="admin-year.php?deptid=<?=$deptid?>" class="text-info bg-light p-2">YEAR <?= $yearname ?></a> &gt; <a href="admin-month.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>" class="text-info bg-light p-2"> MONTH <?= $monthname ?></a> &gt; <a href="" class="text-info bg-light p-2">RESEARCH PROJECTS</a>
        </div>
        <div class="col-md-6">
            <a href="list-event-details.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>&amp;monthid=<?= $monthid ?>" class="bg-dark text-light p-2 d-block ml-auto w-25" > << GO BACK</a>
        </div>
     </div>
 </div>
 <section class="container-fluid mt-5">
    <div class="row">
        <!-- PROGRAMME STATS -->
        <div class="col-md-3">
            <?php include 'programmestat.php' ?>
            </div>
        </div>
    
        <!-- Programme Details -->
        <div class="col-md-9">
            <div class="container">
                
            </div>
            <div class="container">
                    <div class="card">
                        <div class="card-header">
                             <h6>Research Projects</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered  table-striped p-0 m-0" id="restbl">
                               
                            </table>
                        </div>
                        <div class="card-footer p-0 bg-primary">
                        <a href="" class="btn d-block w-100 mx-auto" data-toggle="modal" data-target="#myModal">ADD</a>
                                            </div>
                        <?php include 'inserting/insertresearch.php' ?>
                        <input type="text" hidden class="form-rounded-1" value="<?= $yearid?>" id="tyearid">
						<input type="text" hidden class="form-rounded-1" value="<?= $monthid ?>" id="tmonthid">
                        <input type="hidden" id="addeptid" value="<?=$_GET['deptid']?>">

                    </div>
                </div>
        </div>
    </div>
 </section>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 <script >

$(document).ready(function(){

    showresearch();
        //Add New
        $(document).on('click','#addresearch', function(){
            if ($('#rtitle').val()=="" || $('#rpi').val()=="" || $('#rfa').val()=="" || $('#ras').val()=="" || $('#rfrom').val()=="" || $('#rend').val()=="" || $('#rstatus').val()=="" )
            {
                  alert('Please insert all values');
            }
            else
            {
            
                $rtitle=$('#rtitle').val();
                $rpi=$('#rpi').val();
                $rfa=$('#rfa').val();
                $ras=$('#ras').val();
                $rfrom=$('#fdateyear').val()+'-'+$('#fdatemonth').val()+'-'+$('#fdateday').val();
                $rend=$('#tdateyear').val()+'-'+$('#tdatemonth').val()+'-'+$('#tdateday').val();
                $rstatus=$('#rstatus').val();
              
                $yearid=$('#adyearid').val();
                $monthid=$('#admonthid').val();
                $deptid=$('#addeptid').val();
                $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        rtitle:$rtitle,
                        rpi:$rpi,
                        rfa:$rfa,
                        ras:$ras,
                        rfrom:$rfrom,
                        rend:$rend,
                        rstatus:$rstatus,
                        yearid:$yearid,
                        monthid:$monthid,
                        deptid:$deptid,
                        // status : 'enable', 
                        addr: 1,
                    },
                    success: function(){
                        showresearch();
            
                    // $('#rtitle').val()=="" || $('#rpi').val()=="" || $('#rfa').val()=="" || $('#ras').val()=="" || $('#rfrom').val()=="" || $('#rend').val()=="" || $('#rstatus').val()=="" 

                        alert('Successfully added!');
                         $("#myModal").modal("hide");
                    }
                });
               
            }
            
        });

        $(document).on('click', '.deleteresearch', function(){
            $id=$(this).val();

            var r = confirm("are you sure!");
            if (r == true) {
              $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $id,
                        delres: 1,
                    },
                    success: function(){
                        showresearch();
                    }
                });
            } 
                
        });


        $(document).on('click', '.editres', function(){
            $id=$(this).val();
              $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $id,
                       editres:1,
                       
                    },
                    success: function(){
                        showachievement();
                    }
                });
             
                
        });

        function showresearch(){
            $yearid=$('#tyearid').val();
                $monthid=$('#tmonthid').val();
                    $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        yearid:$yearid,
                        monthid:$monthid,
                        showresearch: 1,
                    },
                    success: function(response){
                            $('#restbl').html(response);
                            $(".mod").modal("hide");
                        }
                });
            }




            $(document).on('click','.editresearch', function(){
                $uid=$(this).val();
                
            $('#editres'+$uid).modal('hide');
            $('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
            if ($('#ertitle').val()=="" || $('#erpi').val()=="" || $('#erfa').val()=="" || $('#eras').val()=="" || $('#erstatus').val()=="" )
            {
                  alert('Please insert all values');
            }
            else
            {
            
                $rtitle=$('#ertitle'+$uid).val();
                $rpi=$('#erpi'+$uid).val();
                $rfa=$('#erfa'+$uid).val();
                $ras=$('#eras'+$uid).val();
                $rfrom=$('#efrom'+$uid).val();
                $rend=$('#eend'+$uid).val();
                $rstatus=$('#erstatus'+$uid).val();
                $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $uid,
                        rtitle:$rtitle,
                        rpi:$rpi,
                        rfa:$rfa,
                        ras:$ras,
                        // rfrom:$rfrom,
                        // rend:$rend,
                        rstatus:$rstatus,
                        status : 'enable', 
                        editr: 1,
                    },
                    success: function(){
                        showresearch();
            
                        // $('#ertitle').val()=="" || $('#erpi').val()=="" || $('#erfa').val()=="" || $('#eras').val()=="" || $('#erstatus').val()==""
                        alert('Successfully added!');
                      
                    }
                });
               
            }
            
        });


        $(document).on('click', '#resourceverify', function(){
			$uid=$(this).val();
            $('#editres'+$uid).modal('hide');
            $('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
            if ($('#ertitle').val()=="" || $('#erpi').val()=="" || $('#erfa').val()=="" || $('#eras').val()=="" || $('#erstatus').val()=="" )
            {
                  alert('Please insert all values');
            }
            else
            {
               
                $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $uid,
                        status : 'enable', 
                        verifyresearch: 1,
                    },
                    success: function(){
                        $('#ertitle').val()=="" || $('#erpi').val()=="" || $('#erfa').val()=="" || $('#eras').val()=="" || $('#erstatus').val()==""
                        
                        alert('Successfully verified');
                      
                      
                        showresearch();
                       
                    }
            });
            }
        });



    });
        


 </script>
 <?php include 'includes/footer.php' ?>