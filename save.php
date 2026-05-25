<?php
$conn = new mysqli("localhost", "root", "", "structure");

if ($conn->connect_error) {
  die("Database connection failure: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO products (product, date, model, price, category) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssds", $product, $date, $model, $price, $category);

$product = $_POST['product'];
$date = $_POST['date'];
$model = $_POST['model'];
$price = $_POST['price'];
$category = $_POST['category'];

echo "<!DOCTYPE html>
<html lang='en'>
<head>
  <link rel='stylesheet' href='style.css'>
  <title>System Logs</title>
</head>
<body>
  <div class='card' style='text-align:center;'>";

if ($stmt->execute()) {
  echo "<h2 style='color: #10b981;'>📡 System Updated</h2>";
  echo "<p style='color: #94a3b8;'>The device hardware data has been successfully securely transmitted to the central vault.</p>";
  echo "<br><a href='view.php' class='btn-submit' style='text-decoration:none; display:inline-block;'>Open Dashboard</a>";
} else {
  echo "<h2 style='color: #ef4444;'>⚡ System Error</h2>";
  echo "<p>" . $stmt->error . "</p>";
  echo "<br><a href='index.html' class='link-secondary'>Re-attempt Insertion</a>";
}

echo "  </div>
</body>
</html>";

$stmt->close();
$conn->close();
?>