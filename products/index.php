<style>
    #productAccordion button.btn.btn-block.text-left.font-weight-bolder:focus {
        box-shadow: none !important;
    }
    #search-field .form-control.rounded-pill{
        border-top-right-radius:0 !important;
        border-bottom-right-radius:0 !important;
        margin-top : 30px;
        border-right:none !important
        
    }
    #search-field .form-control:focus{
        box-shadow:none !important;
    }
    #search-field .form-control:focus + .input-group-append .input-group-text{
        border-color: #86b7fe !important
    }
    #search-field .input-group-text.rounded-pill{
        border-top-left-radius:0 !important;
        border-bottom-left-radius:0 !important;
        margin-top : 30px;
        border-right:left !important
      
        
    }
    #product-list .card-image-top-holder>img{
        width: 100%;
        height: 25vh;
        object-fit: cover;
        object-position: center center;
        transition:all .3s ease-in-out;
    }
    #product-list .card:hover .card-image-top-holder>img{
        transform: scale(1.2);
    }

.featured-cars-content{padding-top:30px;}

/*.single-featured-cars*/
.featured-img-box {
    border: 1px solid #dadfe9;
    margin-top: 20px;

}
.featured-cars-img {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 30px;
    height: 240px;
    border-bottom: 1px solid #dadfe9;
}
.featured-model-info{padding:5px 7px;}
.featured-model-info p {
    font-size: 12px;
    color: #8c92a0;
    text-transform: capitalize;
}
.featured-mi-span{display: inline-block;margin:0 10px;}
.featured-hp-span{display: inline-block;margin-right: 10px;}
.featured-cars-txt{margin:21px 0 47px;}
.featured-cars-txt h2 a{font-size: 16px;margin-bottom: 15px;}
.featured-cars-txt h2 a span{text-transform: uppercase;}
.featured-cars-txt h3{margin-bottom: 10px;}
.featured-cars-txt h3,.featured-cars-txt p{font-size: 13px;}
/*.single-featured-cars*/

.section-header{
    position: relative;
    text-align: center;
}
.section-header h2{
    position: relative;
    font-size: 34px;
    font-weight: 500;
    padding-bottom: 25px;
}

.section-header h2:before {
    position: absolute;
    content: "";
    width: 80px;
    height: 2px;
    bottom: 0;
    left: 50%;
    margin-left: -42px;
    background: #4e4ffa;

}	
</style>
<div class="section py-5">
    <div class="container">
    <div class="section-header">
			<h2>Our Products</h2>
	</div><!--/.section-header-->
        <div class="row justify-content-center" >
            <div class="col-lg-8 col-md-10 col-sm-12 col-sm-12 mb-3" style = margin-top: 10px;>
                <div class="input-group input-group-lg" id="search-field">
                    <input type="search" class="form-control form-control-lg  rounded-pill" aria-label="Search product Field" id="search" placeholder="Search Product Here">
                    <div class="input-group-append">
                        <span class="input-group-text rounded-pill bg-transparent"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-2" id="product-list">
				<?php 
				$products = $conn->query("SELECT * FROM `product_list` where delete_flag = 0 and `status` = 1 order by `name` asc");
				while($row = $products->fetch_assoc()):
				?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 px-2">
            <div class="single-featured-cars">
				<div class="card rounded-0">
					<div class="featured-cars-img">
                    <img src="<?= validate_image($row['image_path']) ?>" class="card-image-top" alt="" width="180" height="200">
        			</div>
                
                    <div class="featured-model-info">
						<p>
                                <h5 class="card-title"><?= $row['name'] ?></h5>
								<p class="card-text truncate-3"><?= str_replace(["\n\r","\n","\r"], "<br/>", $row['description']) ?></p>
						</p>
					</div>
					</div>
					
				</div>
        </div>
            <?php endwhile; ?>
        </div>

    </div>  
</div>
<script>
    $(function(){
        $('.read-more').click(function(){
			uni_modal("<i class='fa fa-bars'></i> Product Details","products/view_product.php?id="+$(this).attr('data-id'))
		})
        $('#search').on('input', function(){
            var _search = $(this).val().toLowerCase()
            $('#product-list .card').each(function(){
                var _text = $(this).text().toLowerCase()
                _text = _text.trim()
                if(_text.includes(_search) === false){
                    $(this).parent().toggle(false)
                }else{
                    $(this).parent().toggle(true)
                }
            })
        })
    })
</script>