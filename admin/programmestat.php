<?php 
            if(isset($_GET['deptid'])&&isset($_GET['yearid'])&&isset($_GET['monthid']))
            {
                $countint=mysqli_query($conn,"SELECT count(*) as total from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and typeofprogramme ='Interactive' and verified =0 ");
                $unverifiedint=mysqli_fetch_assoc($countint);
                
                $totint=mysqli_query($conn,"SELECT count(*) as total from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and typeofprogramme ='Interactive'");
                $totverifiedint=mysqli_fetch_assoc($totint);

                $countcons=mysqli_query($conn,"SELECT count(*) as total from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and typeofprogramme ='Constructive' and verified =0 ");
                $unverifiedcons=mysqli_fetch_assoc($countcons);
                
                $totcons=mysqli_query($conn,"SELECT count(*) as total from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and typeofprogramme ='Constructive'");
                $totverifiedcons=mysqli_fetch_assoc($totcons);

                $countex=mysqli_query($conn,"SELECT count(*) as total from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and typeofprogramme ='experiential' and verified =0 ");
                $unverifiedex=mysqli_fetch_assoc($countex);
                
                $totex=mysqli_query($conn,"SELECT count(*) as total from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and typeofprogramme ='experiential'");
                $totverifiedex=mysqli_fetch_assoc($totex);

                
            }
        ?>
          
                <div class="card p-2">
                    <h4 class="font-weight-light text-center text-primary">PROGRAMME STATS MONTH </h4>
                    <h3 class="text-danger text-center mt-2"><?= $monthname ?></h3>    
                    <div class="card " style="border-radius:10px;background: #473DD9;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    ">
                        <div class="card-body text-center p-0 pb-2" >
                            <h6 class="text-white py-2">Constructive Programme</h6>
                            <p class="text-white m-0"><span class="badge badge-light">Total</span> <span class="badge badge-light"> <?= $totverifiedcons['total'] ?></span> <span class="badge badge-danger">Unverified</span><span class="badge badge-danger"> <?= $unverifiedcons['total']?></span></p>
                            
                        </div>
                        
                    </div>
                <div class="card mt-2" style="border-radius:10px;background: #473DD9;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                ">
                    <div class="card-body text-center p-0 pb-2" >
                        <h6 class="text-white py-2">Inteactive Programme</h6>
                        <p class="text-white m-0"> <span class="badge badge-light">Total</span> <span class="badge badge-light"><?= $totverifiedint['total'] ?></span> <span class="badge badge-danger">Unverified</span><span class="badge badge-danger"><?= $unverifiedint['total'] ?></span></p>
                        
                    </div>
                    
                </div>

                <div class="card mt-2" style="border-radius:10px;background: #473DD9;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                ">
                    <div class="card-body text-center p-0 pb-2" >
                        <h6 class="text-white py-2">Experiential Programme</h6>
                        <p class="text-white m-0"> <span class="badge badge-light">Total</span> <span class="badge badge-light"><?= $totverifiedex['total'] ?></span> <span class="badge badge-danger">Unverified</span> <span class="badge badge-danger"><?= $unverifiedex['total'] ?></span></p>
                    
                    </div>
                   
                </div>

                <div class="card mt-2" style="border-radius:10px;background: #473DD9;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                ">
                    <div class="card-body text-center p-0 pb-2" >
                        <h6 class="text-white py-2">Faculty Achievements <span class="badge badge-success"> Total </span> <span class="badge badge-light"><?= $year->FacAchCount($yearid,$monthid,$deptid) ?></span></h6>
    
                    </div>
                   
                </div>

                <div class="card mt-2" style="border-radius:10px;background: #473DD9;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                ">
                    <div class="card-body text-center p-0" >
                        <h6 class="text-white py-2">Student Achievements <span class="badge badge-success"> Total </span> <span class="badge badge-light"><?= $year->StuAchCount($yearid,$monthid,$deptid) ?></span></h6>
    
                    </div>
                   
                </div>

                <div class="card mt-2" style="border-radius:10px;background: #473DD9;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to top, #004e92, #473DD9);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to top, #004e92, #473DD9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                ">
                    <div class="card-body text-center p-0 " >
                        <h6 class="text-white py-2">InterCollegiate fest Achievements <span class="badge badge-success"> Total </span> <span class="badge badge-light"><?= $year->FestCount($yearid,$monthid,$deptid) ?></span></h6>
    
                    </div>
                   
                </div>
          