<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Parker’s business process entry app. Powered by Spirit and Dexterity Logics.">
    <meta name="keywords" content="Parker's, Process Entry, Business">
    <meta name="author" content="Dexterity Logics, Spirit">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parkers app - Login</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class = "row justify-content-center">
            <div class="col-md-4 contain">
                <!-- <form action = "" method = "post"> -->
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissible"  role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>

                <?php
                    if($message !== ''){
                        echo '<div class="alert alert-danger alert-dismissible"  role="alert"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            '.$message.'
                        </div>';
                    }
                    ?>
                <?php echo form_open('login'); ?>                        
                    <h3 class="formheading">SIGN IN</h3>                    
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name = "username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name = "password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger btn-block" value="Enter">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>