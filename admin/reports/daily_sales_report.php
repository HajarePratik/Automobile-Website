<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php $date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d"); ?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Daily Sales Report</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid mb-3">
            <fieldset class="px-2 py-1 border">
                <legend class="w-auto px-3">Filter</legend>
                <div class="container-fluid">
                    <form action="" id="filter-form">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="date" class="control-label">Choose Date</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="date" id="date" value="<?= date("Y-m-d", strtotime($date)) ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm bg-gradient-primary rounded-0"><i class="fa fa-filter"></i> Filter</button>
                                    <button class="btn btn-light btn-sm bg-gradient-light rounded-0 border" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
		</div>
        <div class="container-fluid" id="printout">
			<table class="table table-hover table-striped table-bordered">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="12%">
					<col width="12%">
					<col width="25%">
					<col width="10%">
					<col width="7%">
					<col width="7%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>SrNo</th>
						<th class='text-center'>Customer Name|Code</th>
						<th class='text-center'>Created Date</th>
						<th class='text-center'>Updated Date</th>
						<th class='text-center'>Product Name</th>
						<th class='text-center'>MRP</th>
						<th class='text-center'>Qty</th>
						<th class='text-center'>Discount</th>
						<th class='text-center'>Total</th>
						
					</tr>
				</thead>
				<tbody>
					<?php 
                    $total = 0;
					$i = 1;
                    $qry = $conn->query("SELECT tp.*,tl.code,tl.discount,tl.date_updated,tl.amount, tl.client_name,pl.name as product,tl.date_created 
					FROM `transaction_products` tp inner join transaction_list tl on tp.transaction_id = tl.id inner join product_list pl on tp.product_id = pl.id 
					where tl.status != 4 and date(tl.date_updated) = '{$date}' order by unix_timestamp(tl.date_updated) asc ");
                    while($row = $qry->fetch_assoc()):
                        $total += $row['price'] * $row['qty'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class='text-center'>
                                <div style="line-height:1em">
                                    <div><small><?= $row['code'] ?></small></div>
                                    <div><small><?= $row['client_name'] ?></small></div>
                                </div>
                       
							<td class='text-center'><?= date("d M, Y", strtotime($row['date_created'])) ?></td>
							<td class='text-center'><?= date("d M, Y", strtotime($row['date_updated'])) ?></td>
							<td class='text-center'><?= $row['product'] ?></td>
							<td class='text-center'><?= format_num($row['price']) ?></td>
							<td class='text-center'><?= format_num($row['qty']) ?></td>
							<td class='text-center'><?= $row['discount'].'%' ?></td>
							<td class='text-center'><?= format_num($row['price'] * $row['qty']) ?></td>
					
						</tr>
					<?php endwhile; ?>
				</tbody>
                <tfoot>
                    <th class="py-1 text-center" colspan="8">Total Sales</th>
                    <th class="py-1 text-center"><?= format_num($total,2) ?></th>
                </tfoot>
			</table>
		</div>
	</div>
</div>
<noscript id="print-header">
    <div>
    <div class="d-flex w-100">
        <div class="col-2 text-center">
            <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
        </div>
        <div class="col-8 text-center">
            <div style="line-height:1em">
                <h4 class="text-center mb-0"><b><?= $_settings->info('name') ?></b></h4>
                <h4 class="text-center mb-0"><b>Sales Report Details</b></h4>
                <div class="text-center"><b>as of</b></div>
                <h6 class="text-center mb-0"><b><?= date("F d, Y", strtotime($date)) ?></b></h6>
            </div>
        </div>
    </div>
    <hr>
    </div>
</noscript>
<script>
	$(document).ready(function(){
		$('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = "./?page=reports/daily_sales_report&"+$(this).serialize()
        })
        $('#print').click(function(){
            var h = $('head').clone()
            var ph = $($('noscript#print-header').html()).clone()
            var p = $('#printout').clone()
            h.find('title').text('Daily Sales Report - Print View')

            start_loader()
            var nw = window.open("", "_blank", "width="+($(window).width() * .8)+", height="+($(window).height() * .8)+", left="+($(window).width() * .1)+", top="+($(window).height() * .1))
                     nw.document.querySelector('head').innerHTML = h.html()
                     nw.document.querySelector('body').innerHTML = ph.html()
                     nw.document.querySelector('body').innerHTML += p[0].outerHTML
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                             nw.close()
                             end_loader()
                         }, 300);
                     }, 300);
        })
	})
	
</script>