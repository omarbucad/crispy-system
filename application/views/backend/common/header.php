 <nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-expand-toggle">
                <i class="fa fa-bars icon"></i>
            </button>
            <ol class="breadcrumb navbar-breadcrumb">
                <li class="active"><?php echo $page_name; ?></li>
            </ol>
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-th icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Switch Outlet</a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li class="title">
                        Notification <span class="badge pull-right">0</span>
                    </li>
                   
                </ul>

                <ul class="dropdown-menu  animated fadeInDown">
                    <li class="title">
                        Outlet List <span class="badge pull-right"><?php echo count($switch_outlet_list); ?></span>
                    </li>
                    <li>
                        <ul class="list-group notifications">

                            <?php foreach($switch_outlet_list as $key => $row) : ?>
                                <a href="<?php echo site_url('app/welcome/switch_outlet/'.$row->outlet_id); ?>">
                                    <li class="list-group-item">
                                        <?php if($key == 0): ?>
                                            <?php if($session_data->outlet_id == 0) : ?>
                                                <span class="badge">Active</span> 
                                            <?php endif; ?>
                                            <?php echo $row->outlet_name; ?>
                                        <?php else : ?>
                                            <?php if($session_data->outlet_id == $this->hash->decrypt($row->outlet_id)) : ?>
                                                <span class="badge">Active</span> 
                                            <?php endif; ?>
                                            <?php echo $row->outlet_name; ?>
                                        <?php endif; ?>
                                    </li>
                                </a>
                            <?php endforeach; ?>

                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown danger">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bell"></i> 4</a>
                <ul class="dropdown-menu danger  animated fadeInDown">
                    <li class="title">
                        Notification <span class="badge pull-right">4</span>
                    </li>
                    <li>
                        <ul class="list-group notifications">
                            <a href="#">
                                <li class="list-group-item">
                                    <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                </li>
                            </a>
                            <a href="#">
                                <li class="list-group-item">
                                    <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                </li>
                            </a>
                            <a href="#">
                                <li class="list-group-item">
                                    <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                </li>
                            </a>
                            <a href="#">
                                <li class="list-group-item message">
                                    view all
                                </li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $session_data->display_name; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li class="profile-img">
                        <img src="<?php echo site_url("thumbs/images/user/".$session_data->image_path.'/300/300/'.$session_data->image_name); ?>" alt="<?php echo $session_data->image_name; ?>" class="profile-img">
                    </li>
                    <li>
                        <div class="profile-info">
                            <h4 class="username"><?php echo $session_data->display_name; ?></h4>
                            <p><?php echo $session_data->email_address; ?></p>
                            <div class="btn-group margin-bottom-2x" role="group">
                                <a href="<?php echo site_url("app/profile"); ?>" class="btn btn-default"><i class="fa fa-user"></i> Profile</a>
                                <a href="<?php echo site_url("login/logout"); ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>