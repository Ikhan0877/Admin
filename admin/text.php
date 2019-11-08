<?php
require_once 'vendor/autoload.php';
include 'inserting/confiq.php';

 $phpWord = new \PhpOffice\PhpWord\PhpWord();
// use PhpOffice\PhpWord\SimpleType\VerticalJc;
if(isset($_GET['deptid'])&&isset($_GET['yearid'])&&isset($_GET['monthid'])&&isset($_GET['programmedid']))
{

        $deptid = $_GET['deptid'];
        $yearid = $_GET['yearid'];
        $monthid = $_GET['monthid'];
        //$interative = $_GET['interactive'];
        $programmeid = $_GET['programmedid'];

        // fetching the details of the year,month,department
        $sql = "SELECT y.yearid, y.year, m.monthid, m.monthname ,d.deptname ,d.graduation,d.class FROM month m, year y , department d where y.yearid = $yearid and m.monthid =  $monthid and m.yearid = y.yearid and deptId = $deptid";
        $result = mysqli_query($conn, $sql);
        
        while($row =  mysqli_fetch_assoc($result)) {
            $temp = $row['monthname'];
            $year = $row['year'];
            $deptname = $row['deptname'];
            $grad = $row['graduation'];
        }

        $section = $phpWord->addSection();
        $header = array('name'=> 'Times New Roman','size' => 12, 'bold' => true);
        $normal =array('name' => 'Times New Roman', 'size' => 10);
        $interactives= "select * from programmes where yearid = '$yearid' and monthid = '$monthid' and deptid = '$deptid' and prgmid='$programmeid' and typeofprogramme = 'Interactive'";
        $intresult = mysqli_query($conn, $interactives);
        if (mysqli_num_rows($intresult) > 0) {
            // output data of each row
            
            //$section->addText($int,$header);
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
                
                $section->addImage('kjclogo.PNG',array( 'width'=> 200, 'height' => 50, 'marginLeft' => 100,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) );
                // $section->addText('Report submitted to the Internal Quality Assurance Cell for the month of'.$temp.' '.$year,array('bold' => true));
                $section->addText($deptname.'['.$grad.']',array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

                $section->addText('"'.$int['natureofevent'].'"'.$int['title'],array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
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
                    // $section->addText('some text', [], [  ]); 
                $section->addText('Objective'.':',array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'align'=>'both'));
                $section->addText($int['objective'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));
                

                $section->addText('Breif Write up on the session'.':',array('name' => 'Times New Roman', 'size' => 14,'bold'=>true,'align'=>'both'));
                $section->addText($int['brief'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));

                $section->addText('Learning Outcome'.':',array('name' => 'Times New Roman','size' => 14,'bold'=>true,'align'=>'both'));
                $section->addText($int['outcome'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));
                
                // $imgid = $int['resourcepersonid'];
                $programmeid=$int['prgmid'];
                $img= "select * from image where `progammedid`='$programmeid' and `type`='image'";
                $img_result = mysqli_query($conn, $img);
                if (mysqli_num_rows($img_result) > 0) {
                        while($imgs = mysqli_fetch_assoc($img_result)) 
                        {

                            $section->addImage('../uploads/'.$imgs['img_location'],array( 'width'=> 300, 'height' => 300, 'marginLeft' => 100,'align'=>'both') );
                            $section->addText($imgs['imagename'],array('name' => 'Times New Roman', 'size' => 10,'align'=>'both'));
                            
                        }
                    }
                

            }
        }
// $objWriter->save('helloWorld.docx');


    }
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007',$download = true);
    header("Content-Disposition: attachment; filename=myFile.docx");
    $objWriter->save("php://output");
    
?>