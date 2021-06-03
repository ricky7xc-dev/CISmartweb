<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url('assets/img/cabean.jpg');?>) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title" style="color: white;">Search Product</h2>
                                <nav class="bradcaump-inner">
                                  <a  style="color: white;" class="breadcrumb-item" href="index.html">Home</a>
                                  <span style="color: white;" class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active" style="color: white;">Search Product</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 
        <!-- Start Our Product Area -->
        <section class="htc__product__area shop__page ptb--50 bg__white">
            <div class="container">

                <div class="htc__product__container">
                    <!-- Start Product MEnu -->
                    
                <a href="<?php echo site_url ('shop') ?>"><button class="btn btn-info">< Shop Page</button></a>
                <h1 style="text-align: center;">Cari</h1><br>

                <div class="container" style="text-align: center;">

                <?php echo form_open('shop/cari');?>
                  <div class="form-group">
                    <input type="text" class="form-control center-block" style="width: 50%;" id="cari" name="cari" placeholder="Cari Produk">
                  </div>
                  <button type="submit" class="btn btn-primary form-control" style="width: 50%;" id="btnCari" name="btnCari">Cari</button>
                <?php echo form_close();?>

                </div>
                <!-- search bar -->


                    <div class="row">
                        <div class="product__list another-product-style">
                            <!-- dari database -->


                            <!-- foreach cabe merah -->
                            <?php foreach ($produk as $cb) : ?>

                            <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                                <img src="<?php echo base_url().'/assets3/img/'.$cb->img ;?>" alt="product images">
                                        </div>
                                    </div>
                                    <div class="product__details">
                                        <h2><a href="product-details.html"><?php echo $cb->nama_cabe ?></a></h2>
                                        <ul class="product__price">
                                            <li class="new__price">Rp. <?php echo number_format($cb->harga,0,',','.') ?></li>
                                        </ul><p>Stok Tersedia : <?php echo $cb->stok ?></p><br>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalbeli1<?php echo $cb->kode_cabe; ?>">Tambah ke keranjang</button>
                                        <?php echo anchor('shop/detailproduk/'.$cb->kode_cabe,'<button class="btn btn-success">Detail</button>') ?>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>


                    
                </div>
            </div>
        </section>

