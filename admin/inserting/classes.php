<?php 

// class for year
class Year{
    public $server = "localhost";
    public $username="root";
    public $password="";
    public $dbname ="reports";
    // count the evens
    public function countEventsDept($deptid)
    {
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT count(*) as total from programmes where deptid = '$deptid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    // count the overalls
    public function countOverallsDept($deptid){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from fest where (deptid='$deptid') and (`prize`='Runners' or `prize`='Winners' or `prize`='Second-Runners')";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
        
    }
    // count the resource person    
    public function countReasourceDept($deptid){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT count(*) as total from reasource where departmentid = '$deptid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    // count events based on year and dept
    public function countEventsYear($deptid,$yearid)
    {
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT count(*) as total from programmes where deptid = '$deptid' and yearid='$yearid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    // count the overalls based on year and dept id
    public function countOverallsYear($deptid,$yearid){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from fest where (deptid='$deptid') and (yearid='$yearid') and (`prize`='Runners' or `prize`='Winners' or `prize`='Second-Runners')";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }

    public function countEventsMonth($deptid,$yearid,$monthid)
    {
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT count(*) as total from programmes where deptid = '$deptid' and yearid='$yearid' and monthid='$monthid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    // count the overalls
    public function countOverallsMonth($deptid,$yearid,$monthid){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from fest where (deptid='$deptid') and (yearid='$yearid') and (monthid='$monthid') and (`prize`='Runners' or `prize`='Winners' or `prize`='Second-Runners')";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }
    
    //display the year name    
    public function displayYear($yearid)
    {
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT year FROM year where yearid = $yearid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['year'];
    }
    // display the month name
    public function displayMonth($monthid,$yearid)
    {
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT * FROM month where monthid = $monthid and yearid = $yearid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['monthname'];
    }
    // display month number ex:01,02,03....12.
    public function displayMonthNum($monthid,$yearid){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $sql = "SELECT * FROM month where monthid = $monthid and yearid = $yearid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $temp= $row['monthname'];
        if($temp=="Jan"){   
           return $temp="01";
        }elseif($temp=="Feb"){
            return $temp="02";
        }elseif($temp=="Mar"){
            return $temp="03";
        }elseif($temp=="Apr"){
            return $temp="04";
        }elseif($temp=="May"){
            return $temp="05";
        }elseif($temp=="Jun"){
            return $temp="06";
        }elseif($temp=="Jul"){
            return $temp="07";
        }elseif($temp=="Aug"){
            return $temp="08";
        }elseif($temp=="Sep"){
            return $temp="09";
        }elseif($temp=="Oct"){
            return $temp="10";
        }elseif($temp=="Nov"){
            return $temp="11";
        }elseif($temp=="Dec"){
            return $temp="12";
        }
    }
    // counting the staff
    public function staffCount(){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from login where role='Staff' ";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }
    // counting the student
    public function studentCount(){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from login where role='Student' ";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }
    // counting the department
    public function departmentCount(){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from department";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }
    // counting the acheivements{}
    public function StuAchCount($yearid,$monthid,$deptid){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from achievements where yearid='$yearid' and monthid='$monthid' and ach_type='Student' and deptid='$deptid'";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }
    public function FacAchCount($yearid,$monthid,$deptid){
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from achievements where yearid='$yearid' and monthid='$monthid' and ach_type='Faculty' and deptid='$deptid'";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total']; 
    }
    public function FestCount($yearid,$monthid,$deptid)
    {
        # code..
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from fest where yearid='$yearid' and monthid='$monthid' and deptid='$deptid'";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }
    public function ResCount($yearid,$monthid,$deptid)
    {
        # code...
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from researchproject where yearid='$yearid' and monthid='$monthid' and deptid='$deptid'";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }
    public function publCount($yearid,$monthid,$deptid)
    {
        # code...
        $conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);
        $fest = "SELECT count(*) as total from publication where yearid='$yearid' and monthid='$monthid' and deptid='$deptid'";
        $result = mysqli_query($conn, $fest);
        $rowo = mysqli_fetch_assoc($result);
        return $rowo['total'];
    }

} 

?>