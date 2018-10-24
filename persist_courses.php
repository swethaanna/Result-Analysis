<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
include '/headers/admin-header.php'
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Add Courses</h4>
                            <input type="hidden" name="course_id">
                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/course/create"
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
                                <input type="hidden" name="course_id">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Course Name*</label>
                                    <div class="col-sm-7">
                                        <input type="text" required="" class="form-control"
                                               id="userName" name="course_name" placeholder="Course Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Degree *</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="course_type">
                                            <option value="UG">UG</option>
                                            <option value="PG">PG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Course Code*</label>
                                    <div class="col-sm-7">
                                        <input type="text" required="" class="form-control"
                                               id="userName" required="" name="course_code" placeholder="Course Code">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">No of Semesters*</label>
                                    <div class="col-sm-7">
                                        <input type="number" required="" class="form-control"
                                               required="" name="course_semesters" placeholder="Number of Semesters">
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
                <div class="editable-responsive">
                    <table class="table table-striped table-bordered nowrap"
                           cellspacing="0" width="100%" id="courses_datatable">
                        <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Course Type</th>
                            <th>Number of Semesters</th>
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
<!-- end row -->

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

<?php
include '/footers/admin-footer.php'
?>
