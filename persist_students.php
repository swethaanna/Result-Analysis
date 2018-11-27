<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
include '/headers/user-header.php'
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Add Student</h4>

                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/student/create"
                                  data-parsley-validate
                                  novalidate method="post" onReset="updateForm();">
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
                                <input type="hidden" name="student_id">
                                <div class="form-group">
                                    <label for="studentName" class="col-sm-4 control-label">Student Name*</label>
                                    <div class="col-sm-7">
                                        <input type="text" required="" class="form-control"
                                               id="studentName" name="student_name" placeholder="Student Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Current Semester</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="current_semster">
                                            <?php
                                            if (isset($instdata)) {
                                                foreach ($instdata as $value) {
                                                    $data = array_values($value);
                                                    ?>
                                                    <option value="<?php echo $data[0] ?>"><?php echo $data[1] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="register_number" class="col-sm-4 control-label">Register Number</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="student_regno" class="form-control"
                                               id="registerNumber" placeholder="Register Number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="joiningYear" class="col-sm-4 control-label">Year of Joining</label>
                                    <div class="col-sm-7">
                                        <input type="number" name="student_batch" class="form-control"
                                               id="joiningYear" placeholder="Year of Joining">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                name="create_update" id="save-button" value="Create">
                                            Save
                                        </button>

                                        <button type="reset"
                                                class="btn btn-default waves-effect waves-light m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: panel body -->
        </div> <!-- end panel -->
    </div> <!-- end col-->
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap"
                           cellspacing="0" width="100%" id="student_datatable">
                        <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Register Number</th>
                            <th>Course</th>
                            <th>Department</th>
                            <th>Current Semester</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: panel body -->
    </div> <!-- end panel -->
</div> <!-- end col-->
</div>

<div id="dialog" class="modal-block mfp-hide">
    <section class="panel panel-info panel-color">
        <header class="panel-heading">
            <h2 class="panel-title">Are you sure?</h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p>Are you sure that you want to delete this row?</p>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-md-12 text-right">
                    <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                    <button id="dialogCancel" class="btn btn-default waves-effect">Cancel</button>
                </div>
            </div>
        </div>

    </section>
</div>
<!-- end row -->

<?php
include '/footers/user-footer.php'
?>
