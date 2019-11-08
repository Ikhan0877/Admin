<?php
include 'confiq.php';

if(isset($_POST['str']))
{

    $data = array();
    $name = $_POST['str'];
    $resource= "select * from reasource where name = '$name'";
    $resourceresult = mysqli_query($conn, $resource);

    if (mysqli_num_rows($resourceresult) > 0) 
    {
         while($rowresource = mysqli_fetch_assoc($resourceresult)) 
         {
            $data['status'] = 'ok';
            $data['result'] = $rowresource;
        }
    }
    else
    {
        $data['status'] = 'error';
        $data['result'] = '';
    }
    echo json_encode($data);
}
    // $marks = array("person_name"=>"$resourcename", "email_id"=>"$emailid", "details"=>"$persondetails", "phone"=>$phoneno);
    // echo  json_encode($marks);


    // $query = $db->query("");
    
    // if($query->num_rows > 0){
        
    // }else{
    //     $data['status'] = 'err';
    //     $data['result'] = '';
    // }
    
    //returns data as JSON format
    
