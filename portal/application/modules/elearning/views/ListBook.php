<?php
    $getproduct = mysqli_query($conn,"SELECT DISTINCT  products.p_available,
      products.p_id,
      products.image1,
      products.categ,
      products.p_name,
      products.s_price,
      products.d_price,
      products.stock_item,
      products.service_prom,
      ((reviews.star)/COUNT(reviews.p_id)/5)*100 AS rate_bg FROM products LEFT JOIN reviews ON  products.p_id = reviews.p_id GROUP BY products.p_id  ORDER BY reviews.star DESC  LIMIT 8");
    while($row = mysqli_fetch_assoc($getproduct)){
?>
<!-- firstbatch -->
<div class="col-md-3 col-xs-12 col-sm-6 mb-3 datarow">
<div class="hover p-2" >
<figure>
<a href="view_product.php?q=<?php echo htmlentities($row['p_id']);?>">    <div class="card-img">	<img id="img" class="card-img-top" src="./reseller/productimages/<?php echo htmlentities($row['p_id']);?>/<?php echo htmlentities($row['image1']);?>" data-echo="./reseller/productimages/<?php echo htmlentities($row['p_id']);?>/<?php echo htmlentities($row['image1']); ?>" alt=""></div> </a>
<ul>
<li>   <?php if(isset($_SESSION['u_id'])){ ?><a href="controller.php?rdr=<?php echo htmlentities(md5(rand(1,9))); ?>&& action=addwishes&&p=<?php echo htmlentities($row['p_id']); ?>&&rdc=<?php echo htmlentities(md5(rand(1,9))); ?>" title="Add to Wishlist"><i class="fa fa-heart"></i></a><?php }else{  ?><a  href="signin.php"><i class="fa fa-heart"></i></a><?php } ?></li>
<li>  <?php if(isset($_SESSION['u_id'])){  ?><a href="controller.php?rdr=<?php echo md5(rand(1,9)); ?>&&action=addcart&&p=<?php echo htmlentities($row['p_id']); ?>&&rdc=<?php echo htmlentities(md5(rand(1,9))); ?>" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a><?php }else{ ?> <a href="signin.php?r=<?php echo md5(rand(1,9)); ?>"  title="Add to Cart"><i class="fa fa-shopping-cart"></i></a> <?php } ?></li>
<li><a href="view_product.php?q=<?php echo htmlentities($row['p_id']);?>" title="Quick View"><i class="fa fa-search"></i></a></li>
</ul>
</figure>
<div class="card-body">
<div class="card-description">
<dl>
<dt  class="card-title"><?php echo htmlentities($row['p_name']); ?><br><small class="p-avai"><?php echo htmlentities($row['p_available']); ?>&nbsp;&nbsp;(<?php echo htmlentities($row['stock_item']); ?>)</small></dt>
<div class='result-container'>
<div class='rate-bg' style='width:<?php echo htmlentities($row["rate_bg"]) ?>%'></div>
<div class='rate-stars'></div>
</div>
<div class="row">
<dd class="prices">₱<?php echo number_format($row['s_price']); ?>.00</dd><a id="discount" style="   text-decoration:line-through;">₱<?php echo number_format($row['d_price']); ?>.00</a>
</div>
</dl>

</div>
</div>
</div>


</div>
<?php   }  ?>
