<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
include '/headers/login-header.php';
?>
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="<?php echo base_url(); ?>index.php/user/register" class="logo"><span>Result Analyser</span></a>
        <h5 class="text-muted m-t-0 font-600">User Registration</h5>
    </div>
    <div class="m-t-40 card-box">

        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Register</h4>
        </div>
        <?php
        $error = validation_errors();
        if (!empty($error)) {
            ?>
            <div class="alert alert-danger">
                <strong>Warning!</strong> <?php echo $error ?>
            </div>
            <?php
        }
        ?>
        <div class="panel-body">
            <form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>index.php/user/register"
                  data-parsley-validate
                  novalidate method="post">

                <div class="form-group">
                    <label for="emailAddress">Email address*</label>
                    <input type="email" name="email" parsley-trigger="change" required
                           placeholder="Enter email" class="form-control" id="emailAddress">
                </div>

                <div class="form-group ">
                    <label for="userName">User Name*</label>
                    <input class="form-control" name="username" type="text" required="" placeholder="Username">
                </div>
                <div class="form-group ">
                    <label for="userName">Name of the Institution*</label>
                    <select class="form-control select2" name="institution_id" required="" id="institution_id">
                        <option>Select Institution</option>
                        <?php
                        if (isset($instdata)) {
                        foreach ($instdata as $value) {
                        foreach ($value as $key => $val) { ?>
                        <optgroup label="<?php echo $key ?>">
                            <?php
                            foreach ($val as $option) { ?>
                                <option value="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>
                                <?php
                                }
                            }
                        }
                    } ?>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="userName">Department*</label>
                    <select class="form-control select2" name="department_id" required="" id="department_id">

                    </select>
                </div>

                <div class="form-group">
                    <label for="pass1">Password*</label>
                    <input id="pass1" data-parsley-minlength="6" type="password" placeholder="Password" required
                           class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="passWord2">Confirm Password *</label>
                    <input data-parsley-equalto="#pass1" type="password" required
                           placeholder="Password" class="form-control" id="passWord2" name="password_confirm">
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-custom">
                            <input id="checkbox-signup" type="checkbox" checked="checked" required="">
                            <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end card-box -->

    <div class="row">
        <div class="col-sm-12 text-center">
            <p class="text-muted">Already have account?<a href="login" class="text-primary m-l-5"><b>Sign
                        In</b></a></p>
        </div>
    </div>

</div>

<?php
include '/footers/login-footer.php'
?>
