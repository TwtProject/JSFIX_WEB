
<section class="content-header">
    <h1>
        Account
        <small>Change Password</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="halaman-utama.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Account</a></li>
        <li class="active">Change Password</li>
    </ol>
</section>
<!-- Main content -->
<section class="content" style="min-height: 525px;">
    <div class="callout callout-info">
        <h4>Reminder!</h4>
        Password harap tidak diberi tahu kepada siapapun.
    </div>
    <div class="row">
        <form role="form">
        </form>
        <div class="col-md-6 col-sm-offset-3">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Ganti Password</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="change-pass-do.php">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="oldPassword" class="col-sm-3 control-label">Old Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="oldPassword" placeholder="Password Lama" name="oldPass">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">New Password</label>

                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password Baru" name="newPass">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Confirm</label>

                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm Password Baru" name="conPass">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="simpan" class="btn btn-info pull-right">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>