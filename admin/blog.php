<?php
$page_title = "Blogs";
$page_intro = "All Blogs";
require_once './include/function.php';

require_once './layouts/header.php';

?>
<?php flash(); ?>


    <div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <a class="btn btn-primary" href="./post">Add Post</a>
        </div>

        <div class="box-body">

            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>Featured Image</th>
                        <th>Title</th>
                        <th>Post</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Tags</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = $conn->query('SELECT * FROM blogs b left join categories c on b.categories = c.category_id order by b.id DESC');
                    $stmt->execute();
                    $sn =1;
                    while ($cat = $stmt->fetch(PDO::FETCH_ASSOC)){

                        ?>
                        <tr>
                            <td><?=$sn++?></td>
                            <td><img src="../assets/img/post/<?=$cat['featured_image']?>" alt="" width="50px" height="50px" style="border-radius: 50%"></td>
                            <td><?=ucwords($cat['title'])?></td>
                            <td><?=ucwords(substr($cat['post'],0,50))?>....</td>
                            <td><?=ucwords($cat['category_name'])?></td>
                            <td><?=ucwords($cat['blog_author'])?></td>
                            <td><?=$cat['tags']?></td>
                            <td><?=userStatus($cat['featured'])?></td>
                            <td><?=userStatus($cat['blog_status'])?></td>
                            <td><?=$cat['createdAt']?></td>
                            <td><?=$cat['updatedAt']?></td>
                            <td><button class="btn btn-primary">Edit</button></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>

                    <tr>
                        <th class="disabled"></th>
                        <th>Featured Image</th>
                        <th>Title</th>
                        <th>Post</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Tags</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="disabled"></th>
                    </tr>

                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div>
    </div><!-- /.box -->


    <!-- Modal -->
    <div class="modal fade" id="addAuthor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Author</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Author Name</label>
                                    <input class="form-control" type="text" name="author_name" placeholder="Author Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Author Description</label>
                                    <textarea class="form-control" name="author_description" id="" cols="30" rows="10" style="resize: none" required></textarea>
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
                        <button type="submit" class="btn btn-primary" name="addAuthor">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<?php
require_once './layouts/footer.php';
?>