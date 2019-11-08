<?php 

class User{
    public $server = "localhost";
    public $username="root";
    public $password="";
    public $dbname ="kjcreports";
    public $role;
    public $deptid;
    public $userid;
    public $status;
    // count the evens
    public function Userdet($username,$pass,$role)
    {
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT * from login where username = '$username' and password = '$pass' and role='$role'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0)
        {
            while($row = mysqli_fetch_assoc($result)){
                $this->role = $row['role'];
                $this->deptid = $row['deptid'];
                $this->userid = $row['userid'];
                $this->status = $row['status'];
            }
            return 1;
        }
        else{
            return 0;
        }
        
    }
}
?>