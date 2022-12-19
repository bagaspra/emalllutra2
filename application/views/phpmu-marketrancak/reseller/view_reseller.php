<div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li>Semua Toko</li>
            </ul>
        </div>
    </div>
<section class="ps-store-list" style='padding-top:30px;'>
  <div class="container">
      <div class="ps-section__content">
          <div class="ps-section__search row">
              <div class="col-md-12">
                <?php 
                  echo "<div class='form-group'>";
                  echo form_open_multipart('produk/reseller'); 
                  echo "<input type='text' name='cari_reseller' class='form-control' placeholder='Cari Nama Toko atau kota...'>
                        <button type='submit' name='submit'><i class='icon-magnifier'></i></button>";
                  echo form_close();
                  echo "</div>";
                ?>
              </div>
          </div>
          <?php 
            if (isset($_POST['submit'])){
              echo "<div class='alert alert-info'><b>Pencarian : </b>".filter($this->input->post('cari_reseller'))."</div>";
            } 
          ?>
          <div class="row">
              <?php 
                $no = 1;
                foreach ($record->result_array() as $row){
                  $produk = $this->db->query("SELECT * FROM rb_produk where id_reseller='$row[id_reseller]'")->num_rows();
                  if (!file_exists("asset/foto_user/$row[foto]") OR $row['foto']==''){ $foto_user = "toko.jpg"; }else{ $foto_user = $row['foto']; }
                  if (trim($row['nama_kota'])==''){ 
                      $kota = '<i style="color:red">Kota Tidak Ada..</i>'; 
                  }else{
                      $alamat_kota = kecamatan($row['kecamatan_id'],$row['kota_id']); 
                      $exp = explode(',',$alamat_kota);
                      $kota = "<b>".$exp[0].", ".$exp[1]."</b>";
                  }
                  echo "<div class='col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 '>
                      <article class='ps-block--store-2'>
                          <div class='ps-block__content bg--cover' data-background='".base_url()."asset/images/default-store-banner.png' style='background: url(&quot;".base_url()."asset/images/default-store-banner.png&quot;);'>
                              <figure>
                                <h4 style='background:#f7f7f7; padding:10px; border-bottom:2px solid #f05025; color:#000'>$row[nama_reseller]</h4>
                                <p style='color:#000 !important;'>$kota, $row[alamat_lengkap]<br>
                                +".format_telpon($row['no_telpon'])."</p>

                                <h4 style='text-align:right'>Ada <span class='badge badge-secondary'  style='background:#8a8a8a'>$produk</span> Produk</h4>
                              </figure>
                          </div>
                          <div class='ps-block__author'><a class='ps-block__user' href='#'><img src='".base_url()."asset/foto_user/$foto_user' alt=''></a><a class='ps-btn' href='".base_url()."u/$row[user_reseller]'>Kunjungi Toko</a></div>
                      </article>
                  </div>";
                }
              ?>
              
          </div>
          <div class="ps-pagination">
                <?php echo $this->pagination->create_links(); ?>
              </div>
      </div>
  </div>
</section>


