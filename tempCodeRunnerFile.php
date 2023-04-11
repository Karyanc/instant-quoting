<?php
// write a code to add form data from mortgage-form.html to mortgage-form.csv
$file = fopen('mortgage-form.csv', 'a');
$row = array();
$row[] = $_POST['first-name'];
$row[] = $_POST['last-name'];
$row[] = $_POST['email'];
$row[] = $_POST['phone-number'];
$row[] = $_POST['purpose'];
$row[] = $_POST['first-time-buyer'];
$row[] = $_POST['address-line1'];
$row[] = $_POST['address-line2'];
$row[] = $_POST['town-city'];
$row[] = $_POST['county'];
fputcsv($file, $row);
fclose($file);
?>