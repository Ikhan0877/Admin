<?php
require_once 'vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();

    if(isset($_GET['programmeid']))
    {
        $programme = $_GET['programmeid'];
        // Getting programme details
        $programmes= "select * from programmes where programmeid = $programme ";
        $programmesresult = mysqli_query($conn, $sql1);
        // Getting department Details
        $department ="select * from department where departmentid = $departmentid";

        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle( $fontStyleName, array('name' => 'TimeNewRoman', 'size' => 14, 'color' => '1B2232', 'bold' => true) );
        $section = $phpWord->addSection();
        // Heading 
        $section->addText("Department of Computer Science"."[PG]", $fontStyleName , [ 'align' => 'center' ]);
    


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007',$download = true);
        header("Content-Disposition: attachment; filename=myFile.docx");
        $objWriter->save("php://output");

    }