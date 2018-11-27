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
                            <h4 class="header-title m-t-0 m-b-30">Add Institution</h4>

                            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/institution/create"
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
                                <input type="hidden" name="institution_id">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Institution Name*</label>
                                    <div class="col-sm-7">
                                        <input type="text" required="" class="form-control"
                                               id="userName" name="institution_name" placeholder="Institution Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">District</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="institution_district">
                                            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                            <option value="Kollam">Kollam</option>
                                            <option value="Pathanamthitta">Pathanamthitta</option>
                                            <option value="Alappuzha">Alappuzha</option>
                                            <option value="Kottayam">Kottayam</option>
                                            <option value="Ernakulam">Ernakulam</option>
                                            <option value="Idukki">Idukki</option>
                                            <option value="Thrissur">Thrissur</option>
                                            <option value="Palakkad">Palakkad</option>
                                            <option value="Malappuram">Malappuram</option>
                                            <option value="Kozhikode">Kozhikode</option>
                                            <option value="Wayanad">Wayanad</option>
                                            <option value="Kannur">Kannur</option>
                                            <option value="Kasargode">Kasargode</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Available Programs*</label>
                                    <div class="col-sm-7">
                                        <select multiple="multiple" class="multi-select" id="course_code" name="course_code[]" data-plugin="multiselect" data-selectable-optgroup="true">
                                            <?php
                                            if (isset($instdata)) {
                                            foreach ($instdata

                                            as $value) {
                                            foreach ($value

                                            as $key => $val) {
                                            ?>
                                            <optgroup label="<?php echo $key ?>">
                                                <?php
                                                foreach ($val as $option) {
                                                    ?>
                                                    <option value="<?php echo $option['id'] ?>"
                                                            id="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>

                                                    <?php
                                                }
                                                }
                                                }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Institution Address</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="institution_address" class="form-control"
                                               id="userName" placeholder="Institution Address">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="webSite" class="col-sm-4 control-label">Web Site*</label>
                                    <div class="col-sm-7">
                                        <input type="url" required parsley-type="url" class="form-control"
                                               id="webSite" placeholder="URL" name="institution_url">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="institution_code" class="col-sm-4 control-label">Institution AICTE
                                        Code*</label>
                                    <div class="col-sm-7">
                                        <input type="text" data-mask="9-999999999" required
                                               class="form-control"
                                               id="institution_code" name="institution_code"
                                               placeholder="Affiliation Code">
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
                           cellspacing="0" width="100%" id="institution_datatable">
                        <thead>
                        <tr>
                            <th>Institution ID</th>
                            <th>Institution Name</th>
                            <th>Institution Address</th>
                            <th>Institution District</th>
                            <th>Institution Code</th>
                            <th>Institution URL</th>
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
include '/footers/admin-footer.php'
?>
