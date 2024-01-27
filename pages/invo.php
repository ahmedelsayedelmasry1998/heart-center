<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}

include "../master/sections/connect.php";

if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $pat = $_POST['pat'];
    $invoice_id = $_POST['inv-id'];
    $invoice_date = $_POST['invo-date'];
    $invoice_time = $_POST['invo-time'];
    $exams = $_POST['exam'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $amount = $_POST['amount'];
    $total = $_POST['total'];
    $emp = $_POST['emp'];
    $userID = $_SESSION['userid'];
    function examFilter($value){
        return $value != 'start';
    }
    $activeExams = array_filter($exams, 'examFilter');
    $stmt1 = $conn -> prepare("INSERT INTO invoice(invoice_id, pat_id, invoice_date,
    invoice_time, invoice_total, emp_id, user_userid) VALUES(?,?,?,?,?,?,?)");
    $stmt1 -> execute([$invoice_id, $pat, $invoice_date, $invoice_time, $total, $emp, $userID]);
    for( $i = 0; $i < count($activeExams); $i++ ){
        $stmt2 = $conn -> prepare("INSERT INTO invoice_details(invoice_id, exam_id, price,
        discount) VALUES(?,?,?,?)");
        $stmt2 -> execute([$invoice_id, $activeExams[$i], $price[$i], $discount[$i]]);
    }
    header("location:invoice.php");
}