<?php 
require('config/config.php');
require('config/db.php');

//check for delete
if(isset($_POST['delete'])){
    //get form data 
$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

//Query
$query = "DELETE FROM posts WHERE id = {$delete_id}";

if(mysqli_query($conn, $query)){
header('Location: '.ROOT_URL. '');
} else {
echo 'ERROR: '.mysqli_error($conn); 
}
}

//Get ID
$id = mysqli_real_escape_string($conn, $_GET['id']);

//create query
$query = 'SELECT * FROM posts WHERE id = '.$id;

//Get results
$result = mysqli_query($conn, $query);

//Fetch Data
$post = mysqli_fetch_assoc($result);

//Free Results
mysqli_free_result($result);

//close connection 
mysqli_close($conn);

?>

<?php include ('inc/header.php'); ?>

<div class= "container">
    <h1>Posts</h1>
    <a href = "<?php echo ROOT_URL; ?>" class = "btn btn-default">Back</a>

        <h1><?php echo $post ['title']; ?></h1> 
        <small> Created on <?php echo $post ['created_at']; ?> by 
        <?php echo $post['author']; ?></small>
        <p><?php echo $post['body']; ?></p>
        <hr>
        <form class="pull-right" method="POST" actuion = "<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type= "hidden" name="delete_id" value = "<?php echo $post['id']; ?>">
                <input type= "submit" name="delete" value ="DELETE" class = "btn btn-danger" >

        </form>
        <a href= "<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class= "btn btn-default"></a>

        </div>
    <?php include ('inc/footer.php'); ?>
