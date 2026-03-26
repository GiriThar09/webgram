<pre>
<?php
include 'libs/load.php';

echo "Testing database connection...<br>";
$conn = Database::getConnection();
echo "Connection successful.<br>";

echo "Creating table if not exists...<br>";
$sql = "CREATE TABLE IF NOT EXISTS `auth` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(255),
    `active` INT DEFAULT 1,
    `bio` TEXT
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

echo "Inserting test user...<br>";
$username = "girithar";
$password = password_hash("password", PASSWORD_DEFAULT);
$email = "girithar@gmail.com";
$phone = "1234567890";

$sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`) VALUES (?, ?, ?, ?, 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $password, $email, $phone);
if ($stmt->execute()) {
    echo "User inserted.<br>";
} else {
    echo "Error inserting user: " . $stmt->error . "<br>";
}
$stmt->close();

echo "Testing query...<br>";
$sql = "SELECT * FROM `auth`";
$result = $conn->query($sql);
if ($result) {
    echo "Query successful. Rows: " . $result->num_rows . "<br>";
    while ($row = $result->fetch_assoc()) {
        print_r($row);
        echo "<br>";
    }
} else {
    echo "Query failed: " . $conn->error . "<br>";
}

?>
</pre>
