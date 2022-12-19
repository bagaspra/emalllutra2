<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<style>#mapid { height: 300px; } .show-map{ display:none; } </style>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<?php 
echo "<div class='col-md-12'>
    <div class='box box-info'>
      <div class='box-header with-border'>
        <h3 class='box-title'>Identitas Website</h3>
      </div>
    <div class='box-body'>

    <div class='panel-body'>
      <ul id='myTabs' class='nav nav-tabs' role='tablist'>
        <li role='presentation' class='active'><a href='#umum' id='umum-tab' role='tab' data-toggle='tab' aria-controls='umum' aria-expanded='true'>Data Umum </a></li>
        <li role='presentation' class=''><a href='#payment' role='tab' id='payment-tab' data-toggle='tab' aria-controls='payment' aria-expanded='false'>Payment</a></li>
        <li role='presentation' class=''><a href='#server' role='tab' id='server-tab' data-toggle='tab' aria-controls='server' aria-expanded='false'>Server / API</a></li>
        <li role='presentation' class=''><a href='#app' role='tab' id='app-tab' data-toggle='tab' aria-controls='app' aria-expanded='false'>App Widget</a></li>
        <li role='presentation' class=''><a href='#sosial' role='tab' id='sosial-tab' data-toggle='tab' aria-controls='sosial' aria-expanded='false'>Sosial Login</a></li>
        <li role='presentation' class=''><a href='#verifikasi' role='tab' id='verifikasi-tab' data-toggle='tab' aria-controls='verifikasi' aria-expanded='false'>Verifikasi Akun</a></li>
      </ul><br>";

      echo $this->session->flashdata('message');
            $this->session->unset_userdata('message');

      echo "<div id='myTabContent' class='tab-content'>
            <div role='tabpanel' class='tab-pane fade active in' id='umum' aria-labelledby='umum-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
              $maps = explode('|',$record['maps']);
              $ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
              $fv = explode('|',$ref['keterangan']);

          echo "<div class='col-md-6 col-xs-12'>
                  <input type='hidden' name='id' value='$record[id_identitas]'>
                  <input type='hidden' class='form-control' name='d' value='$record[facebook]'>
                  <input type='hidden' class='form-control' name='e' value='$record[rekening]'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Website</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='title' value='".config('title')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Domain</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='c' value='$record[url]'>
                    </div>
                  </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Title</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='a' value='$record[nama_website]'>
                      </div>
                    </div>

                    
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Meta Keyword</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:80px' placeholder='' name='h'>$record[meta_keyword]</textarea>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Meta Deskripsi</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:80px' placeholder='' name='g'>$record[meta_deskripsi]</textarea>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Info Footer</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:60px' placeholder='' name='info_footer'>".config('info_footer')."</textarea>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Twitter</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='twitter' value='".config('twitter')."'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>FB Pixel</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='facebook_pixel' value='".config('facebook_pixel')."'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Google verif.</label>
                      <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='google_site_verification' value='".config('google_site_verification')."'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Mode Aktif</label>
                      <div class='col-sm-9'>";
                          echo "<input type='radio' name='mode' id='mode1' value='marketplace' class='radio marketplace' ".(config('mode')=='marketplace'?'checked':'')."> <label for='mode1'>Marketplace</label>
                                <input type='radio' name='mode' id='mode2' value='ecommerce' class='radio ecommerce' ".(config('mode')=='ecommerce'?'checked':'')."> <label for='mode2'>E-Commerce</label>";
         
                      echo "</div>
                        
                    </div>
                    <div class='desc' style='".(config('mode')=='ecommerce'?'display:block':'display:none')."'>
                      <div class='alert alert-danger'><b>PENTING</b> - Pastikan di system sudah terdaftar 1 <a href='".base_url().$this->uri->segment(1)."/reseller'>PELAPAK</a> dan jika lebih dari 1 maka pastikan hanya 1 pelapak saja yang di <u><b>Verfikasi</b></u>, karena pelapak terverfikasi akan menjadi default toko posting produk mode E-Commerce. </div>
                    </div>
                </div>

                <div class='col-md-6 col-xs-12'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Izin Publish</label>
                    <div class='col-sm-9'>";
                        echo "<input type='radio' name='approve_produk' id='izin1' class='radio' value='N' ".(config('approve_produk')=='N'?'checked':'')."> <label for='izin1'>Ya</label>
                              <input type='radio' name='approve_produk' id='izin2' class='radio' value='Y' ".(config('approve_produk')=='Y'?'checked':'')."> <label for='izin2'>Tidak</label>";
                      echo "<br><small style='color:green'><i>Produk yang diposting (Pelapak) perlu persetujuan untuk publish.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Resolution</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='resolusi_center' value='".config('resolusi_center')."'>
                      <small style='color:green'><i>Nama Tampil - untuk Admin Resolution Center</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Info Atas</label>
                    <div class='col-sm-9'>
                    <textarea class='form-control' style='height:80px' placeholder='' name='info_atas'>$record[info_atas]</textarea>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>No Telpon</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='f' value='$record[no_telp]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Flash Deal</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control datepicker1' placeholder='' name='flash_deal' value='".tgl_view($record['flash_deal'])."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Free Seller</label>
                    <div class='col-sm-9'>
                    <input type='number' class='form-control' placeholder='' name='free_reseller' value='$record[free_reseller]'>
                    <small style='color:green'><i>Jumlah Produk yang dapat diposting oleh Pelapak (Free Seller)</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>WA Seller</label>
                    <div class='col-sm-9'>";
                      echo "<input type='radio' id='wa1' name='wa_seller' class='radio' value='Y' ".(config('wa_seller')=='Y'?'checked':'')."> <label for='wa1'>Aktif</label>
                            <input type='radio' id='wa2' name='wa_seller' class='radio' value='N' ".(config('wa_seller')=='N'?'checked':'')."> <label for='wa2'>Non Aktif</label>";

                    echo "<br><small style='color:green'><i>Izinkan Konsumen Menghubungi Pelapak via Whatsapp?</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Referral</label>
                    <div class='col-sm-9'>";
                      echo "<input class='radio' id='ref1' type='radio' name='token_referral' value='Y' ".(config('token_referral')=='Y'?'checked':'')."> <label for='ref1'>Ya</label>
                              <input class='radio' id='ref2' type='radio' name='token_referral' value='N' ".(config('token_referral')=='N'?'checked':'')."> <label for='ref2'>Tidak</label>";

                    echo "<br><small style='color:green'><i>Langsung Aktifkan URL Referral Saat Pendaftaran Konsumen?</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                      <label class='col-sm-3 control-label'>Favicon</label>
                      <div class='col-sm-9'>
                        <input type='file' class='form-control' name='j'>
                        Favicon Aktif Saat ini : <img style='width:32px; height:32px' src='".base_url()."asset/images/$record[favicon]'>
                      </div>
                    </div>

                  
                </div>

              <div style='clear:both'></div>
              <div class='box-footer'>
                <button type='submit' name='umum' class='btn btn-primary'>Simpan Perubahan</button>
                <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>";
              echo form_close();
            echo "</div>



            <div role='tabpanel' class='tab-pane fade' id='payment' aria-labelledby='payment-tab'>";
            $attributes = array('class'=>'form-horizontal','role'=>'form');
            echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
              echo "<input type='hidden' name='id' value='$record[id_identitas]'>
              <div class='col-md-6 col-xs-12'> 
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Verifikasi Toko</label>
                    <div class='col-sm-8'>";
                      echo "<input class='radio' id='verif1' type='radio' name='verifikasi' value='Y' ".($fv[1]=='Y'?'checked':'')."><label for='verif1'>Ya</label>
                            <input class='radio' id='verif2' type='radio' name='verifikasi' value='N' ".($fv[1]=='N'?'checked':'')."><label for='verif2'>Tidak</label>";
     
                    echo "<br><small style='color:green'><i>Verifikasi Pengaktifan Akun Toko/Pelapak oleh admin.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Order requires</label>
                    <div class='col-sm-8'>";
                      echo "<input class='radio' id='order1' type='radio' name='requires' value='enable' ".($fv[2]=='enable'?'checked':'')."><label for='order1'>Harus Login</label>
                            <input class='radio' id='order2' type='radio' name='requires' value='disable' ".($fv[2]=='disable'?'checked':'')."><label for='order1'>Tanpa Login</label>";

                    echo "<br><small style='color:green'><i>Untuk Order Produk harus Login atau tanpa Login?</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Fee Admin (Rp)</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='admin_fee' value='$fv[0]'>
                    <small style='color:green'><i>Fee admin tiap transaksi sukses (Dibebankan ke Konsumen).</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Fee Produk (%)</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='fee_produk' value='".config('fee_produk')."'>
                    <small style='color:green'><i>Terapkan Fee Transaksi Per-Produk (Dibebankan ke Pelapak).</i></small>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Fee Referal (%)</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='referral_fee' value='$ref[referral]'>
                    <small style='color:green'><i>Fee diambil dari transaksi sukses pelapak yang disponsori.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Fee Withdraw</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='withdraw_fee' value='".config('withdraw_fee')."'>
                    <small style='color:green'><i>Fee untuk Tiap Transaksi Withdraw / Penarikan Dana.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Min. Withdraw</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='withdraw_min' value='".config('withdraw_min')."'>
                    <small style='color:green'><i>Nilai Minimal Tiap Transaksi Withdraw / Penarikan Dana.</i></small style='color:green'>
                    </div>
                  </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Kurir Lokal</label>
                    <div class='col-sm-9'>
                      <input class='radio' id='kurir_lokal1' type='radio' name='kurir_lokal' value='Y' ".(config('kurir_lokal')=='Y'?'checked':'')."> <label for='kurir_lokal1'>Aktif</label>
                      <input class='radio' id='kurir_lokal2' type='radio' name='kurir_lokal' value='N' ".(config('kurir_lokal')=='N'?'checked':'')."> <label for='kurir_lokal2'>Non-Aktif</label>
                    </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Kurir Nasional</label>
                    <div class='col-sm-9'>
                      <input class='radio' id='kurir_nasional1' type='radio' name='kurir_nasional' value='Y' ".(config('kurir_nasional')=='Y'?'checked':'')."> <label for='kurir_nasional1'>Aktif</label>
                      <input class='radio' id='kurir_nasional2' type='radio' name='kurir_nasional' value='N' ".(config('kurir_nasional')=='N'?'checked':'')."> <label for='kurir_nasional2'>Non-Aktif</label>
                    </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Kurir Toko (COD)</label>
                    <div class='col-sm-9'>
                      <input class='radio' id='kurir_toko1' type='radio' name='kurir_toko' value='Y' ".(config('kurir_toko')=='Y'?'checked':'')."> <label for='kurir_toko1'>Aktif</label>
                      <input class='radio' id='kurir_toko2' type='radio' name='kurir_toko' value='N' ".(config('kurir_toko')=='N'?'checked':'')."> <label for='kurir_toko2'>Non-Aktif</label>
                    </div>
                </div><br>

                  <p class='titlepg'><span class='fa fa-gears'></span> Setting Kurir Internal</p>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Tarif Roda 2 / KM</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='ongkir_per_km' value='".config('ongkir_per_km')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Tarif Roda 4 / KM</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='ongkir_per_km_roda4' value='".config('ongkir_per_km_roda4')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Jarak max (KM)</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='max_jarak_km' value='".config('max_jarak_km')."'>
                    <small style='color:green'><i>Jarak Layanan Kurir Roda 2 dan 4 yang dilayani.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Kordinat Pusat</label>
                    <div class='col-sm-8'>
                    <input type='text' class='form-control form-mini btn-geolocationx' value='".config('kordinat')."' name='kordinat' id='lokasi' autocomplete='off' />
                    <label class='switch mr-1 mt-2'>
                        <input type='checkbox' name='alamat_lainx' id='alamat_lain'> Cari Kordinat dari Peta
                    </label><br>
                    <small style='color:green'><i>Kordinat default marker pada maps Lokasi.</i></small style='color:green'>

                    <div class='show-map'>
                        <div id='mapid' class='shadow-sm'></div>
                    </div>
                    </div>
                  </div>

                </div>

              <div class='col-md-6 col-xs-12'>
                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Transfer Manual</label>
                    <div class='col-sm-9'>
                      <input class='radio' id='ipaym1' type='radio' name='transfer_manual' value='Y' ".(config('transfer_manual')=='Y'?'checked':'')."> <label for='ipaym1'>Aktif</label>
                      <input class='radio' id='ipaym2' type='radio' name='transfer_manual' value='N' ".(config('transfer_manual')=='N'?'checked':'')."> <label for='ipaym2'>Non-Aktif</label>
                    </div>
                </div><br>
                
              <p class='titlepg'><span class='fa fa-gears'></span>  Api Ipaymu</p>
                <div class='form-group'>
                  <label class='col-sm-3 control-label'>API ipaymu</label>
                  <div class='col-sm-9'>
                  <textarea class='form-control' placeholder='XXXXXXX-XXXXXX-XXXX-XXXXXX-XXXXXXXXXX' name='ipaymu'>".config('ipaymu')."</textarea>
                  </div>
                </div>

                <div class='form-group'>
                  <label class='col-sm-3 control-label'>Url ipaymu</label>
                  <div class='col-sm-9'>
                  <input type='text' class='form-control' name='ipaymu_url' value='".config('ipaymu_url')."'>
                  </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Fee Ipaymu</label>
                    <div class='col-sm-9'>
                    <input type='number' class='form-control' name='ipaymu_fee' value='".config('ipaymu_fee')."'>
                    <small style='color:green'><i>Fee Transaksi Ipaymu dibayarkan oleh Konsumen.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Status ipaymu</label>
                    <div class='col-sm-9'>
                      <input class='radio' id='ipay1' type='radio' name='ipaymu_aktif' value='Y' ".(config('ipaymu_aktif')=='Y'?'checked':'')."> <label for='ipay1'>Aktif</label>
                      <input class='radio' id='ipay2' type='radio' name='ipaymu_aktif' value='N' ".(config('ipaymu_aktif')=='N'?'checked':'')."> <label for='ipay2'>Non-Aktif</label>
                    </div>
                </div>

                <br><br>
                <p class='titlepg'><span class='fa fa-gears'></span>  Api Tripay</p>

                <div class='form-group'>
                  <label class='col-sm-3 control-label'>Merchant Code</label>
                  <div class='col-sm-9'>
                  <input type='text' class='form-control' name='merchant_code' value='".config('merchant_code')."'>
                  </div>
                </div>

                <div class='form-group'>
                  <label class='col-sm-3 control-label'>Private Key</label>
                  <div class='col-sm-9'>
                  <input type='text' class='form-control' name='private_key' value='".config('private_key')."'>
                  </div>
                </div>

                <div class='form-group'>
                  <label class='col-sm-3 control-label'>Api Key</label>
                  <div class='col-sm-9'>
                  <input type='text' class='form-control' name='api_key' value='".config('api_key')."'>
                  </div>
                </div>

                <div class='form-group'>
                  <label class='col-sm-3 control-label'>Payment URL</label>
                  <div class='col-sm-9'>
                  <input type='text' class='form-control' name='payment_url' value='".config('payment_url')."'>
                  </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Status Tripay</label>
                    <div class='col-sm-9'>
                      <input class='radio' id='tripay1' type='radio' name='tripay_aktif' value='Y' ".(config('tripay_aktif')=='Y'?'checked':'')."> <label for='tripay1'>Aktif</label>
                      <input class='radio' id='tripay2' type='radio' name='tripay_aktif' value='N' ".(config('tripay_aktif')=='N'?'checked':'')."> <label for='tripay2'>Non-Aktif</label>
                    </div>
                </div>

              </div>

                

                
                <div style='clear:both'></div>
                <div class='box-footer'>
                  <button type='submit' name='payment' class='btn btn-primary'>Simpan Perubahan</button>
                  <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>";
                echo form_close();
              echo "</div>



              <div role='tabpanel' class='tab-pane fade' id='server' aria-labelledby='server-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
                echo "<input type='hidden' name='id' value='$record[id_identitas]'>
                  <div class='col-md-6 col-xs-12'>
                  <p class='titlepg'><span class='fa fa-gears'></span>  Api Whatsapp</p>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>WA Gateway</label>
                    <div class='col-sm-9'>";
                    if (config('wa_gateway')=='wablas'){
                      $text1 = 'Domain Wablas';
                      $text2 = 'API Wablas';
                      echo "<input class='radio' id='gate1' type='radio' name='wa_gateway' value='wablas' ".(config('wa_gateway')=='wablas'?'checked':'')."><label for='gate1'>Wablas.com</label>
                            <input class='radio' id='gate2' type='radio' name='wa_gateway' value='woowa'><label for='gate2'>Woo-wa.com (Woowandroid)</label>";
                    }else{
                      $text1 = 'Authorization/License';
                      $text2 = 'Device / CS ID';
                      echo "<input class='radio' id='gate1' type='radio' name='wa_gateway' value='wablas'><label for='gate1'>Wablas.com</label>
                            <input class='radio' id='gate2' type='radio' name='wa_gateway' value='woowa' ".(config('wa_gateway')=='woowa'?'checked':'')."><label for='gate2'>Woo-wa.com (Woowandroid)</label>";
                    }
                    echo "</div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label text1'>$text1</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' name='wa_domain' placeholder='- - - - - - - -' value='".config('wa_domain')."'>
                    </div>
                  </div>
                  
                  <div class='form-group'>
                    <label class='col-sm-3 control-label text2'>$text2</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' name='wa' placeholder='- - - - - - - -' value='".$maps[2]."'>
                    </div>
                  </div>

                  <br><br>
                  <p class='titlepg'><span class='fa fa-gears'></span>  Api PPOB</p>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>API PPOB</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' name='maps' placeholder='API dari https://tripay.co.id' value='".$maps[0]."'>
                        <input type='text' class='form-control' style='color:red; margin-top: 3px;' name='pin' placeholder='PIN Transaksi' value='".$maps[1]."'>
                    </div>
                  </div>
                  
                  <br><br>
                  <p class='titlepg'><span class='fa fa-gears'></span> Shipping Gateway</p>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>API Rajaongkir</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' name='api_rajaongkir' placeholder='API https://rajaongkir.com PRO' value='$record[api_rajaongkir]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>API Binderbyte</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' name='api_resi' placeholder='API Cek Resi Dari https://binderbyte.com/' value='".config('api_resi')."'>
                        <small style='color:green'><i>Api Cek Resi Alternatif untuk : <span style='color:red'>".config('api_resi_off')."</span></i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Api Resi Aktif</label>
                    <div class='col-sm-9'>";
                      echo "<input class='radio' id='wab1' type='radio' name='api_resi_aktif' value='rajaongkir' ".(config('api_resi_aktif')=='rajaongkir'?'checked':'')."> <label for='wab1'>Rajaongkir (Binderbyte Alternatif)</label>
                            <input class='radio' id='wab2' type='radio' name='api_resi_aktif' value='binderbyte' ".(config('api_resi_aktif')=='binderbyte'?'checked':'')."> <label for='wab2'>Binderbyte (Only)</label>";

                    echo "</div>
                  </div>
                </div>

                <div class='col-md-6 col-xs-12'>
                <p class='titlepg'><span class='fa fa-gears'></span>  Api Mutasi Bank</p>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Api MutasiBank</label>
                    <div class='col-sm-9'>
                    <textarea class='form-control' placeholder='API http://mutasibank.co.id' name='api_mutasibank'>$record[api_mutasibank]</textarea>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Api Moota</label>
                    <div class='col-sm-9'>
                    <textarea class='form-control' placeholder='API https://moota.co' name='api_moota'>".config('api_moota')."</textarea>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Api Aktif</label>
                    <div class='col-sm-9'>";
                      echo "<input class='radio' id='mutasi1' type='radio' name='mutasi_aktif' value='mutasibank' ".(config('mutasi_aktif')=='mutasibank'?'checked':'')."><label for='mutasi1'>mutasibank.co.id</label>
                            <input class='radio' id='mutasi2' type='radio' name='mutasi_aktif' value='moota' ".(config('mutasi_aktif')=='moota'?'checked':'')."><label for='mutasi2'>moota.co</label>";

                    echo "</div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Callback Mutasi</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' style='color:red' value='".$this->uri->segment(1)."/mutasi_ty35fgdfgd777bba064b72be' disabled>
                    </div>
                  </div>
                
                <br><br>
                <p class='titlepg'><span class='fa fa-gears'></span>  Server Email</p>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Jenis</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' value='SMTP' disabled>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Secure</label>
                    <div class='col-sm-9'>";
                      echo "<input class='radio' id='sec1' type='radio' name='smtp_secure' value='tls' ".(config('smtp_secure')=='tls'?'checked':'')."><label for='sec1'>TLS</label> 
                            <input class='radio' id='sec2' type='radio' name='smtp_secure' value='ssl' ".(config('smtp_secure')=='ssl'?'checked':'')."><label for='sec2'>SSL</label> ";

                    echo "</div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Server</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='Ex : smtp.googlemail.com' name='email_server' value='".config('email_server')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Port</label>
                    <div class='col-sm-9'>
                    <input type='number' class='form-control' placeholder='xxx' name='email_port' value='".config('email_port')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Pengirim</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='Nama Pengirim Email (Ex : Emall Luwu Utara)' name='pengirim_email' value='$record[pengirim_email]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>E-mail Addr.</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='Alamat Email' style='margin-top:3px' name='b' value='$record[email]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Password</label>
                    <div class='col-sm-9'>
                    <input type='password' class='form-control' placeholder='*************' style='margin-top:3px' name='password'>
                    </div>
                  </div>


                </div>
                <div style='clear:both'></div>
                <div class='box-footer'>
                  <button type='submit' name='server' class='btn btn-primary'>Simpan Perubahan</button>
                  <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>";
                echo form_close();
              echo "</div>

              <div role='tabpanel' class='tab-pane fade' id='app' aria-labelledby='app-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
          echo "<div class='col-md-6 col-xs-12'>
                  <input type='hidden' name='id' value='$record[id_identitas]'>
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Judul</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='apps_title' value='".config('apps_title')."'>
                      </div>
                    </div>

                    
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Keterangan</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:120px' placeholder='' name='apps_deskripsi'>".config('apps_deskripsi')."</textarea>
                      </div>
                    </div>
                    
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Image</label>
                      <div class='col-sm-9'>
                        <input type='file' class='form-control' name='apps_image'>
                        Gambar Terpasang : <a target='_BLANK' href='".base_url()."asset/images/".config('apps_image')."'>".config('apps_image')."</a>
                      </div>
                    </div>
                </div>

                <div class='col-md-6 col-xs-12'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Google Play</label>
                    <div class='col-sm-9'>
                    <input type='url' class='form-control' placeholder='https://...' name='apps_google_play' value='".config('apps_google_play')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>App Store</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='https://...' name='apps_app_store' value='".config('apps_app_store')."'>
                    </div>
                  </div>
                  
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Status</label>
                    <div class='col-sm-9'>";
                      echo "<input class='radio' id='stat1' type='radio' name='apps_aktif' value='Y' ".(config('apps_aktif')=='Y'?'checked':'')."><label for='stat1'>Aktif</label>
                              <input class='radio' id='stat2' type='radio' name='apps_aktif' value='N' ".(config('apps_aktif')=='N'?'checked':'')."><label for='stat2'>Non-Aktif</label>";
 
                    echo "</div>
                  </div>
                  
                </div>

              <div style='clear:both'></div>
              <div class='box-footer'>
                <button type='submit' name='apps' class='btn btn-primary'>Simpan Perubahan</button>
                <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>";
              echo form_close();
            echo "</div>


            <div role='tabpanel' class='tab-pane fade' id='sosial' aria-labelledby='sosial-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
          echo "<div class='col-md-12 col-xs-12'>
                  <input type='hidden' name='id' value='$record[id_identitas]'>
                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>application_name</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='application_name' value='".config('application_name')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>redirect_uri</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='redirect_uri' value='".config('redirect_uri')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>facebook_app_id</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='facebook_app_id' value='".config('facebook_app_id')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>facebook_app_secret</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='facebook_app_secret' value='".config('facebook_app_secret')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>Google client_id</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='google_client_id' value='".config('google_client_id')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>Google client_secret</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='google_client_secret' value='".config('google_client_secret')."'>
                    </div>
                  </div>
                </div>

              <div style='clear:both'></div>
              <div class='box-footer'>
                <button type='submit' name='sosial' class='btn btn-primary'>Simpan Perubahan</button>
                <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>";
              echo form_close();
            echo "</div>

            <div role='tabpanel' class='tab-pane fade' id='verifikasi' aria-labelledby='verifikasi-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
          echo "<div class='col-md-12 col-xs-12'>
                  <input type='hidden' name='id' value='$record[id_identitas]'>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>Verifikasi OTP</label>
                    <div class='col-sm-9'>";
                      echo "<input class='radio' id='otp1' type='radio' name='otp' value='aktif' ".(config('otp')=='aktif'?'checked':'')."><label for='otp1'>Aktif</label>
                              <input class='radio' id='otp2' type='radio' name='otp' value='non-aktif' ".(config('otp')=='non-aktif'?'checked':'')."><label for='otp2'>Non-Aktif</label>";

                    echo "<br><small style='color:green'><i>Verifikasi OTP Via Whatsapp dan Email</i></small>
                    </div>
                  </div>


                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>Status</label>
                    <div class='col-sm-9'>";
                      echo "<input class='radio' id='statu1' type='radio' name='verifikasi_akun' value='Y' ".(config('verifikasi_akun')=='Y'?'checked':'')."><label for='statu1'>Aktif</label>
                              <input class='radio' id='statu2' type='radio' name='verifikasi_akun' value='N' ".(config('verifikasi_akun')=='N'?'checked':'')."><label for='statu2'>Non-Aktif</label>";

                    echo "</div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>Label Verifikasi</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' name='jenis_verifikasi' value='".config('jenis_verifikasi')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                      <label class='col-sm-2 control-label'>Verifikasi Info</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:180px' placeholder='' name='verifikasi_info'>".config('verifikasi_info')."</textarea>
                      </div>
                    </div>
                  
                </div>

              <div style='clear:both'></div>
              <div class='box-footer'>
                <button type='submit' name='verifikasi' class='btn btn-primary'>Simpan Perubahan</button>
                <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>";
              echo form_close();
            echo "</div>

            </div></div></div>";
