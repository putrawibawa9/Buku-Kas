<?php
require_once '../Resource/header.php'; 
require_once '../Controller/Category.php'; 


$category = new Category;
$category = $category->readcategory();
?>


  
    
    <div class="container">
      <div class="row">
        <div class="col-12 p-3 bg-white">
          <h3 class="text-center mb-5 mt-5">Category List</h3>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">ID Category</th>
                    <th class="text-center">Category Name</th>
                    <th class="text-center">Category Type</th>                  
                  </tr>
            </thead>
            <tbody>
              <?php foreach($category as $row):?>
                <tr>
                  <td class="text-center" ><?=$row['category_id']?></td>
                  <td ><?=$row['category_name']?></td>
                  <td class="text-center" ><?=$row['category_type']?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
        </table>
        <div>
          
          </div>
    </div>
  </div>
</div>



<?php require_once '../Resource/footer.php';?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.category-list').addClass('active');
</script>
 
