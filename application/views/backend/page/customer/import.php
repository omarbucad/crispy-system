
<div class="container-fluid">
    <div class="side-body padding-top">

        <div class="container" >
        	<a href="<?php echo site_url('app/customer'); ?>" style="display:inline-block;"><i class="fa fa-arrow-left fa-3x"  aria-hidden="true"></i> </a> <h1 style="display:inline-block;">Import Customers</h1>
        </div>
        <div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Create a CSV. We'll check your CSV for common errors before uploading it. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="<?php echo site_url('app/customer'); ?>" class="btn btn-success ">Back to Customers</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <form action="<?php echo site_url("app/customer/import-customer");?>">
                <div class="dropzone-container">
                    <div>
                        <i class="fa fa-upload fa-5x" aria-hidden="true"></i>
                    </div>
                    <h2>Upload a CSV to import customers.</h2>
                    <p>Drag and drop the CSV file anywhere, or <a href="#" class="text-underline">browse</a> your files.</p>
                </div>
            </form>
        </div>
    </div>
</div>