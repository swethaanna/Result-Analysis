<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
include '/headers/login-header.php'
?>
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="index.php" class="logo"><span>Result Analyser</span></a>
        <h5 class="text-muted m-t-0 font-600">Dashboard Login</h5>
    </div>
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal m-t-20" method="post" action="<?php echo base_url(); ?>index.php/user/login">

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Username" name="username">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-custom">
                            <input id="checkbox-signup" type="checkbox" name="remember_me">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <?php
                $error = validation_errors();
                if (!empty($error)) {
                    ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo $error?>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log
                            In
                        </button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="<?php echo base_url(); ?>index.php/user/password_recover" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
                            password?</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- end card-box-->

    <div class="row">
        <div class="col-sm-12 text-center">
            <p class="text-muted">Don't have an account? <a href="<?php echo base_url(); ?>index.php/User/register" class="text-primary m-l-5"><b>Sign
                        Up</b></a></p>
        </div>
    </div>

</div>

<?php
include '/footers/login-footer.php'
?>
