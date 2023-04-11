<?php

// check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // get the form data
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone-number'];
    $purpose = $_POST['purpose'];
    $first_time_buyer = $_POST['first-time-buyer'];
    $address_line1 = $_POST['address-line1'];
    $address_line2 = $_POST['address-line2'];
    $town_city = $_POST['town-city'];
    $county = $_POST['county'];

    // create a new row in the CSV file
    $row = array($first_name, $last_name, $email, $phone_number, $purpose, $first_time_buyer, $address_line1, $address_line2, $town_city, $county);
    
    // open the CSV file in append mode
    $file = fopen('mortgage-form.csv', 'a');
    
    // write the row to the CSV file
    fputcsv($file, $row);
    
    // close the file
    fclose($file);
    
}

?>
