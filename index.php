<!DOCTYPE html>
<html>
<body>
<?php
error_reporting(0);
include"dpconnect.php";
$polaczenie = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if ($polaczenie->connect_errno!=0){
	echo "Error".$polaczenie->connect_errno."Opis:".$polaczenie->connect_errno;
	
}
else{
	$sql = "SELECT * FROM ssaki";
	$result = $polaczenie->query($sql);
	echo "<table border='double'> <tr><th>id</th><th>zwierz</th><th>waga</th><th>srodowisko</th><th>zdjencie</th></tr>";
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row["Id"]."</td>";
		echo "<td>".$row["nazwa"]."</td>";
		echo "<td>".$row["waga"]."</td>";
		echo "<td>".$row["srodowisko"]."</td>";
		$id=$row["Id"];
		$id2=$row["Id"]."cos";
		if(is_null($row['zdjencie'])){
			echo "<td><form method='post' enctype='multipart/form-data'>Zdjecie:
				<input type='file' name='$id' id='$id'>
				<input type='submit' value='submit' name='$id'>
				</form> </td>";
		}
		else{
			$zdj = "zdjencie";
			echo "<td> <img src='$row[$zdj]' width='100px'>";
			$zmienna = $row["zdjencie"];
			echo "<form method='post'><input type='submit' name='$id2' value='usun'></form> </td>";
		}
		echo "</tr>";
    }
	echo "</table>";
}
for($i=0;$i<10;$i++){
	if(!is_null($_POST[$i])){
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["$i"]["name"]);
		move_uploaded_file($_FILES["$i"]["tmp_name"], $target_file);
		echo $target_file." ".$i;
		$sql = "UPDATE ssaki SET zdjencie = '$target_file' WHERE Id='$i';";
		$result = $polaczenie->query($sql);
		$_POST[$i] = NULL;
		header('Location: index.php');
	}
}
for($i=0;$i<10;$i++){
	if(!is_null($_POST[$i."cos"])){
		$sql = "UPDATE ssaki SET zdjencie = NULL WHERE Id='$i';";
		$result = $polaczenie->query($sql);
		echo "dziala ".$zmienna;
		unlink($zmienna);
		$_POST[$i."cos"] = NULL;
		header('Location: index.php');
	}
}
?>
<?php
// define variables and set to empty values
$name = $waga = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $waga = test_input($_POST["waga"]);
  $gender = test_input($_POST["gender"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Dodaj rekord</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nazwa: <input type="text" name="name">
  <br><br>
  Waga: <input type="text" name="waga">
  <br><br>
  Srodowisko:
  <input type="radio" name="gender" value="lodowe">ladowe
  <input type="radio" name="gender" value="wodne">wodne
  <input type="radio" name="gender" value="powietrzne">powietrzne
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $waga;
echo "<br>";
echo $gender;
if ($polaczenie->connect_errno!=0){
	echo "Error".$polaczenie->connect_errno."Opis:".$polaczenie->connect_errno;
	
}
else{
	if($name){
		$sql = "INSERT INTO `ssaki`(`nazwa`, `waga`, `srodowisko`) VALUES ('$name','$waga','$gender')";
		$result = $polaczenie->query($sql);
		header('Location: index.php');
	}
}
?>
</body>
</html>