<html> 
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head> 
    
<head>
	<title>Add Student</title>
</head>
<body>
    <div class='center'>
	<form action="" method="post">
        <label>Name :</label><input type="text" name="name"><br><br>
    <label>Course :</label><br>
        <div id='checkboxes'>
            <input type="checkbox" name="course[]" value="PHP">PHP<br>
		  		<input type="checkbox" name="course[]" value="JS"> JS<br>
		  		<input type="checkbox" name="course[]" value="CSS"> CSS<br>
		  		<input type="checkbox" name="course[]" value="PYTHON"> PYTHON<br>
        </div>
        <br>
		<input type="submit" value="Submit">
	</form>	
    </div>
	
</body>
</html>
<?php
$connect=mysqli_connect("localhost","root","","testing");


    $Name = $_POST['name'];
    $Course = $_POST['course'];
    $selected = "";
    foreach ($_POST['course'] as $service) 
    {
        $selected = $selected.$service." ";
    }

    $stmt = $connect -> prepare("Insert into tbl_employee(name, course) VALUES (?,?)");
    $stmt->bind_param("ss", $Name, $selected);
    $stmt->execute();


    printf("%d Row inserted.\n", $stmt->affected_rows);
    $stmt->close();
    mysqli_close($connect);
    echo'<script>window.location="\index.php";</script>';
?>