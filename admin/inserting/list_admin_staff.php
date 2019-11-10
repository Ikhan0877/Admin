<div class="col-md-9">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-primary text-center font-weight-light">INTERACTIVE PROGRAMME</h2>
                    <p class="text-danger">*Please add event details which come undet this category!!</p>
                    <p class="text-info">CONFERENCE / SEMINAR / WORKSHOP / FDP / GUEST LECTURE / MDP / PANEL DISCUSSION </p>
                    
                </div>
                <div class="card-footer p-0">
                    <a class="btn btn-primary w-100 text-white" href="interactive.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=Interactive">ADD / VIEW REPORT</a>
                </div> 
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card ">
                <div class="card-body">
                    <h2 class="text-primary text-center font-weight-light">CONSTRUCTIVE PROGRAMME</h2>
                    <p class="text-danger">*Please add event details which come undet this category!!</p>
                    <p class="text-info">ACADEMIC / CO-CURRICULAR ACTIVITIES / EXHIBITION / CLUB PROGRAMME </p>
                    <br/>
                </div>
                <div class="card-footer p-0">
                    <a class="btn btn-primary w-100 text-white" href="constructive.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=constructive">ADD / VIEW REPORT</a>
                </div> 
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                    <div class="card-body">
                        <h3 class="text-primary text-center font-weight-light">EXPERIENTIAL LEARNING
                        PROGRAMME</h3>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info text-uppercase">(Details of Industrial Visits / Field visits /Internship / Project / any other Students’ Experiential Learning Activities organized): </p>
                        <br/>
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="constructive.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=experiential">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">add-on course's / 
                            training courses offered</h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info">ACADEMIC / CO-CURRICULAR ACTIVITIES / EXHIBITION / CLUB PROGRAMME </p>
                        <br />
                        <br />
                        <br/>
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="addoncourses.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>&amp;typeofprogramme=addoncourse">ADD / VIEW REPORT</a>
                    </div> 
                </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">STUDENT'S ACADEMIC
                                ACHIEVEMENT'S </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info">PAPER PRESENTATION / POSTER PRESENTATION / BUSINESS PLAN / SOFTWARE DEV COMPLETION OF NET / OTHER ACHIEVEMENT'S </p>
                        <br/>
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="acheivements.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $_GET['deptid'] ?>&amp;type=Student">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">FACULTY
                                ACHIEVEMENT'S <br> </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        <p class="text-info">PAPER PRESENTATION / OTHER ACHIEVEMENT'S  </p>
                        <br/>
                        <br/>
                        <br/>
                        <br />
                        <!-- <br/> -->
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="acheivements.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $_GET['deptid'] ?>&amp;type=Faculty">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">Intercollegiate fest <br> </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="intercollfest.php?deptid=<?php $deptid =$_GET['deptid']; if(isset($deptid) ) 
															echo $deptid; else die('Some Error') ?>&amp;yearid=<?php $yearid =$_GET['yearid']; if(isset($deptid) ) 
															echo $yearid; else die('Some Error') ?>&amp;monthid=<?php $monthid =$_GET['monthid']; if(isset($monthid) ) 
															echo $monthid; else die('Some Error') ?>">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">Research <br> projects </h2>
                        <p class="text-danger">*Please add event details which come undet this category!!</p>
                        
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="researchproj.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $deptid ?>">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
        
        <div class="col-md-4 mt-4">
            <div class="card ">
                    <div class="card-body text-center">
                        <h2 class="text-primary text-center font-weight-light text-uppercase">PUBLICATION'S BY FACULTY MEMBERS </h2>
                        <p class="text-danger">*Please add event details which come undet this category!! <br> Book published/Chapter published//Article publshed</p>
                        
                    </div>
                    <div class="card-footer p-0">
                        <a class="btn btn-primary w-100 text-white" href="publishment.php?yearid=<?php echo $row['yearid'] ?>&amp;monthid=<?php echo $row['monthid'] ?>&amp;deptid=<?= $deptid ?>">ADD / VIEW REPORT</a>
                    </div> 
            </div>
        </div>
    </div>
    </div>