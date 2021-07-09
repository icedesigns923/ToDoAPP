<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}	

	// update task
if (isset($_GET['edit_task'])) {
	$id = $_GET['edit_task'];

	mysqli_query($db, "UPDATE FROM tasks WHERE id=$id");
	header('location: index.php');
}

// delete task
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
	header('location: index.php');
}
  ?>
 

 

 
 
 <!DOCTYPE html>
 <html>
 <head>
	<title>ToDo List Application </title>
 <link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
	<div class="heading">
		<h2 style="font-style: 'Roboto';">ToDo List Application PHP and MySQL</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>

  <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>
	</form>
 <table>
	<thead>
		<tr>
			<th style="text-align: left">S/N</th>
			<th>Tasks</th>
			<th>Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed and fix numbering
		$tasks = mysqli_query($db, "SELECT * FROM tasks");
  
		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="edit"> 
					<a href="index.php?edit_task=<?php echo $row['id'] ?>">Edit</a> 
				</td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
 </body>
  </html>