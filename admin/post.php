<?php
$page_title = "Post";
$page_intro = "New Post";
require_once './include/function.php';

require_once './layouts/header.php';

?>
<?php flash(); ?>

            <!-- general form elements -->
    <div class="col-md-12">
        <div class="row">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">New Post</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                            </div>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="">Add Title</label>
                                    <input type="text" class="form-control" placeholder="Add Title" name="title" required>
                                    <input type="text" value="admin" name="blog_author"  hidden>
                                </div>

                            </div><!-- /.box-body -->

                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Post <small>Text Post</small></h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                                </div><!-- /. tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body pad">
                    <textarea id="editor1" name="post" rows="10" cols="80" required>
                    </textarea>
                            </div>
                        </div><!-- /.box -->


                    </div><!-- /.box -->

                </div>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Publish</h3>

                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                            </div>
                        </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="featured"> Featured
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="2" name="draft"> Save Draft
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="publish"> Publish
                                    </label>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="addPost">Publish</button>
                            </div>
                    </div><!-- /.box -->

                </div>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Category</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="categories" required>
                                                <option selected="selected">Select Category</option>
                                                <?php
                                                $stmt = $conn->query('SELECT * FROM categories order by category_name DESC');
                                                $stmt->execute();
                                                
                                                while($category = $stmt->fetch(PDO::FETCH_ASSOC)){


                                                ?>
                                                <option value="<?=$category['category_id']?>"><?=$category['category_name']?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tags</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Separate with Comma</label>
                                        <input type="text" class="form-control" name="tags" placeholder="Separate with Comma" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Featured Image</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" type="file" name="image" id="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
require_once './layouts/footer.php';
?>
