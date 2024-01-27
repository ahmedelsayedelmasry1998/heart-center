<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

include "../master/sections/connect.php";
$get_pat_records = $conn->query("SELECT pat_id, pat_name, pat_phone, pat_age, treat_name
    FROM patients INNER JOIN treat_doctors USING(treat_id) WHERE pat_active = 1
    ORDER BY pat_id")->fetchAll(PDO::FETCH_ASSOC);
$json_data = json_encode($get_pat_records);
file_put_contents("pat.json", $json_data);
include "../master/sections/start.php";
include "../master/sections/links.php";
include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Invoice</div>
    <div class="inv-tab">
        <form action="invo.php" method="POST">
            <table>
                <!-- invoice head -->
                <thead>
                    <tr>
                        <th>Patient</th>
                        <td>
                            <select name="pat" id="pat-select">
                                <option value="start">Select Patient</option>
                                <?php
                                $get_pat = $conn->query("SELECT pat_name FROM patients 
                                    WHERE pat_active = 1 ORDER BY pat_id")->fetchAll(PDO::FETCH_COLUMN);
                                for ($i = 0; $i < count($get_pat); $i++) {
                                    echo "<option value=\"$i\">" . $get_pat[$i] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <th></th>
                        <th>Invoice ID</th>
                        <td>
                            <?php
                            $last_invoice = $conn->query("SELECT invoice_id
                                FROM invoice ORDER BY invoice_id DESC
                                LIMIT 1")->fetchAll(PDO::FETCH_COLUMN);
                            $lastID = (count($last_invoice) > 0) ? $last_invoice[0] + 1 : 1;
                            ?>
                            <input type="number" name="inv-id" readonly value="<?php echo $lastID; ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td id="td-phone"></td>
                        <th></th>
                        <th>Invoice Date</th>
                        <td>
                            <input type="text" name="invo-date" readonly id="inv-date">
                        </td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td id="td-age"></td>
                        <th></th>
                        <th>Invoice Time</th>
                        <td>
                            <input type="text" name="invo-time" readonly id="inv-time">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                </thead>

                <!-- invoice body -->
                <tbody>
                    <tr>
                        <th colspan="2">Examination</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                // $get_exams = $conn -> query("SELECT exam_id, exam_name
                                // FROM examinations WHERE exam_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                                // foreach( $get_exams as $key => $value ){
                                //     echo "<option value=\"$key\">$value</option>";
                                // }
                                $exam_table->dataSelect();
                                ?>

                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" value="0" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                // foreach( $get_exams as $key => $value ){
                                //     echo "<option value=\"$key\">$value</option>";
                                // }
                                $exam_table->dataSelect();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" value="0" readonly>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                // foreach( $get_exams as $key => $value ){
                                //     echo "<option value=\"$key\">$value</option>";
                                // }
                                $exam_table->dataSelect();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" value="0" readonly>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                // foreach( $get_exams as $key => $value ){
                                //     echo "<option value=\"$key\">$value</option>";
                                // }
                                $exam_table->dataSelect();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" value="0" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <select name="exam[]">
                                <option value="start">Select Examination</option>
                                <?php
                                // foreach( $get_exams as $key => $value ){
                                //     echo "<option value=\"$key\">$value</option>";
                                // }
                                $exam_table->dataSelect();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="p" value="0">
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="d" value="0">
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="a" value="0" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="4" style="text-align: right; padding-right:15px">Total</th>
                        <td>
                            <input type="number" name="total" id="inp-total" value="0" readonly>
                        </td>
                    </tr>
                </tbody>

                <!-- invoice foot -->
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Employee</th>
                        <th></th>
                        <th>Treatment Doctor</th>
                        <th></th>
                        <th>Examination Doctor</th>
                    </tr>
                    <tr>
                        <td><?php echo $_SESSION['username']; ?></td>
                        <td></td>
                        <td id="td-treat"></td>
                        <td></td>
                        <td>
                            <select name="emp" id="">
                                <?php
                                $get_docs = $conn->query("SELECT emp_id, emp_name
                                    FROM employees WHERE job_id = 2")->fetchAll(PDO::FETCH_KEY_PAIR);
                                foreach ($get_docs as $key => $value) {
                                    echo "<option value=\"$key\">$value</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </tfoot>

            </table>
            <div class="inv-row">
                <input type="submit" value="Save">
                <input type="button" value="print" id="inp-print">
            </div>
        </form>
    </div>
</div>

<?php include "../master/sections/footNav.php"; ?>
<!-- custome js  -->
<script src="../master/js/invoice.js"></script>
<?php include "../master/sections/end.php"; ?>