<style type="text/css">
    .product-container{
    	overflow: auto;
    	max-height: 500px;
    }
	.product-container > ul{
        list-style-type: none;
        padding: 0px;
        overflow: hidden;
    }
    .product-container > ul > li{
        display: inline-flex;
        width: calc( ( 100% - (2 * 7px)) / 6);
        margin: 0px !important;
        cursor: pointer;
        padding-bottom: 20px;
    }
    .product-container > ul > li.with-stock > div{
        border-top: 3px solid #1ABC9C;
    }
    .product-container > ul > li.without-stock > div{
        border-top: 3px solid #FA2A00;
    }
    .product-container > ul > li > div{
        padding: 10px 5px;
        height: 110px;
        display: block;
        width: 100%;
        margin: 2px;
    }
    .product-container > ul > li > div > img{
        height: 50px;
    }
    .product-container > ul > li  p{
        font-size: 11px;
        height: 50px;
        font-weight: bold;
    }
    .product-container > ul > li.no-image{
        position: absolute;
    }
    .product-container > ul > li.no-image > div{
        height: 110px !important;
        position: relative;
        width: 92%;
    }
    .product-container > ul > li.no-image > div > p{
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
    }

    #pos_area{
        height:calc(100vh - 160px) ;
    }
    #pos_area > div , #pos_area > div > div {
        height: 100%;
    }
    #pos_area > div > div > form{
        height: calc(100% - 200px);
        position: relative;
    }
    #pos_area > div > div#register_closed_area a{
        position: absolute;
        right:    0;
        bottom:   0;
    }
    #register_open_area .select2-container--default .select2-selection--single{
        border-radius: 0px 4px 4px 0px;
    }
    #register_open_area > section{
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding-bottom: 5px;
    }
</style>
<div class="container" style="height: calc(100vh - 60px)">
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
    			<nav class="product-container">
                    <ul>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://cdn.shopify.com/s/files/1/1517/1764/products/Jeanne_grande.jpg?v=1488855784" class="img img-responsive">
                                <p>Fate/Grand Order Trading Acrylic Keychain Blind Box</p>
                            </div>
                        </li>
                        <li class="product-list text-center without-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center no-image with-stock"> 
                            <div class="thumbnail">
                                <p>Fate/Grand Order Trading Acrylic Keychain Blind Box</p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center without-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://cdn.shopify.com/s/files/1/1517/1764/products/Jeanne_grande.jpg?v=1488855784" class="img img-responsive">
                                <p>Fate/Grand Order Trading Acrylic Keychain Blind Box</p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center no-image with-stock"> 
                            <div class="thumbnail">
                                <p>Fate/Grand Order Trading Acrylic Keychain Blind Box</p>
                            </div>
                        </li>
                        <li class="product-list text-center with-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center without-stock"> 
                            <div class="thumbnail">
                                <img src="https://cdn.shopify.com/s/files/1/1517/1764/products/Jeanne_grande.jpg?v=1488855784" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>
                        <li class="product-list text-center without-stock"> 
                            <div class="thumbnail">
                                <img src="https://i.pinimg.com/736x/04/1f/29/041f297bc33e4f9473d58bc7c0f7a2c3--misa-vinyl-toys.jpg" class="img img-responsive">
                                <p>Fate/Grand Order </p>
                            </div>
                        </li>

                    </ul>
    			</nav>
    		</div>
    		<div class="col-xs-12 col-lg-4" id="pos_area">
    			<div class="card">
    				<div class="card-body hide" id="register_closed_area">
    					<div class="text-center" style="height: 200px;">
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

                    <div class="card-body " id="register_open_area">
                        <section class="register_header" style="height: 11%;">
                            <div class="text-right">
                                <a href="javascript:void(0);" class="btn btn-link">Park Sale</a>
                                <a href="javascript:void(0);" class="btn btn-link">Discard Sale</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                <select class="form-control select2">
                                    <option value="">Select a Customer</option>
                                    <option value="ADD_CUSTOMER">+Add a Customer</option>
                                </select>
                            </div>
                        </section>
                        <section class="register_body" style="height: 83%;">
                            
                        </section>
                        <section class="register_footer" style="height: 6%;">
                            <a href="javascript:void(0);" class="btn btn-success btn-block" style="overflow: hidden;">
                                <span class="pull-left">PAY</span>
                                <span class="pull-right"><?php echo $this->data['session_data']->currency_symbol;  ?>0.00</span>
                            </a>
                        </section>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
</div>