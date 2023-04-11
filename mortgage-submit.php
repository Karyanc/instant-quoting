<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['first-name'] ?? '';
    $lastName = $_POST['last-name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phoneNumber = $_POST['phone-number'] ?? '';
    $purpose = $_POST['purpose'] ?? '';
    $firstTimeBuyer = $_POST['first-time-buyer'] ?? '';
    $houseNumber = $_POST['house-number'] ?? '';
    $street = $_POST['street'] ?? '';
    $townCity = $_POST['town-city'] ?? '';
    $county = $_POST['county'] ?? '';

    // Validate form data
    $errors = [];
    if (empty($firstName)) {
        $errors[] = 'First name is required';
    }
    if (empty($lastName)) {
        $errors[] = 'Last name is required';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address';
    }
    if (!preg_match('/^\(+44 ) [0-9]{9,10}$/', $phoneNumber)) {
        $errors[] = 'Invalid phone number';
    }
    if (empty($purpose)) {
        $errors[] = 'Purpose is required';
    }
    if (empty($firstTimeBuyer)) {
        $errors[] = 'First time buyer is required';
    }
    if (empty($houseNumber)) {
        $errors[] = 'House number is required';
    }
    if (empty($townCity)) {
        $errors[] = 'Town/City is required';
    }
    if (empty($county)) {
        $errors[] = 'County is required';
    }

    // Save form data to CSV file
    if (empty($errors)) {
        $data = [$firstName, $lastName, $email, $phoneNumber, $purpose, $firstTimeBuyer, $houseNumber, $street, $townCity, $county];
        $file = fopen('mortgage-form.csv', 'a');
        fputcsv($file, $data);
        fclose($file);
        echo 'Form data saved successfully';
    } else {
        echo implode('<br>', $errors);
    }
} else {
    header('Location: mortgage-form.html');
    exit;
}