?>
<script>
$(document).ready(function() {
$(".mode").click(function() {
  // remove the background color from all labels.
  $(".mode").removeClass("btn-primary");

  // add the background only to the parent-label of the clicked button.
  $(this).parent().addClass("btn-primary");
});

  $(".marketplace").click(function(){
    $(".desc").hide();
  });
  $(".ecommerce").click(function(){
    $(".desc").show();
  });

  $('input[name="wa_gateway"]').on('change', function(){
    if ($(this).val()=='wablas') {
      //change to "show update"
      $(".text1").text("Domain Wablas");
      $(".text2").text("API Wablas");
    }else  {
      $(".text1").text("Authorization");
      $(".text2").text("Device / CS ID");
    }
});
});
</script>

<script>
$('document').ready(function(){
    $('#assign').click(function(){
    var ag = $('#multiple_select').val();
        $('[name="pilihan_kurir"]').val(ag);
    });

    $("body").on("click", "input[name='alamat_lainx']", function () {
      if ($('#alamat_lain').is(':checked')) {
        $(".show-map").show();
        showMapsx();
      }else{
        $(".btn-geolocationx").val('');
        $(".show-map").hide();
      }
    });
});

function showMapsx() {
  // MAPS
  var mymap = L.map("mapid").setView(
    [<?php echo ($row['kordinat_lokasi']==''?config('kordinat'):$row['kordinat_lokasi']); ?>],
    15
  );
  L.tileLayer(
    "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw", {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: "mapbox/streets-v11",
      tileSize: 512,
      zoomOffset: -1,
    }
  ).addTo(mymap);

  L.marker([<?php echo ($row['kordinat_lokasi']==''?config('kordinat'):$row['kordinat_lokasi']); ?>])
    .addTo(mymap)
    .bindPopup("Silahkan klik map untuk mendapatkan koordinat.")
    .openPopup();

  var popup = L.popup();

  function onMapClick(e) {
    popup
      .setLatLng(e.latlng)
      .setContent(
        "Map yang anda klik berada di " + e.latlng.lat + ", " + e.latlng.lng
      )
      .openOn(mymap);
    document.getElementById("lokasi").value =
      e.latlng.lat + ", " + e.latlng.lng;
  }

  mymap.on("click", onMapClick);
}

$(window).ready(function () {
  $(".btn-geolocationx").click(findLocationx);
});

function findLocationx() {
  navigator.geolocation.getCurrentPosition(getCoordsx, handleErrorsx);
}

function getCoordsx(position) {
  $(".btn-geolocationx").val(
    position.coords.latitude + "," + position.coords.longitude
  );
}

function handleErrorsx(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      alert("You need to share your geolocation data.");
      break;

    case error.POSITION_UNAVAILABLE:
      alert("Current position not available.");
      break;

    case error.TIMEOUT:
      alert("Retrieving position timed out.");
      break;

    default:
      alert("Error");
      break;
  }
}
</script>
            
