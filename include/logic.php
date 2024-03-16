<?php


$sql = "SELECT * FROM blog_data";
$query = mysqli_query($conn, $sql);

#$row_blog = mysqli_fetch_assoc($sql);

// Create a new post
if (isset($_REQUEST['new_post'])) {
    $title = addslashes($_REQUEST['title']);
    $introduction = addslashes($_REQUEST['intro']);
    $content = addslashes($_REQUEST['main_content']);
    $conclusion = addslashes($_REQUEST['conclusion']);
    $content_creator = addslashes($_REQUEST['content_creator']);

    $sql = mysqli_query($conn, "INSERT INTO blog_data(title, introduction, content, conclusion, content_creator) 
                VALUES('$title', '$introduction', '$content', '$conclusion', '$content_creator')");

    if ($sql) {
        $message = 'Blog Successfully Added';
    } else {
        $message = 'Failed to add the blog. Please try again..';
    }
}

// Get post data based on id
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM blog_data WHERE id = $id";
    $query = mysqli_query($conn, $sql);
}

// Delete a post
if (isset($_REQUEST['delete'])) {
    $id = $_REQUEST['id'];

    $sql = "DELETE FROM blog_data WHERE id = $id";
    mysqli_query($conn, $sql);
    echo "<script>alert('Blog Deleted.')</script>";
    header("Location: ../index.php#blogs");
    exit();
}

// Update a post
if (isset($_REQUEST['update'])) {
    $id = addslashes($_REQUEST['id']);
    $title = addslashes($_REQUEST['title']);
    $introduction = addslashes($_REQUEST['intro']);
    $content = addslashes($_REQUEST['main_content']);
    $conclusion = addslashes($_REQUEST['conclusion']);

    $sql = "UPDATE blog_data SET title = '$title', introduction = '$introduction', content = '$content', conclusion = '$conclusion' WHERE id = $id";
    $update_result = mysqli_query($conn, $sql);

    if ($update_result) {
        $message = 'Blog Successfully Updated';
    } else {
        $message = 'Failed to update the blog. Please try again.';
    }
}
