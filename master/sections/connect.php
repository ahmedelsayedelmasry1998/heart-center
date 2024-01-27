<?php
$hostname = "localhost";
$dbname = "heart_center";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:hostname=$hostname;dbname=$dbname", $username, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
    echo $e -> getMessage();
}

class Conn2col{
    public $first_col;
    public $second_col;
    public $table_name;
    public $active_col;

    function __construct($first_col, $second_col, $table_name, $active_col)
    {
        $this -> first_col = $first_col;
        $this -> second_col = $second_col;
        $this -> table_name = $table_name;
        $this -> active_col = $active_col;
    }

    public function records(){
        $all_records = $GLOBALS['conn'] -> query("SELECT $this->first_col, 
        $this->second_col FROM $this->table_name 
        WHERE $this->active_col = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
        return $all_records;
    }

    public function dataSelect(){
        foreach($this->records() as $key => $value){
            echo "<option value=\"$key\">$value</option>";
        }
    }


}

$job_table = new Conn2col("job_id", "job_title", "jobs", "job_active");
$dept_table = new Conn2col("dept_id", "dept_name", "departments", "dept_active");
$section_table = new Conn2col("section_id", "section_name", "sections", "section_active");
$pat_table = new Conn2col("pat_id", "pat_name", "patients", "pat_active");
$treat_table = new Conn2col("treat_id", "treat_name", "treat_doctors", "treat_active");
$exam_table = new Conn2col("exam_id", "exam_name", "examinations", "exam_active");