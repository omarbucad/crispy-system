<style type="text/css">
    .product-container{
    	overflow: auto;
    	max-height: 500px;
    }
	.product-container > a > div{
		padding-top: 5px;
	}
	.product-container > a.with-stock > div{
		border-top: 3px solid #1ABC9C;
	}
	.product-container > a.without-stock > div{
		border-top: 3px solid #FA2A00;
	}
	.product-container > a > div.without-image{
		height: 116px;
		position: relative;
	}
	.product-container > a > div.without-image > p{
		margin: 0;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    margin-right: -50%;
	    transform: translate(-50%, -50%)
	}
	.product-container > a > div > img{
		height: 80px;
	}
</style>
<div class="container-fluid">
    <div class="side-body padding-top">
    	<div class="row">
    		<div class="col-xs-12 col-lg-8">
    			<h1>Main Register <br> <a href="#"><small>Switch <i class="fa fa-angle-down"></i></small></a></h1>
    			<hr>
    			<div class="form-group">
    				<label for="product">Search for products</label>
    				<select class="select2 form-control">
    					<option>Start Typing or Scanning</option>
    					<option>Product 1</option>
    					<option>Product 2</option>
    				</select>
    			</div>
    			<div class="row product-container">
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 with-stock">
    					<div class="thumbnail">
    						<img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
    						<p>Product 1</p>
    					</div>
    				</a>
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 without-stock">
    					<div class="thumbnail">
    						<img src="https://images-na.ssl-images-amazon.com/images/I/410UJvZdNUL.jpg" class="img img-responsive">
    						<p>Product 2</p>
    					</div>
    				</a>
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 with-stock">
    					<div class="thumbnail">
    						<img src="https://li3.rightinthebox.com/images/128x128/201707/yqsp1499416464183.jpg" class="img img-responsive">
    						<p>Product 3</p>
    					</div>
    				</a>
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 with-stock">
    					<div class="thumbnail">
    						<img src="https://cdn.shopify.com/s/files/1/1517/1764/products/Jeanne_grande.jpg?v=1488855784" class="img img-responsive">
    						<p>Product 1</p>
    					</div>
    				</a>
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 with-stock">
    					<div class="thumbnail without-image">
    						<p>Fate/Grand Order Trading Acrylic Keychain Blind Box</p>
    					</div>
    				</a>
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 with-stock">
    					<div class="thumbnail">
    						<img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
    						<p>Product 1</p>
    					</div>
    				</a>
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 with-stock">
    					<div class="thumbnail">
    						<img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
    						<p>Product 1</p>
    					</div>
    				</a>
    				<a href="javascript:void(0);" class="product-list text-center col-lg-2 with-stock">
    					<div class="thumbnail">
    						<img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
    						<p>Fate/Grand Order Trading Acrylic Keychain Blind Box</p>
    					</div>
    				</a>
    			</div>
    		</div>
    		<div class="col-xs-12 col-lg-4">
    			<div class="card">
    				<div class="card-body" id="register_closed_area">
    					<div class="text-center">
    						<img src="<?php echo base_url("public/img/register-closed.svg"); ?>">
    						<h4>Register Closed <br> <small class="help-block">Set an opening float to open the register and make a sale.</small></h4>
    					</div>
    					<form action="<?php echo site_url("app/pos/open_register"); ?>" class="form-horizonal">
    						<div class="form-group">
    							<label for="opening_float">Opening Float</label>
    							<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><?php echo $this->data['session_data']->currency_symbol; ?></span>
								  <input type="number" step="0.01" name="opening_float" class="form-control" id="opening_float" placeholder="0.00">
								</div>
    						</div>
    						<div class="form-group">
    							<label for="opening_notes">Notes <small>Optional</small></label>
    							<textarea class="form-control" rows="3" style="height: 70px;resize: none;" placeholder="Enter a note"></textarea>
    						</div>
    						<a href="javascript:void(0);" class="btn btn-block btn-success">Open Register</a>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>