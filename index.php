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
              <a class='btn btn-outline-light' href='articles.php?id=$row[cat_id]&page=1'>read more</a>";
			  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
			  {
				  
			  }
              else
			  {				  
			   echo"<br>
			        <a href='Categoryaddons/editcategory.php?id=$row[cat_id]' class='btn btn-outline-warning float-left'>Edit</a>
		            <a href='Categoryaddons/deletecategory.php?id=$row[cat_id]' class='btn btn-outline-danger float-right'>Delete</a>";
              } 
	 echo"      </div>
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
$sql = "SELECT * FROM articles ORDER BY article_create DESC LIMIT $start,$limit";
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
          <img class='img-fluid mb-4' src='Profilepics/Articles/$row[article_unique_key]/$row[article_image]' alt='post-thumb'>";
       
	   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
  {
	echo"";
  }
  else
  {    echo "<div class='row'>";
	  echo"<div class='col-lg-4'>
	       <a href='Articleaddons/editarticle.php?id=$row[article_id]' class='float-right'>Edit</a>
	       
		   </div>";
		  if($row['article_block'] == 0)
		  {
		   echo"<div class='col-lg-4'>
		       <a href='Articleaddons/blockarticle.php?id=$row[article_id]' class='float-right'>Block</a>
		       </div>
			   ";
		  }
		  else
		  {
			  echo"<div class='col-lg-4'>
			      <a href='Articleaddons/blockarticle.php?id=$row[article_id]' class='float-right'>Unblock</a>
		       <br><br>
			   </div>";
		  }
	  echo"<div class='col-lg-4'>
	      <a href='Articleaddons/deletearticle.php?id=$row[article_id]' class='float-right'>Delete</a>
		   </div>";
	  echo "</div>
	        <br>";
  }
		 
		  
		  
	echo"	  
          <h4 class='title-border'>";
		  if($row['article_block'] == 0)
         {
		  echo "<a class='text-dark' href='content.php?id=$row[article_id]'>$row[article_name]</a>";
		  
		 }
		 else
		 {
			 echo "<a class='text-dark' href='#' onclick='Blockalert()'>$row[article_name]</a>";
		 }
		 echo"
		  </h4>
          <p>$row[article_summary]</p>";
		  if($row['article_block'] == 0)
		  {
          echo "<a href='content.php?id=$row[article_id]' class='btn btn-transparent'>read more</a>";
		  }
		  else
		  {
			  echo "<a href='#' class='btn btn-transparent' onclick='Blockalert()'>read more</a>";
		  }
    
	echo" </article>
      </div>
	  ";
}
	  
	  ?>
      
      
    </div>
    <div class="row">
      <div class="col-12">
        <nav>
		<?php
		
		  $page_query = "SELECT * FROM articles ORDER BY article_create DESC";
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
<script>
function Blockalert(){
	alert('This article has been blocked by an admin');
}
</script>
<?php include 'footer.php'; ?>