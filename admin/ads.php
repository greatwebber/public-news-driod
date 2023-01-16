<?php
$page_title = "Advertisement";
$page_intro = "All Ads";
require_once './include/function.php';

require_once './layouts/header.php';

?>
<?php flash(); ?>



    <div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addAdvertisement">Add Ads</button>
        </div>

        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NO</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Url</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $conn->query('SELECT * FROM ads order by id DESC');
                $stmt->execute();
                $sn =1;
                while ($ads = $stmt->fetch(PDO::FETCH_ASSOC)){

                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><img src="../assets/img/category/<?=$ads['image']?>" alt="" width="50px" height="50px" style="border-radius: 50%"></td>
                        <td><?=ucwords($ads['title'])?></td>
                        <td><?=$ads['url']?></td>
                        <td><?=$ads['createdAt']?></td>
                        <td><button class="btn btn-primary">Edit</button></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                <tfoot>

                <tr>
                    <th class="disabled"></th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Url</th>
                    <th>Created At</th>
                    <th class="disabled"></th>
                </tr>

                </tfoot>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


    <!-- Modal -->
    <div class="modal fade" id="addAdvertisement" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Advertisement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Advertisement Title</label>
                                    <textarea class="form-control" name="title" id="" cols="30" rows="10" style="resize: none" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">url</label>
                                    <input type="text" class="form-control" name="url" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image" id="exampleInputFile" accept="image/*" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addAdvertisementSubmit">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<?php
require_once './layouts/footer.php';
?>