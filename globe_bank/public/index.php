<?php require_once('../private/initialize.php'); ?>

<?php

if(isset($_GET['id']))
{
  $page_id = $_GET['id'];
  $page = find_page_by_id($page_id);
  if(!$page) // If no page is found
  {
    redirect_to(url_for('/index.php'));
  }
  $subject_id = $page["subject_id"];
}else // If page is found
{
  // Nothing selected show the home page

}

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
  <?php include(SHARED_PATH . '/public_navigation.php'); ?>
  <div id="page">
    <?php

      if(isset($page)) // If you found a page, show that page
      {
        // Show the page from the database
        // TODO add html escaping back in
        echo $page["content"];
      }
      else
      {
        // Show the homepage
        // The homepage could:
        // * be static content (here or in a shared file)
        // * show the first page from the nav
        // * be in the database but add code to hide in the nav
        include(SHARED_PATH . '/static_homepage.php');
      }


    ?>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
