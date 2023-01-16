<!-- Footer Nav-->
<div class="footer-nav-area" id="footerNav">
    <div class="newsten-footer-nav h-100">
        <ul class="h-100 d-flex align-items-center justify-content-between">
            <li class="<?php active('home');?>"><a href="./home"><i class="lni lni-home"></i></a></li>
            <li class="<?php active('category');?>"><a href="./category"><i class="lni lni-grid-alt"></i></a></li>
            <li class="<?php active('trending');?>"><a href="./trending"><i class="lni lni-bolt-alt"></i></a></li>
            <li class="<?php active('profile');?>"><a href="./profile"><i class="lni lni-user"></i></a></li>
        </ul>
    </div>
</div>
<!-- All JavaScript Files-->
<script>
    $(document).ready(function () {
        $("form").submit(function (event) {
            var formData = {
                commentText: $("#commentText").val(),
                postID: $("#post_id").val(),
            };

            $.ajax({
                type: "POST",
                url: "./submitComment",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                // console.log(data);
               if(data.success){
                   Snackbar.show({
                       text: "Hello",
                       actionTextColor: "#fff",
                       backgroundColor: "danger",
                       pos: "top-right",
                       duration: "5000",
                       actionText: "close"
                   });
               }
            });

            event.preventDefault();
        });
    });</script>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/waypoints.min.js"></script>
<script src="../assets/js/jquery.easing.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/jquery.animatedheadline.min.js"></script>
<script src="../assets/js/jquery.counterup.min.js"></script>
<script src="../assets/js/default/apexcharts.min.js"></script>
<script src="../assets/js/default/charts-custom-data.js"></script>
<script src="../assets/js/wow.min.js"></script>
<script src="../assets/js/default/date-clock.js"></script>
<script src="../assets/js/default/dark-mode-switch.js"></script>
<script src="../assets/js/default/active.js"></script>

</body>
</html>