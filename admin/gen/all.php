<?php 
require_once '../vendor/autoload.php';
include '../inserting/confiq.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();

       echo $fromyear=$_GET['fromyear'];
       echo $toyear=$_GET['toyear'];
       echo $frommonth=$_GET['frommonth'];
       echo $tomonth=$_GET['tomonth'];
       echo $deptid=$_GET['deptid'];
       $sql = "SELECT y.yearid, y.year, m.monthid, m.monthname ,d.deptname ,d.graduation,d.class FROM month m, year y , department d where  m.yearid = y.yearid and deptId = $deptid";
       $result = mysqli_query($conn, $sql);
       
       while($row =  mysqli_fetch_assoc($result)) {
            // $temp = $row['monthname'];
            $year = $row['year'];
            $deptname = $row['deptname'];
            $grad = $row['graduation'];
       }
        $section = $phpWord->addSection();
        $header = array('name'=> 'Times New Roman','size' => 12, 'bold' => true);
        $normal =array('name' => 'Times New Roman', 'size' => 10);
        // 1. Basic table
        $section->addImage('../kjclogo.PNG',array( 'width'=> 200, 'height' => 50, 'marginLeft' => 100,'align'=>'both') );
        $section->addText('Report submitted to the Internal Quality Assurance Cell for the year '.$year,array('bold' => true));
        $section->addText($deptname.'['.$grad.']',array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));
      
