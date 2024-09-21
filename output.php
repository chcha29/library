<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the submitted form data
    $firstName = htmlspecialchars($_POST['firstname']);
    $lastName = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);

    // Handle the file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];

        // Specify the directory where the file will be moved
        $uploadDir = 'uploads/';
        $destPath = $uploadDir . basename($fileName);

        // Create the upload directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $uploadSuccess = true;
        } else {
            $uploadSuccess = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .result-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            color: #666;
            font-size: 16px;
        }
        .uploaded-image {
            display: block;
            margin: 20px auto;
            max-width: 200px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="result-container">
    <h2>Form Submission Result</h2>

    <p><strong>First Name:</strong> <?= $firstName; ?></p>
    <p><strong>Last Name:</strong> <?= $lastName; ?></p>
    <p><strong>Email:</strong> <?= $email; ?></p>

    <?php if (isset($uploadSuccess) && $uploadSuccess): ?>
        <p><strong>Uploaded File:</strong> <?= htmlspecialchars($fileName); ?></p>
        <img src="<?= $destPath; ?>" alt="Uploaded Image" class="uploaded-image">
    <?php elseif (isset($uploadSuccess) && !$uploadSuccess): ?>
        <p style="color: red;">Failed to upload the file.</p>
    <?php else: ?>
        <p>No file was uploaded.</p>
    <?php endif; ?>
</div>

</body>
</html>
