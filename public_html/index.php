<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management Hub</title>
    <link rel="stylesheet" href="css/hub.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.wrapper {
    max-width: 400px;
    text-align: center;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease-in-out;
}

.wrapper:hover {
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
}

.title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
}

.btn {
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin: 10px 0;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #45a049;
}

.sabutan {
    background-color: #007bff;
}

.tubuan1 {
    background-color: #dc3545;
}

.tubuan2 {
    background-color: #ffc107;
}

.logo {
            text-align: center;
            margin-bottom: 20px;
        }
.logo img {
            width: 150px; /* Adjust size as needed */
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="logo">
                <img src="silanglogo.png" alt="Barangay Management Logo"> <!-- Adjust the path to your logo image -->
            </div>
            <div class="title"><span>Barangay Silang Management Hub</span></div>
            <div class="row">
                <button onclick="redirectToLogin('sabutan')" class="btn sabutan">Barangay Sabutan</button>
            </div>
            <div class="row">
                <button onclick="redirectToLogin('tubuan2')" class="btn tubuan2">Barangay Tubuan 2</button>
            </div>
            <div class="row">
                <button onclick="redirectToLogin('tubuan3')" class="btn tubuan3">Barangay Tubuan 3</button>
            </div>
        </div>
    </div>
    <script>
        function redirectToLogin(barangay) {
            window.location.href = barangay + '/login.php';
        }
    </script>
</body>

</html>
