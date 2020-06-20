<?php
session_start();



include 'config.php';

if(!isset($_GET['page']))
{
	header("Location:index.php?page=1");
}

?>


<?php include 'header.php'; ?>

<!-- featured post -->

<section>
  <div class="container-fluid p-sm-0">
    <div class="row featured-post-slider">
	<?php
	
	$sql = "SELECT * FROM category";
   $result = $db->query($sql);

while($row = $result->fetch_assoc())
{
   echo"   <div class='col-lg-3 col-sm-6 mb-2 mb-lg-0 px-1'>
        <article class='card bg-dark text-center text-white border-0 rounded-0'>
          <img class='card-img rounded-0 img-fluid w-100' src='Profilepics/Category/$row[cat_unique_key]/$row[cat_img]' alt='post-thumb'>
          <div class='card-img-overlay'>
            <div class='card-content'>
              
              <h4 class='card-title mb-4'><a class='text-white' href='articles.php?id=$row[cat_id]&page=1'>$row[cat_name]</a></h4>
              <a class='btn btn-outline-light' href='articles.php?id=$row[cat_id]&page=1'>read more</a>
            </div>
          </div>
        </article>
      </div>";
	  
}  
	  ?>
    </div>
  </div>
</section>
<!-- /featured post -->

<!-- blog post -->
<section class="section">
  <div class="container">
    <div class="row masonry-container">
	<?php
	
	$limit = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$sql = "SELECT * FROM articles LIMIT $start,$limit";
$result = $db->query($sql);

if($result->num_rows == 0)
{
	echo "<h2>No articles</h2>";
}
while($row = $result->fetch_assoc())
{
	
  echo"
      <div class='col-lg-4 col-sm-6 mb-5'>
        <article class='text-center'>
          <img class='img-fluid mb-4' src='Profilepics/Articles/$row[article_unique_key]/$row[article_image]' alt='post-thumb'>
          <p class='text-uppercase mb-2'>TRAVEL</p>
          <h4 class='title-border'><a class='text-dark' href='content.php?id=$row[article_id]'>$row[article_name]</a></h4>
          <p>$row[article_summary]</p>
          <a href='content.php?id=$row[article_id]' class='btn btn-transparent'>read more</a>
        </article>
      </div>
	  ";
}
	  
	  ?>
      
      
    </div>
    <div class="row">
      <div class="col-12">
        <nav>
		<?php
		
		  $page_query = "SELECT * FROM articles";
                $page_result = $db->query($page_query);
                $total_records = mysqli_num_rows($page_result);
                $total_pages = ceil($total_records/$limit);
                $prev = $page - 1;
                $next = $page + 1;
				$start = 1;
				
				 if($_GET['page'] == 1)
				 {
					 echo" <ul class='pagination justify-content-center align-items-center'>";
				 }
				 else
				 {
					 echo "<ul class='pagination justify-content-center align-items-center'>
                           <li class='page-item'>
                           <span class='page-link'><a class='page-link' href='index.php?page=$prev'>&laquo; Previous</a></span>
                            </li>";
				 }

				for($i=1;$i<=$total_pages;$i++) :
         echo" 
            <li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
			endfor;
			echo"
            <li class='page-item'>
              <a class='page-link' href='index.php?page=$next'>Next &raquo;</a>
            </li>
          </ul>";
		  ?>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- /blog post -->

<!-- instagram -->
<section>
  <div class="container-fluid px-0">
    <div class="row no-gutters instagram-slider" id="instafeed" data-userId="4044026246"
      data-accessToken="4044026246.1677ed0.8896752506ed4402a0519d23b8f50a17"></div>
  </div>
</section>
<!-- /instagram -->

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