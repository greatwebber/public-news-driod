<?php

require_once '../include/config.php';

$page_title ="All Post";

require_once './layouts/headerMain.php';

?>

<div class="page-content-wrapper">
    <div class="container">
        <!-- Settings Wrapper-->
        <div class="settings-wrapper">
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni lni-alarm"></i><span>Notifications</span></div>
                        <div class="data-content">
                            <div class="toggle-button-cover">
                                <div class="button r">
                                    <input class="checkbox" type="checkbox" checked>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni lni-night"></i><span>Night Mode</span></div>
                        <div class="data-content">
                            <div class="toggle-button-cover">
                                <div class="button r">
                                    <input class="checkbox" id="darkSwitch" type="checkbox">
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni lni-question-circle"></i><span>About Developer</span></div>
                        <div class="data-content"><a class="pl-4" href="contact.html"><i class="lni lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni lni-lock"></i><span class="text-center">Password <br><span>Updated <?=get_time_ago(strtotime(user_details['updateAt']))?></span></span></div>
                        <div class="data-content"><a href="change-password.html">Change<i class="lni lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once './layouts/footer.php';
?>
