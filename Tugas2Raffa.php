<!DOCTYPE html>

<html>
<head>
  <style>
    body {
      background-repeat:no-repeat;
    
      
    }
    div{
      padding-top: 30vh;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    input[type="number"], input[type="submit"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 20px;
        }
        input[type="submit"] {
            background: #ffffff;
            color: black;
            border: none;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
  </style>
  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
  <title>Raffa Steven</title>
</head>
<body>
 

<div class="calculator">

<h2>Penjumlahan Sederhana</h2>

<form method="POST">

<input type="number" name="number1" placeholder="Masukkan angka pertama" required>

<input type="number" name="number2" placeholder="Masukkan angka kedua" required>

<input type="submit" value="Hitung">

</form>

<div class="result">

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$number1 = $_POST['number1'];

$number2 = $_POST['number2'];

$result = $number1 + $number2;

echo "Hasil penjumlahan: $number1 + $number2 = $result";

}

?>

  

</div>

</body>
  </html>