// checking for interactive programme is present or not.
    // $interactives= "select * from programmes WHERE fromdate >= '20190101' AND fromdate <= '20190201' and deptid = '$deptid' and typeofprogramme = 'Interactive'";

        $interactives= "select * from programmes WHERE fromdate >= '$fromyear$frommonth"."01' AND fromdate <= '$toyear$tomonth"."01' and deptid = '$deptid' and typeofprogramme = 'Interactive'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
            // output data of each row
            $section->addText('I. Interactive Programmes:',$header);
            $section->addText('Major Academic Activities (Conference / Seminar / Workshop / FDP / Guest Lecture/ MDP/Panel discussions*] organized by the department',$normal);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $cell1 = $table->addCell(2000, $cellRowSpan);
            $textrun1 = $cell1->addTextRun($cellHCentered);
            $textrun1->addText('Si No.',array('bold'=> true));

            $table->addCell(2000, $cellRowSpan)->addText('Date of the Event DD/MM/YY', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of the event organized', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name of the Resource Person/s with designation', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Type of Event*', array('bold'=> true), $cellHCentered);

            $cell2 = $table->addCell(4000, $cellColSpan);
            $textrun2 = $cell2->addTextRun($cellHCentered);
            $textrun2->addText('No of Participants
            ',array('bold'=> true));
            $table->addRow();
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(2000, $cellVCentered)->addText('Internal', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellVCentered)->addText('External', array('bold'=> true), $cellHCentered);
            
            while($int = mysqli_fetch_assoc($intresult)) {
                $i=1;
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['fromdate'], array('bold'=> true), $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], array('bold'=> true), $cellHCentered);
                $id = $int['resourcepersonid'];
                $res_det= "select * from reasource where resourcepersonid = '$id' ";
                $res_det_result = mysqli_query($conn, $res_det);
                if (mysqli_num_rows($res_det_result) > 0) {
                        while($res = mysqli_fetch_assoc($res_det_result)) 
                        {
                            $table->addCell(2000, $cellRowSpan)->addText($res['name'].' '.$res['details'], null, $cellHCentered);
                        }
                    }
                $table->addCell(2000, $cellRowSpan)->addText($int['type'], null, $cellHCentered);
                $table->addCell(2000, $cellVCentered)->addText($int['Internalcount'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['externalcount'], null, $cellHCentered);
                $i++;
            }
        }
        else{
            echo("Error description: " . mysqli_error($conn));
        }
        // check if the constructive programme is there or not.
        $interactives= "select * from programmes where fromdate >= '".$fromyear.$frommonth."01' AND fromdate <= '".$toyear.$tomonth."01' and deptid = '$deptid' and typeofprogramme = 'constructive'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
            // output data of each row
            $section->addText('I. Constructive Programmes:',$header);
            $section->addText('Academic and co-curricular Activities ( Exhibition/ Intra and Inter collegiate Fests / club programmes*) organized by the department',$normal);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $cell1 = $table->addCell(2000, $cellRowSpan);
            $textrun1 = $cell1->addTextRun($cellHCentered);
            $textrun1->addText('Si No.');

            $table->addCell(2000, $cellRowSpan)->addText('Date of the Event DD/MM/YY', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of the event organized', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name of the Resource Person/s with designation', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Type of Event*', array('bold'=> true), $cellHCentered);

            $cell2 = $table->addCell(4000, $cellColSpan);
            $textrun2 = $cell2->addTextRun($cellHCentered);
            $textrun2->addText('No of Participants
            ',array('bold'=> true));
            $table->addRow();
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(2000, $cellVCentered)->addText('Internal', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellVCentered)->addText('External', array('bold'=> true), $cellHCentered);
            
            while($int = mysqli_fetch_assoc($intresult)) {
                $i=1;
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['fromdate'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);
                $id = $int['resourcepersonid'];
                $res_det= "select * from reasource where resourcepersonid = '$id' ";
                $res_det_result = mysqli_query($conn, $res_det);
                if (mysqli_num_rows($res_det_result) > 0) {
                        while($res = mysqli_fetch_assoc($res_det_result)) 
                        {
                            $table->addCell(2000, $cellRowSpan)->addText($res['name'].' '.$res['details'], null, $cellHCentered);
                        }
                    }
                $table->addCell(2000, $cellRowSpan)->addText($int['type'], null, $cellHCentered);
                $table->addCell(2000, $cellVCentered)->addText($int['Internalcount'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['externalcount'], null, $cellHCentered);
                $i++;
            }
        }

        // check if there is any experiential programme
        $interactives= "select * from programmes where fromdate >= '".$fromyear.$frommonth."01' AND fromdate <= '".$toyear.$tomonth."01' and deptid = '$deptid' and typeofprogramme = 'experiential'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
            // output data of each row
            $section->addText('III. Experiential Programmes:',$header);
            $section->addText('(Details of Industrial Visits / Field visits /Internship / Project / any other Students’ Experiential Learning Activities organized):',$normal);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $cell1 = $table->addCell(2000, $cellRowSpan);
            $textrun1 = $cell1->addTextRun($cellHCentered);
            $textrun1->addText('Si No.');

            $table->addCell(2000, $cellRowSpan)->addText('Date of the Event DD/MM/YY', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Nature of the event*', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Venue', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name of the student/Total number of beneficiaries', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Learning Outcome', array('bold'=> true), $cellHCentered);            
            while($int = mysqli_fetch_assoc($intresult)) {
                $i=1;
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['fromdate'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['venue'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);
                
                $table->addCell(2000, $cellRowSpan)->addText($int['partcipantsdetails'], null, $cellHCentered);
                $table->addCell(2000, $cellVCentered)->addText($int['outcome'], null, $cellHCentered);
                // $table->addCell(2000, $cellRowSpan)->addText($int['externalcount'], null, $cellHCentered);
                $i++;
            }
        }
        
        //filter only add on courses
        $interactives= "select * from programmes where fromdate >= '".$fromyear.$frommonth."01' AND fromdate <= '".$toyear.$tomonth."01' and deptid = '$deptid' and typeofprogramme = 'addoncourse'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
            // output data of each row
            $section->addText('IV. Add-on courses / Training programmes offered by the department',$header);
            // $section->addText('(Details of Industrial Visits / Field visits /Internship / Project / any other Students’ Experiential Learning Activities organized):',$normal);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $cell1 = $table->addCell(2000, $cellRowSpan);
            $textrun1 = $cell1->addTextRun($cellHCentered);
            $textrun1->addText('Si No.',array('bold'=> true));
            $table->addCell(2000, $cellRowSpan)->addText('Nature of the course [Certificate/ VAC / Training programme]', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of the  course', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Purpose*', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Date and Duration', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Resource person / Faculty in charge', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Number Enrolled', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('No of students completing the course', array('bold'=> true), $cellHCentered);
            while($int = mysqli_fetch_assoc($intresult)) {
                $i=1;
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['natureofevent'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['purpose'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText($int['fromdate'].' '.$int['duration'], null, $cellHCentered);
                $id = $int['resourcepersonid'];
                $res_det= "select * from reasource where resourcepersonid = '$id' ";
                $res_det_result = mysqli_query($conn, $res_det);
                if (mysqli_num_rows($res_det_result) > 0) {
                        while($res = mysqli_fetch_assoc($res_det_result)) 
                        {
                            $table->addCell(2000, $cellRowSpan)->addText($res['name'], null, $cellHCentered);
                        }
                    }
                $table->addCell(2000, $cellRowSpan)->addText($int['Internalcount'], null, $cellHCentered);
                $table->addCell(2000, $cellVCentered)->addText($int['partcipantsdetails'].' '.$int['Internalcount'], null, $cellHCentered);
                // $table->addCell(2000, $cellRowSpan)->addText($int['externalcount'], null, $cellHCentered);
                $i++;
            }
        }
        // checking for fest details
        $interactives= "select * from fest where fromdate >= '".$fromyear.$frommonth."01' AND fromdate <= '".$toyear.$tomonth."01' and deptid = '$deptid'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
        //     // output data of each row
            $section->addText('V. Achievements at the Intercollegiate Fests ',$header);
            $section->addText('Total number of Overall trophies won in this academic year 2018-2019  ',$normal);
            $section->addText('Winners - ',$normal);
            $section->addText('Runners up-',$normal);
            // $section->addText('(Details of Industrial Visits / Field visits /Internship / Project / any other Students’ Experiential Learning Activities organized):',$normal);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addText('Si No.',array('bold'=> true),$cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Date of the Event', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of Fest', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Host Inst. and Venue', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name of the competition ', array('bold'=> true), $cellHCentered);
             $table->addCell(2000, $cellRowSpan)->addText('Name of the participant (s)', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Prizes won', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Total Participants', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Overall Position [W/R]', array('bold'=> true), $cellHCentered); 
            $i=1;                         
            while($int = mysqli_fetch_assoc($intresult)) {
                
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['fromdate'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['hostinstitude'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText('', null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText('', null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText('', null, $cellHCentered);          
                $table->addCell(2000, $cellRowSpan)->addText($int['totalparticipants'], null, $cellHCentered);
                $table->addCell(2000,$cellRowSpan)->addText($int['prize'],null,$cellHCentered);
                $festid=  $int['festid'];
                    $sql2= "select * from festdet where festid = '$festid' ";
                    $result2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($result2) > 0) 
                    {
                        while($row1 = mysqli_fetch_assoc($result2)) 
                        {
                            $table->addRow();
                            $table->addCell(2000, $cellRowSpan)->addText(' ', null, $cellHCentered);
                            $table->addCell(2000, $cellRowSpan)->addText(' ', null, $cellHCentered);
                            $table->addCell(2000, $cellRowSpan)->addText(' ', null, $cellHCentered);
                            $table->addCell(2000, $cellRowSpan)->addText(' ', null, $cellHCentered);
                            $table->addCell(2000, $cellRowSpan)->addText($row1['eventname'], null, $cellHCentered);                            
                            $table->addCell(2000, $cellRowSpan)->addText($row1['participantsname'], null, $cellHCentered);                            
                            $table->addCell(2000, $cellRowSpan)->addText($row1['position'], null, $cellHCentered); 
                            $table->addCell(2000, $cellRowSpan)->addText(' ', null, $cellHCentered);
                            $table->addCell(2000, $cellRowSpan)->addText(' ', null, $cellHCentered);                           
                        }
                    }
                $i++;
            }
        }
        // checking for students achievements
        $interactives= "select * from achievements where ach_from >= '".$fromyear.$frommonth."01' AND ach_from <= '".$toyear.$tomonth."01' and deptid = '$deptid' and ach_type='Student'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
        
            $section->addText('VI. Students Academic Achievements (Paper/Poster Presentation/ Business Plan/software), Completion of NET/GATE/or other exams]',$header);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addText('Si No.',array('bold'=> true),$cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Date of the Event', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name of the Student', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of the Programme / Venue', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of Paper presented/ Published / Any Other', array('bold'=> true), $cellHCentered);
            $i=1;
            while($int = mysqli_fetch_assoc($intresult)) {
               
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['ach_from'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['participantname'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['ach_name'].','.$int['ach_venue'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText($int['natureofpart'], null, $cellHCentered);
                $i++;
            }
        }

        // check faculy achievements

        $interactives= "select * from achievements where ach_from >= '".$fromyear.$frommonth."01' AND ach_from <= '".$toyear.$tomonth."01' and deptid = '$deptid' and ach_type='Faculty'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
        
            $section->addText('VII.	Details of Faculty members attending Faculty Enrichment Programmes',$header);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addText('Si No.',array('bold'=> true),$cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Date of the Event', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name of the Faculty', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of the Programme (State/National/International)', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Nature of Participation [Resource person/ paper presenter/ participant]', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of paper presented', array('bold'=> true), $cellHCentered);
            
            $i=1;
            while($int = mysqli_fetch_assoc($intresult)) {
               
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['ach_from'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['participantname'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['ach_name'].','.$int['ach_venue'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText($int['natureofpart'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText('', null, $cellHCentered);
                $i++;
            }
        }
        // BOOK
        $section->addText('VIII. Publications by faculty members ',$header);
        $interactives= "select * from publication where date >= '".$fromyear.$frommonth."01' AND date <= '".$toyear.$tomonth."01' and deptid = '$deptid' and pubtype='BOOK'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
        
            
            $section->addText('a. Books published',$header);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addText('Si No.',array('bold'=> true),$cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of Book', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Details of Publisher', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Month, Year of publication, ISSN No', array('bold'=> true), $cellHCentered);
            
            $i=1;
            while($int = mysqli_fetch_assoc($intresult)) {
               
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['publicationname'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['details'].','.$int['ach_venue'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText($int['date'].' '.$int['isbn'], null, $cellHCentered);
                // $table->addCell(2000, $cellRowSpan)->addText('', null, $cellHCentered);
                $i++;
            }
        }
        // chapter OR ARTICLE
        $interactives= "select * from publication where date >= '".$fromyear.$frommonth."01' AND date <= '".$toyear.$tomonth."01' and deptid = '$deptid' and pubtype='CHAPTER' or pubtype='ARTICLE'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
        
            
            $section->addText('b. Articles / Book Chapter',$header);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addText('Si No.',array('bold'=> true),$cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of Article ', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Details of Publisher', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Month, Year of publication, ISSN No', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Bibliography*', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('UGC Approval If yes, Provide No', array('bold'=> true), $cellHCentered);
            
            $i=1;
            while($int = mysqli_fetch_assoc($intresult)) {
               
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['publicationname'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['details'].$int['venue'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText($int['date'].' '.$int['isbn'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['biblimeteric'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['ugc'], null, $cellHCentered);
                $i++;
            }
        }
        // paper publications
        //$section->addText('VIII. Publications by faculty members ',$header);
        $interactives= "select * from publication where date >= '".$fromyear.$frommonth."01' AND date <= '".$toyear.$tomonth."01' and deptid = '$deptid' and pubtype='PAPER'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
        
            
            $section->addText('c.Paper Published',$header);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addText('Si No.',array('bold'=> true),$cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Name', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Title of Book', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Details of Publisher', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Month, Year of publication, ISSN No', array('bold'=> true), $cellHCentered);
            
            $i=1;
            while($int = mysqli_fetch_assoc($intresult)) {
               
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($i, null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['publicationname'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['details'].','.$int['ach_venue'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText($int['date'].' '.$int['isbn'], null, $cellHCentered);
                
                $i++;
            }
        }
        // Status of research projects
        
        $interactives= "select * from researchproject where date >= '".$fromyear.$frommonth."01' AND date <= '".$toyear.$tomonth."01' and deptid = '$deptid'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
        
            
            $section->addText('d. Status of Research Projects undertaken for the month of',$header);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addText('Title',array('bold'=> true),$cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Principal Investigator/ Co-Investigator', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Funding agency', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Duration(start to end dates)', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Amount sanctioned', array('bold'=> true), $cellHCentered);
            $table->addCell(2000, $cellRowSpan)->addText('Status (Completed/ ongoing/applied )', array('bold'=> true), $cellHCentered);

            
            $i=1;
            while($int = mysqli_fetch_assoc($intresult)) {
               
                $table->addRow();
                $table->addCell(2000, $cellRowSpan)->addText($int['title'], null, $cellHCentered);                
                $table->addCell(2000, $cellRowSpan)->addText($int['participantsname'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['fundingagency'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['fromtodate'], null, $cellHCentered);  
                $table->addCell(2000, $cellRowSpan)->addText($int['amount'], null, $cellHCentered);
                $table->addCell(2000, $cellRowSpan)->addText($int['status'], null, $cellHCentered);
                $i++;
            }
        }
        // Individual report
        $section = $phpWord->addSection();
        $header = array('name'=> 'Times New Roman','size' => 12, 'bold' => true);
        $normal =array('name' => 'Times New Roman', 'size' => 10);
        // 1. Basic table
               // $section->addText($,array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'align'=>'both'));        
        // checking for interactive programme is present or not.
        $interactives= "select * from programmes where fromdate >= '".$fromyear.$frommonth."01' AND fromdate < '".$toyear.$tomonth."01' and deptid = '$deptid' and typeofprogramme = 'Interactive'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
            // output data of each row
            
            $section->addText($int,$header);
            $table = $section->addTable();
            $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999','bold'=> true);
            $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
            $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
            $cellVCentered = array('valign' => 'center');
            $spanTableStyleName = 'Colspan Rowspan';
            $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
            $table = $section->addTable($spanTableStyleName);
         


            while($int = mysqli_fetch_assoc($intresult)) {
                // $section->addPageBreak();
                $section->addImage('../kjclogo.PNG',array( 'width'=> 200, 'height' => 50, 'marginLeft' => 100,'align'=>'both') );
                // $section->addText('Report submitted to the Internal Quality Assurance Cell for the month of'.$temp.' '.$year,array('bold' => true));
                $section->addText($deptname.'['.$grad.']',array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'align'=>'both'));

                $section->addText('"'.$int['natureofevent'].'"'.$int['title'],array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'align'=>'both'));
                // $i=1;
                $section->addText('Date                                          :'.$int['fromdate'],array('name' => 'Times New Roman', 'size' => 12,'align'=>'both'));
                $section->addText('Time                                          :'.$int['Time'],array('name' => 'Times New Roman', 'size' => 12,'align'=>'both'));
                $section->addText('Venue                                         :'.$int['venue'],array('name' => 'Times New Roman', 'size' => 12,'align'=>'both'));
                $section->addText('Participants (Name, Roll No, Class)           :'.$int['partcipantsdetails'],array('name' => 'Times New Roman', 'size' => 12,'align'=>'both'));
                $section->addText('Number of beneficiaries                       :'.'Internal Count :'.$int['Internalcount'].'External Count:'.$int['externalcount'],array('name' => 'Times New Roman', 'size' => 12,'align'=>'both'));
              
              
                $id = $int['resourcepersonid'];
                $res_det= "select * from reasource where resourcepersonid = '$id' ";
                $res_det_result = mysqli_query($conn, $res_det);
                if (mysqli_num_rows($res_det_result) > 0) {
                        while($res = mysqli_fetch_assoc($res_det_result)) 
                        {
                            $section->addText('Resource Person                   :'.$res['name'].' '.$res['details'],array('name' => 'Times New Roman', 'size' => 12,'align'=>'both'));
                           
                        }
                    }
                
                $section->addText('Objective'.':',array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'align'=>'both'));
                $section->addText($int['objective'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));
                

                $section->addText('Breif Write up on the session'.':',array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'align'=>'both'));
                $section->addText($int['brief'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));

                $section->addText('Learning Outcome'.':',array('name' => 'Times New Roman','size' => 14,'bold'=>true,'align'=>'both'));
                $section->addText($int['outcome'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));
                
                // $imgid = $int['resourcepersonid'];
                $programmeid=$int['prgmid'];
                $img= "select * from image where `progammedid` = '$programmeid' and `type`='image'";
                $img_result = mysqli_query($conn, $img);
                if (mysqli_num_rows($img_result) > 0) {
                        while($imgs = mysqli_fetch_assoc($img_result)) 
                        {

                            $section->addImage('../../uploads/'.$imgs['img_location'],array( 'width'=> 300, 'height' => 300, 'marginLeft' => 100,'align'=>'both') );
                            $section->addText($imgs['imagename'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));
                            
                        }
                    }
                

            }
        }
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007',$download = true);
// $objWriter->save('helloWorld.docx');

header("Content-Disposition: attachment; filename=myFile.docx");
$objWriter->save("php://output");

    