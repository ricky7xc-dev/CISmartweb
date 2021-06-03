<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url('assets/img/profile.jpg');?>) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title" style="color: white;">My Profile</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html" style="color: white;">Home</a>
                                  <span class="brd-separetor" style="color: white;">/</span>
                                  <span class="breadcrumb-item active" style="color: white;">My Profile</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <div class="single-portfolio-area bg__white ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="single-portfolio-img">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="portfolio-description mrg-sm">
                            <h2><?= $user['name']; ?></h2>
                            
                            <div class="portfolio-info">
                                <ul>
                                    <li><span>Email:</span><?= $user['email']; ?></li>


                                    <?php if($user['role_id'] == 1){?>
                                        <li><span>Role: </span>Admin</li>
                                    <?php } else {?>
                                        <li><span>Role: </span>User</li>
                                    <?php } ?>

                                    <?php if($user['is_active'] == 1){?>
                                        <li><span>Status: </span>Active</li>
                                    <?php } else {?>
                                        <li><span>Status: </span>Nonactive</li>
                                    <?php } ?>


                                    <li><span>Account Created:</span><?= date('d F Y', $user['date_created']); ?></li>
                                </ul>
                            </div><br>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Edit Profile
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>

                                  <form class="login">
                                    <div id="konfirmasi"></div>
                                  <div class="modal-body">
                                    <input class="hidden" type="text" name="txtId" id="txtId" value="<?= $user['id']; ?>">
                                    <input type="text" name="txtNama" id="txtNama" value="<?= $user['name']; ?>">
                                    <input type="text" name="txtEmail" id="txtEmail" value="<?= $user['email']; ?>" readonly>
                                    <input type="text" name="txtImg" id="txtImg" value="<?= $user['image']; ?>">
                                  </div>
                                  </form>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
$(document).ready(function() {
    $('#btnSimpan').click(function(){
            
        $.post( "<?php echo base_url(); ?>profile/add/", {
                type:1,
                txtNama:$('#txtNama').val(),
                txtId:$('#txtId').val(),
                txtImg:$('#txtImg').val()

            }, function( data ) {
                
                console.log(data);
                    obj = $.parseJSON(data);
                        
                    if (obj.msg[0]=="ok"){
                        $('#konfirmasi').html(
                            '<div class="alert alert-success alert-dismissible fade in" role="alert">'+
                            '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '   <strong>Sukses</strong><br/>'+obj.msg[1]+
                            '</div>');
                            
                        setTimeout(function() {
                            $('#konfirmasi').html('');
                        },2000);
                        
                        $('#txtNama').val('');
                        $('#txtId').val('');
                        $('#txtImg').val('');
                        
                    } else {
                        
                        $('#konfirmasi').html(
                            '<div class="alert alert-danger alert-dismissible fade in" role="alert">'+
                            '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '   <strong>Error</strong><br/>'+obj.msg[1]+
                            '</div>');
                    }
                      
                      setInterval('location.reload()', 1000);  
                
            });
            
    });

});
</script>