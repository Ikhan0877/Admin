<?php 
include 'includes/session.php';
include 'includes/header.php';
include 'includes/nav-bar.php';

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
             <a href="admin-year.php?deptid=<?=$deptid?>" class="text-info bg-light p-2">YEAR <?= $yearname ?></a> &gt; <a href="admin-month.php?deptid=<?=$deptid?>&amp;yearid=<?= $yearid?>" class="text-info bg-light p-2"> MONTH <?= $monthname ?></a> &gt; <a href="" class="text-info bg-light p-2">PUBLISHMENTS</a>
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
                             <h6>Books published</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered  table-striped p-0 m-0" id="achtbl">
                               
                            </table>
                        </div>
                        <div class="card-footer p-0 bg-primary">
                        <a href="" class="btn d-block w-100 mx-auto" data-toggle="modal" data-target="#myModal">ADD</a>
                        </div>
                    </div>
                        <?php include 'inserting/insertpublications.php' ?>
                        <input type="hidden"  class="form-rounded-1" value="<?= $_GET['yearid'] ?>" id="tyearid">
						<input type="hidden"  class="form-rounded-1" value="<?= $_GET['monthid'] ?>" id="tmonthid">
                        <input type="hidden" name="" value="<?= $_GET['deptid'] ?>" id="tdeptid">
                    </div>
                </div>
        </div>
    </div>
 </section>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <?php include 'includes/footer.php' ?>
 <script>
 
 
 $(document).ready(function(){
         // showUser();
    showpublish();
        //Add New
        $(document).on('click','#addpublish', function(){
            if ($('#adtitle').val()=="" || $('#addetail').val()=="" || $('#adtype').val()=="" || $('#addate').val()=="" || $('#adugc').val()=="" || $('#adbiblo').val()=="" || $('#adisbn').val()=="" )
            {
                  alert('Please insert all values');
            }
            else
            {
                $rname=$('#adname').val();                
                $title=$('#adtitle').val();
                $detail=$('#addetail').val();
                $type=$('#adtype').val();
                $date=$('#dateyear').val()+'-'+$('#datemonth').val()+'-'+$('#dateday').val();
                $ugc=$('#adugc').val();
                $biblo=$('#adbiblo').val();
                $isbn=$('#adisbn').val();
                $venue=$('#advenue').val();
                $yearid=$('#adyearid').val();
                $monthid=$('#admonthid').val();
                $deptid=$('#tdeptid').val();
                $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        rname:$rname,                        
                        title:$title,
                        detail:$detail,
                        type:$type,
                        date:$date,
                        ugc:$ugc,
                        biblo:$biblo,
                        isbn:$isbn,
                        venue:$venue,
                        yearid:$yearid,
                        monthid:$monthid,
                        deptid:$deptid,
                        status : 'enable', 
                        addpub: 1,
                    },
                    success: function(){
                        // location.reload();  
                        showpublish();
                        alert('Successfully added!');
                         $("#myModal").modal("hide");
                    }
                });
            }
            
        });
        // delete publications
        $(document).on('click', '.Deletepub', function(){
            $id=$(this).val();
            var r = confirm("Do you want to delete");
            if (r == true) {
              $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $id,
                        delpub: 1,
                    },
                    success: function(){
                        showpublish();
                        // location.reload();  
                    }

                });
            } 
                
        });
        // show publications
        function showpublish(){
                $yearid=$('#tyearid').val();
                $monthid=$('#tmonthid').val();
                $deptid = $('#tdeptid').val();
                    $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        yearid:$yearid,
                        monthid:$monthid,
                        deptid:$deptid,
                        showpub: 1,
                    },
                    success: function(response){
                            $('#achtbl').html(response);
                            $(".mod").modal("hide");
                        }
                });
            }


            $(document).on('click', '.editpub', function(){
            $id=$(this).val();
              $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $id,
                        editpub:1,
                       
                    },
                    success: function(){
                        showpublication();
                        // location.reload();  
                    }
                });
             
                
        });


        $(document).on('click','.updatepub', function(){
            $uid=$(this).val();
            $('#editpub'+$uid).modal('hide');
            $('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
            if ($('#title').val()=="" || $('#detail').val()=="" || $('#type').val()=="" || $('#date').val()=="" || $('#ugc').val()=="" || $('#biblo').val()=="" || $('#isbn').val()=="" )
            {
                  alert('Please insert all values');
            }
            else
            {
            
                $title=$('#title'+$uid).val();
                $detail=$('#detail'+$uid).val();
                $type=$('#type'+$uid).val();
                $date=$('#date'+$uid).val();
                $ugc=$('#ugc'+$uid).val();
                $biblo=$('#biblo'+$uid).val();
                $isbn=$('#isbn'+$uid).val();
                $venue=$('#venue'+$uid).val();
                $yearid=$('#yearid'+$uid).val();
                $monthid=$('#monthid'+$uid).val();

                $.ajax({
                    type: "POST",
                    url: "inserting/insert.php",
                    data: {
                        id: $uid,
                        title:$title,
                        detail:$detail,
                        type:$type,
                        date:$date,
                        ugc:$ugc,
                        biblo:$biblo,
                        isbn:$isbn,
                        venue:$venue,
                        yearid:$yearid,
                        monthid:$monthid,
                        status : 'enable', 
                        updatepub: 1,
                    },
                    success: function(){
                        alert('Successfully added!');
                        // location.reload();               
                        showpublish();
                        
                      
                    }
                });
            }
            
        });


        $(document).on('click', '#pubverify', function(){
            $uid=$(this).val();
            $('#editpub'+$uid).modal('hide');
            $('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
            if ($('#title').val()=="" || $('#detail').val()=="" || $('#type').val()=="" || $('#date').val()=="" || $('#ugc').val()=="" || $('#biblo').val()=="" || $('#isbn').val()=="" )
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
                        verifypub: 1,
                    },
                    success: function(){
                        // $('#title').val()=="" || $('#detail').val()=="" || $('#type').val()=="" || $('#date').val()=="" || $('#ugc').val()=="" || $('#biblo').val()=="" || $('#isbn').val()==""
                        
                        alert('Successfully verified');
                      
                        // location.reload();  
                        showpublish();
                       
                    }
            });
            }
        });
            

 
    });
 
 
 
 </script>