<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
include '/headers/user-header.php'
?>

<div class="col-lg-10">
    <div class="card-box">

        <h2 class="header-title m-t-0 m-b-30"> Welcome to <?php
            $user_data = $this->session->userdata('userdata');
            if (!empty($user_data)) {
                echo $user_data['department_id'];
            } ?> Department</h2>

        <div class="text-center">
            <ul class="list-inline chart-detail-list">
                <li>
                    <h5 style="color: #5b69bc;"><i class="fa fa-circle m-r-5"></i>Passed</h5>
                </li>
                <li>
                    <h5 style="color: #35b8e0;"><i class="fa fa-circle m-r-5"></i>Failes</h5>
                </li>
            </ul>
        </div>
        <div id="morris-area-with-dotted" style="height: 300px;"></div>
    </div>
</div>


<?php
include '/footers/user-footer.php'
?>
