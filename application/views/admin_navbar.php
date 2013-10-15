<!DOCTYPE html>
<html>
    <head>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        
        <!-- Validate Plugin -->
        <script src="<?php echo base_url('static/js'); ?>/jquery.validate.js"></script>
        
        <link href="<?php echo base_url('static'); ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
        
        
        
        <script src="<?php echo base_url('static'); ?>/bootstrap/js/bootstrap.min.js"></script>
        
        
        <style type="text/css">
             label.valid {
              width: 24px;
              height: 24px;
              background: url(<?php echo base_url('static'); ?>/images/valid.png) center center no-repeat;
              display: inline-block;
              text-indent: -9999px;
            }
            label.error {
              font-weight: bold;
              color: red;
              padding: 2px 8px;
              margin-top: 2px;
            }
        </style>
    </head>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
<!--                <a class="brand" href="#"> Feature</a>-->
                <div class="nav-collapse">
                    <ul class="nav">
                        <li><a href="<?php echo base_url('welcome'); ?>"><i class="icon-home icon-black"></i> Competition</a></li>
                        <li><a href="<?php echo base_url('admin/createCompetition'); ?>">Create Competition</a></li>
                        <li><a href="<?php echo base_url('admin/manage_competitions'); ?>">Manage Competitions</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Users <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="<?php echo base_url('admin/manageAdmin'); ?>">Admin</a></li>
                                <li><a href="<?php echo base_url('admin/settingsSelectActiveCompetition'); ?>">Settings</a></li>
                                <li class="divider"></li>
                                <li class="nav-header">Database</li>
                                <li><a href="<?php echo base_url('admin/view_users'); ?>">View</a></li>
                                <li><a href="<?php echo base_url('admin/downloadAllUsers'); ?>"> Download</a></li>
                            </ul>
                        </li>
                </div><!-- /.nav-collapse -->
            </div><!-- /.container -->
        </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->
    </br>   
    </br>

