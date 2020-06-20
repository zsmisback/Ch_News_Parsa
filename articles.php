<?php
session_start();



include 'config.php';

if(!isset($_GET['id']))
{
	header("Location:index.php?page=1");
}

?>

<?php include 'header.php'; ?>

<!-- hero area -->
<?php
	
	 $sql2 = "SELECT * FROM category WHERE cat_id = $_GET[id]";
     $result2 = $db->query($sql2);
	 $row2 = $result2->fetch_assoc();

echo "	 
<section class='hero-section'>
  <div class='container'>
    <div class='row'>
      <div class='col-lg-6 align-self-end'>
        <h1 class='mb-0'>Welcome</h1>
        <h2 class='mb-100 title-border-lg'>to <i>$row2[cat_name]</i></h2>
        <p class='mb-80 mr-5'>$row2[cat_desc]</p>
        <span class='font-secondary text-dark mr-3 mr-sm-5'>Follow</span>
        <ul class='list-inline d-inline-block mb-5'>
          <li class='list-inline-item mx-3'><a href='#' class='text-dark'><i class='ti-facebook'></i></a></li>
          <li class='list-inline-item mx-3'><a href='#' class='text-dark'><i class='ti-twitter-alt'></i></a></li>
          <li class='list-inline-item mx-3'><a href='#' class='text-dark'><i class='ti-linkedin'></i></a></li>
          <li class='list-inline-item mx-3'><a href='#' class='text-dark'><i class='ti-github'></i></a></li>
        </ul>
      </div>
      <div class='col-lg-6 text-right'>
        <img class='img-fluid' src='images/banner-img.png' alt='banner-image'>
      </div>
    </div>
  </div>
</section>
<!-- /hero area -->

<!-- blog post -->
<section class='section'>
  <div class='container'>
    <div class='row'> ";
	

$limit = 12;
     $page = isset($_GET['page']) ? $_GET['page'] : 1;
     $start = ($page - 1) * $limit;
     $sql = "SELECT * FROM articles WHERE article_category = $_GET[id] LIMIT $start,$limit";
     $result = $db->query($sql);

if($result->num_rows == 0)
{
	echo "<h2>No articles</h2>";
}
while($row = $result->fetch_assoc())
{
	
	echo"
      <div class='col-12 mb-100'>
        <article data-file='articles/b.html' data-target='article' class='article-full-width'>
          <div class='post-image'>
            <img class='img-fluid' src='Profilepics/Articles/$row[article_unique_key]/$row[article_image]' alt='post-thumb'>
          </div>
          <div class='post-content'>
            <ul class='list-inline d-flex justify-content-between border-bottom post-meta pb-2 mb-4'>
              <li class='list-inline-item'><i class='ti-calendar mr-2'></i>$row[article_create]</li>
              <li class='list-inline-item'><i class='ti-alarm-clock mr-2'></i><span class='eta'>8 min</span> read</li>
            </ul>";
			
			
		echo"
            <h4 class='mb-4'>";
		if($row['article_block'] == 0)
		{			
		  echo"	<a href='content.php?id=$row[article_id]' class='text-dark'>$row[article_name]</a>";
		}
		else
		{
			echo"	<a href='#' class='text-dark' onclick='Blockalert()'>$row[article_name]</a>";
		}
		echo"	</h4>
            <p class='mb-0 post-summary'>$row[article_summary]</p>";
			if($row['article_block'] == 0)
			{	
             echo"<a class='btn btn-transparent mb-4' href='content.php?id=$row[article_id]'>Continue...</a>";
			}
			else
			{
				echo"<a class='btn btn-transparent mb-4' href='#' onclick='Blockalert()'>Continue...</a>";
			}
       echo" </div>
        </article>";
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
  {
	echo"";
  }
  else
  {
	  echo"<a href='Articleaddons/editarticle.php?id=$row[article_id]' class='float-right'>Edit</a>
	       <br><br>";
		  if($row['article_block'] == 0)
		  {
		   echo"<a href='Articleaddons/blockarticle.php?id=$row[article_id]' class='float-right'>Block</a>
		       <br><br>";
		  }
		  else
		  {
			  echo"<a href='Articleaddons/blockarticle.php?id=$row[article_id]' class='float-right'>Unblock</a>
		       <br><br>";
		  }
	  echo"<a href='Articleaddons/deletearticle.php?id=$row[article_id]' class='float-right'>Delete</a>";
  }
   echo"</div>";
	  
}
	  
	  ?>

    </div>
    <div class="row">
      <div class="col-12">
        <nav>
		<?php
		
		  $page_query = "SELECT * FROM articles WHERE article_category = $_GET[id]";
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
                           <span class='page-link'><a class='page-link' href='articles.php?id=$_GET[id]&page=$prev'>&laquo; Previous</a></span>
                            </li>";
				 }

				for($i=1;$i<=$total_pages;$i++) :
         echo" 
            <li class='page-item'><a class='page-link' href='articles.php?id=$_GET[id]&page=$i'>$i</a></li>";
			endfor;
			echo"
            <li class='page-item'>
              <a class='page-link' href='articles.php?id=$_GET[id]&page=$next'>Next &raquo;</a>
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
<script>
function Blockalert(){
	alert('This article has been blocked by an admin');
}
</script>
<?php include 'footer.php'; ?>