<?php 
include 'includes/session.php';
 include 'inserting/confiq.php';
 include_once 'inserting/classes.php';

if(isset($_GET['yearid']) and ($_GET['monthid'])){
    $yearid = $_GET['yearid'];
    $monthid = $_GET['monthid'];
    $deptid=$_GET['deptid'];
    $type=$_GET['type'];
    $year = new Year();
    $yearname = $year->displayYear($yearid);
    $monthname = $year->displayMonth($monthid,$yearid);
    $monthnum = $year->displayMonthNum($monthid,$yearid);

}
include 'includes/header.php';
include 'includes/nav-bar.php';


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
             <a href="admin-year.php?deptid=<?=$deptid?>" class="text-info bg-light p-2">YEAR <?= $yearname ?></a> &gt; <a href="admin-month.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>" class="text-info bg-light p-2"> MONTH <?= $monthname ?></a> &gt; <a href="" class="text-info bg-light p-2"><?= $type?> ACHIEVEMENTS</a>
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
                             <h6 class="text-uppercase"><?= $type ?> ACHEIVEMENTS PROGRAMME</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered  table-striped p-0 m-0" id="achtbl">
                                
                            </table>
                        </div>
                        <div class="card-footer p-0 bg-primary">
                            <button class="btn d-block w-100 mx-auto" data-toggle="modal" data-target="#myModal" >ADD</button>
                        </div>
                        <?php include 'inserting/insertacheivment.php' ?>
                        <input type="hidden"  class="form-rounded-1" value="<?=$yearid?>" id="tyearid">
						<input type="hidden"  class="form-rounded-1" value="<?=$monthid?>" id="tmonthid">
                        <input type="hidden" name="" value="<?=$deptid ?>" id="tdeptid">
                        <input type="hidden" value="<?=$type ?>" id="ttype">

                    </div>
                </div>
        </div>
    </div>
 </section>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 <script >
    $(document).ready(function(){
         // showUser();
        showachievement(); 
        //Add New
        $(document).on('click','#addacheiment', function(){
            if ($('#adachparticipant').val()=="" || $('#adachby').val()=="" || $('#adachpapertitle').val()=="" || $('#adachprogramtitle').val()=="" || $('#adachpname').val()=="" || $('#adachvenue').val()=="" || $('#adachduration').val()=="" || $('#adachto').val()=="" || $('#adachfrom').val()=="" || $('#adachtndays').val()=="" )
            {
                  alert('Please insert all values');
            }
            else
            {
            
                $achtndays=$('#adachtndays').val();
                $achfrom=$('#fdateyear').val()+'-'+$('#fdatemonth').val()+'-'+$('#fdateday').val();
                $achto=$('#tdateyear').val()+'-'+$('#tdatemonth').val()+'-'+$('#tdateday').val();
                $achpname=$('#adachpname').val();
                $achduration=$('#adachduration').val();
                $achvenue=$('#adachvenue').val();
                $achby=$('#adachby').val();
                $achprogramtitle=$('#adachprogramtitle').val();
                $achpapertitle=$('#adachpapertitle').val();
                $achparticipant=$('#adachparticipant').val();
                $yearid=$('#tyearid').val();
                $monthid=$('#tmonthid').val();
                $deptid = $('#tdeptid').val();
                $.ajax({
                    type: "POST",
                    url: "inserting/achievements/insert.php",
                    data: {
                        
                        achtndays:$achtndays,
                        achfrom:$achfrom,
                        achto:$achto,
                        achpname:$achpname,
                        achduration:$achduration,
                        achvenue:$achvenue,
                        achby:$achby,
                        achprogramtitle:$achprogramtitle,
                        achpapertitle:$achpapertitle,
                        achparticipant:$achparticipant,
                        yearid:$yearid,
                        monthid:$monthid,
                        deptid:$deptid,
                        status : 'enable', 
                        add: 1,
                    },
                    success: function(){
                        showachievement();
                        $('#achparticipant').val(''); 
                        $('#achby').val('');
                        $('#achpapertitle').val('');
                        $('#achprogramtitle').val('');
                        $('#achpname').val('');
                        $('#achvenue').val('');
                        $('#achduration').val('');
                        $('#achto').val('');
                        $('#achfrom').val('');
                        $('#achtndays').val(''); 
                        alert('Successfully added!');
                        // location.reload();
                         $("#myModal").modal("hide");
                    }
                });
               
            }
            
        });
        

            $(document).on('click', '.Deletestudent', function(){
            $id=$(this).val();

            var r = confirm("Do you want to delete!");
            if (r == true) {
              $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $id,
                        delstudent: 1,
                    },
                    success: function(){
                        showachievement();
                    }
                });
            } 
                
        });
        $(document).on('click', '.editstudent', function(){
            $id=$(this).val();
              $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $id,
                       editstudent:1,
                       
                    },
                    success: function(){
                        showachievement();
                    }
                });
             
                
        });
        
   

    //update
    $(document).on('click', '.updateacheiment', function(){
			$uid=$(this).val();
            $('#editstudent'+$uid).modal('hide');
            $('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
            if ($('#achparticipant').val()=="" || $('#achby').val()=="" || $('#achpapertitle').val()=="" || $('#achprogramtitle').val()=="" || $('#achpname').val()=="" || $('#achvenue').val()=="" || $('#achduration').val()=="" || $('#achto').val()=="" || $('#achfrom').val()=="" || $('#achtndays').val()=="" )
            {
                alert('Please insert all values');
            }
            else
            {
            
                $achtndays=$('#uachtndays'+$uid).val();
                $achfrom=$('#uachfrom'+$uid).val();
                $achto=$('#uachto'+$uid).val();
                $achpname=$('#uachpname'+$uid).val();
                $achduration=$('#uachduration'+$uid).val();
                $achvenue=$('#uachvenue'+$uid).val();
                $achby=$('#uachby'+$uid).val();
                $achprogramtitle=$('#uachprogramtitle'+$uid).val();
                $achpapertitle=$('#uachpapertitle'+$uid).val();
                $achparticipant=$('#uachparticipant'+$uid).val();
                $yearid=$('#uyearid'+$uid).val();
                $monthid=$('#umonthid'+$uid).val();
                $deptid=$('#udeptid'+$uid).val();
                $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $uid,
                        achtndays:$achtndays,
                        achfrom:$achfrom,
                        achto:$achto,
                        achpname:$achpname,
                        achduration:$achduration,
                        achvenue:$achvenue,
                        achby:$achby,
                        achprogramtitle:$achprogramtitle,
                        achpapertitle:$achpapertitle,
                        achparticipant:$achparticipant,
                        yearid:$yearid,
                        monthid:$monthid,
                        deptid:$deptid,
                        status : 'enable', 
                        editstudent: 1,
                    },
                    success: function(){
                        $('#achparticipant').val('');
                        $('#achby').val('');
                        $('#achpapertitle').val('');
                        $('#achprogramtitle').val('');
                        $('#achpname').val('');
                        $('#achvenue').val(''); 
                        $('#achduration').val('');
                        $('#achto').val('');
                        $('#achfrom').val('')
                        $('#achtndays').val(''); 
                        alert('Successfully Updated!');
                        showachievement();
                        // location.reload();                       
                    }
            });
            }
        });

        $(document).on('click', '#verifyacheiment', function(){
			$uid=$(this).val();
            $('#editstudent'+$uid).modal('hide');
            $('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
            if ($('#achparticipant').val()=="" || $('#achby').val()=="" || $('#achpapertitle').val()=="" || $('#achprogramtitle').val()=="" || $('#achpname').val()=="" || $('#achvenue').val()=="" || $('#achduration').val()=="" || $('#achto').val()=="" || $('#achfrom').val()=="" || $('#achtndays').val()=="" )
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
                        verifystudent: 1,
                    },
                    success: function(){
                        $('#achparticipant').val('');
                        $('#achby').val('');
                        $('#achpapertitle').val('');
                        $('#achprogramtitle').val('');
                        $('#achpname').val('');
                        $('#achvenue').val(''); 
                        $('#achduration').val('');
                        $('#achto').val('');
                        $('#achfrom').val('')
                        $('#achtndays').val(''); 
                        alert('Successfully Updated!');
                        location.reload();                   
                        showachievement();
                    }
            });
            }
        });

        function showachievement(){
                $yearid=$('#tyearid').val();
                $monthid=$('#tmonthid').val();
                $deptid=$('#tdeptid').val();
                $type=$('#ttype').val();
                    $.ajax({
                    type: "POST",
                    url: "inserting/achievements/show.php",
                    data: {
                        yearid:$yearid,
                        monthid:$monthid,
                        deptid:$deptid,
                        type:$type,
                        showstudent: 1,
                    },
                    success: function(response){
                            $('#achtbl').html(response);
                            $(".mod").modal("hide");
                        }
                });
            }
            
	});
    


</script>
 <?php include 'includes/footer.php' ?>
 