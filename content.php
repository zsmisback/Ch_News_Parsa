<?php
session_start();



include 'config.php';

?>

<?php include 'header.php'; ?>

<!-- page-title -->
<section class="section bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
	  <?php

	  $sql2 = "SELECT article_name FROM articles WHERE article_id = '$_GET[id]'";
	  $result2 = $db->query($sql2);
	  while($ro = $result2->fetch_assoc())
	  {
 	  echo"  
        <h4>$ro[article_name]</h4>";
	  }
		
		?>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- blog single -->
<section>
  <div class="container">
    <div class="row">
	<?php 

$sql = "SELECT * FROM articles INNER JOIN category ON article_category = cat_id WHERE article_id = $_GET[id]";
$result = $db->query($sql);





if($result->num_rows == 0)
{  
    echo"<h6><a href='index.php?page=1' style='text-decoration:underline;color:black'>Home</a> > <a href='articles.php?id=$row[article_category]&page=1' style='text-decoration:underline;color:black'>Articles</a></h6>";
	echo "<h2>No articles</h2>";
}
while($row = $result->fetch_assoc())
{
   echo"   <div class='col-lg-8'>
        <ul class='list-inline d-flex justify-content-between py-3'>
          <li class='list-inline-item'><i class='ti-user mr-2'></i>Post by Jhon Abraham</li>
          <li class='list-inline-item'><i class='ti-calendar mr-2'></i>$row[article_create]</li>
        </ul>
        <img src='Profilepics/Articles/$row[article_unique_key]/$row[article_image]' alt='post-thumb' class='w-100 img-fluid mb-4'>
        <div class='content'>
		<h2 class='p'>$row[article_name]</h2>
         <h5 class='p'>$row[article_summary]</h5>
          <p>$row[article_content]</p>
		  
          </div>
		  <h6 class='pb-4'><a href='index.php?page=1' style='text-decoration:underline;color:black'>Home</a> > <a href='articles.php?id=$row[article_category]&page=1' style='text-decoration:underline;color:black'>Articles</a> > $row[article_name] </h6>
   
   <h4>Comments:</h4>";
   $sql4 = "SELECT * FROM comments WHERE comment_article = $_GET[id] ORDER BY comment_create DESC";
  $result4=$db->query($sql4);


  echo " <form name='com' method='post' id='comments'>
                      
                      <textarea class='form-control' name='com_desc' rows='4' cols='155' id='cdesc' placeholder='Comment'></textarea>
					  <br>
					  <p class='err' id='error'></p>
					  <button type='submit' id='cbtn' class='btn btn-dark btn-lg float-right' name='newcom' >Submit</button>
					  </form>";
					 
   if($result4->num_rows == 0)
  {
	  echo "No comments";
  }
  else
  {
	  while($row4 = $result4->fetch_assoc())
	  {
		  echo "<h6>Posted on: $row4[comment_create]</h6>";
		   
		       if(empty($row4['comment_by']))
			   {
				   echo "<h6>By: Anonymous user</h6>";
			   }
			   else
			   {
		        echo "<h6>By: $row4[comment_by]</h6>";
		       }
         echo "<p>$row4[comment_summary]</p><hr>";
	  }	
  }	  
					  
					 
  echo"</div>
      <div class='col-lg-4'>
        <div class='widget search-box'>
          <i class='ti-search'></i>
          <input type='search' id='search-post' class='form-control border-0 pl-5' name='search-post'
            placeholder='Search'>
        </div>
        <div class='widget'>
          <h6 class='mb-4'>LATEST POST</h6>";
		  
		  $sql2="SELECT * FROM articles ORDER BY article_create DESC LIMIT 8";
  $res=$db->query($sql2);
  while($row3=$res->fetch_assoc())
  {
		  echo"
          <div class='media mb-4'>
            <div class='post-thumb-sm mr-3'>
              <img class='img-fluid' src='Profilepics/Articles/$row3[article_unique_key]/$row3[article_image]' alt='post-thumb'>
            </div>
            <div class='media-body'>
              <ul class='list-inline d-flex justify-content-between mb-2'>
                <li class='list-inline-item'>Post By Jhon</li>
                <li class='list-inline-item'>$row[article_create]</li>
              </ul>
              <h6><a class='text-dark' href='content.php?id=$row3[article_id]'>$row3[article_name]</a></h6>
            </div>
          </div>";
  }
		  
        echo"  
        </div>
        <div class='widget'>
          <h6 class='mb-4'>TAG</h6>
          <ul class='list-inline tag-list'>
            <li class='list-inline-item m-1'><a href='blog-single.html'>ui ux</a></li>
          </ul>
        </div>
        <div class='widget'>
          <h6 class='mb-4'>CATEGORIES</h6>
          <ul class='list-inline tag-list'>
            <li class='list-inline-item m-1'><a href='blog-single.html'>ui ux</a></li>
          </ul>
        </div>
      </div>";
    }
?>
    </div>
  </div>
</section>
<!-- /blog single -->

<footer class="bg-secondary">
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <a href="index.html"><img src="images/logo.png" alt="persa" class="img-fluid"></a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <h6>Address</h6>
          <ul class="list-unstyled">
            <li class="font-secondary text-dark">Sydney</li>
            <li class="font-secondary text-dark">6 rip carl Avenue CA 90733</li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <h6>Contact Info</h6>
          <ul class="list-unstyled">
            <li class="font-secondary text-dark">Tel: +90 000 333 22</li>
            <li class="font-secondary text-dark">Mail: exmaple@ymail.com</li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <h6>Follow</h6>
          <ul class="list-inline d-inline-block">
            <li class="list-inline-item"><a href="#" class="text-dark"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-dark"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-dark"><i class="ti-linkedin"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-dark"><i class="ti-github"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center pb-3">
    <p class="mb-0">Copyright ©<script>var CurrentYear = new Date().getFullYear()
    document.write(CurrentYear)</script> a theme by  <a href="https://themefisher.com/">themefisher.com</a></p>
  </div>
</footer>

<!-- jQuery -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- masonry -->
<script src="plugins/masonry/masonry.js"></script>
<!-- instafeed -->
<script src="plugins/instafeed/instafeed.min.js"></script>
<!-- smooth scroll -->
<script src="plugins/smooth-scroll/smooth-scroll.js"></script>
<!-- headroom -->
<script src="plugins/headroom/headroom.js"></script>
<!-- reading time -->
<script src="plugins/reading-time/readingTime.min.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html>