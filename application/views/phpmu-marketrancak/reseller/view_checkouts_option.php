<?php 
$proses = '<i class="text-danger">Pending</i>'; 
$total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-(a.diskon*a.jumlah)) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."'")->row_array();
$kupon_pusat = $this->db->query("SELECT b.nilai_kupon as diskon FROM rb_penjualan_temp a JOIN rb_produk_kupon b ON a.id_kupon_lain=b.id_kupon where a.session='".$this->session->idp."' GROUP BY a.id_kupon_lain")->row_array();
?>
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="<?php echo base_url()."produk/keranjang"; ?>">Keranjang</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__content">
            <div class="table-responsive">
              <?php echo "<form action='".base_url()."produk/selesai_belanja' method='POST'>"; ?>
                <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                <?php 
                  echo "<center>Sudah Punya akun? <a href='#' style='text-decoration:underline' data-toggle='modal' data-target='.bd-example-modal-lg'>Login disini</a></center><hr><br>
                  
                  <div class='form-group row' style='margin-bottom:5px'>
                        <label class='col-sm-2 col-form-label' style='margin-bottom:1px; font-weight:bold'>Nama anda</label>
                        <div class='col-sm-10'>
                            <input type='text' name='nama' class='form-control form-mini' placeholder='- - - - - - - - -' autocomplete='off' required>
                        </div>
                        </div>
                        <div class='form-group row' style='margin-bottom:5px'>
                        <label class='col-sm-2 col-form-label' style='margin-bottom:1px; font-weight:bold'>Kontak</label>
                        <div class='col-sm-10'>
                            <div class='form-row'>
                                <div class='form-group col-md-6' style='margin-bottom:5px'>
                                    <input type='number' name='telpon' class='form-control form-mini' placeholder='No Hp/Telpon' autocomplete='off' required>
                                </div>
                                <div class='form-group col-md-6' style='margin-bottom:5px'>
                                <input type='email' name='email' class='form-control form-mini' placeholder='- - - - - - @mail.com' autocomplete='off' required>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class='form-group row'>
                        <label class='col-sm-2 col-form-label' style='margin-bottom:1px; font-weight:bold'>Alamat Kirim</label>
                        <div class='col-sm-10'>
                            <div class='form-row'>
                                <div class='form-group col-md-4' style='margin-bottom:5px'>
                                    <select class='form-control form-mini' name='provinsi' id='list_provinsi' required></select>
                                </div>
                                <div class='form-group col-md-4' style='margin-bottom:5px'>
                                    <select class='form-control form-mini' name='kota' id='list_kotakab' required></select>
                                </div>
                                <div class='form-group col-md-4' style='margin-bottom:5px'>
                                    <select class='form-control form-mini' name='kecamatan' id='list_kecamatan' required></select>
                                </div>
                            </div>
                            <input type='text' name='alamat' class='form-control form-mini' placeholder='Nama Jalan, No Rumah/Kantor anda..' autocomplete='off' required>
                        </div>
                        </div>
                  
                        <div style='padding:5px; font-size:16px; font-weight:bold; background:#f4f4f4; border-bottom:1px solid #ab0534; margin-bottom:10px;'>Data Produk</div>";
                
                        $i = 1;
                        $noo = 1;
                        $penjualx = $this->db->query("SELECT a.*, e.nama_reseller, e.kordinat, e.alamat_lengkap, e.keterangan, e.kecamatan_id, e.kota_id, e.pilihan_kurir, b.id_reseller, c.nama_kota, d.nama_provinsi
                                      FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk 
                                      JOIN rb_reseller e ON b.id_reseller=e.id_reseller
                                      JOIN rb_kota c ON e.kota_id=c.kota_id 
                                      JOIN rb_provinsi d ON c.provinsi_id=d.provinsi_id where a.session='".$this->session->idp."' AND a.checked='Y' GROUP BY e.id_reseller");
                        foreach ($penjualx->result_array() as $rowx) {
                          $ber = $this->db->query("SELECT sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."' AND b.id_reseller='$rowx[id_reseller]' AND a.checked='Y'")->row_array();
                          $kota_asal[] = $rowx['kota_id'];
                          $berat[] = $ber['total_berat'];
                          echo "<div class='toko-list'>
                                    <div class='toko-name'>".cek_paket_icon($rowx['id_reseller'])." <b>$rowx[nama_reseller]</b> <br>
                                        <input type='hidden' name='toko$noo' value='$rowx[id_reseller]'>
                                        <input type='hidden' id='lokasi_penjual$noo' value='$rowx[kordinat]'>
                                          <span class='fa fa-map-marker' style='font-size:16px; color:transparent'></span> <span style='color:green'>Dikirim dari  ".reseller_kota($rowx['id_reseller'])."</span>
                                    </div>
                                    
                                    <div class='row'>
                                    <div class='col-md-7 col-12'>";
                                    $drecord = $this->db->query("SELECT a.*, b.*, c.nama_reseller FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller where b.id_reseller='$rowx[id_reseller]' AND a.session='".$this->session->idp."' AND a.checked='Y' ORDER BY id_penjualan_detail ASC");
                                    foreach ($drecord->result_array() as $row) {
                                      $ex = explode(';', $row['gambar']);
                                      if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                                      $re = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$row['id_reseller']))->row_array();
                                      $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
                                      $ex = explode(';', $row['gambar']);
                                      if ($row['pre_order']!='' AND $row['pre_order']>0){
                                        $pre_order = "<span class='badge badge-secondary'>Pre-Order $row[pre_order] Hari</span>";
                                      }else{
                                        $pre_order = "";
                                      }
                                      echo "<div class='ps-product--cart-mobile' style='padding:5px 0'>
                                              <input type='hidden' name='id$no' value='$row[id_penjualan_detail]'> 
                                              <div class='ps-product__thumbnail'>
                                                <img style='float:left; width:100px; margin-right:10px' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'>
                                              </div>
                                              <div class='ps-product__content'>
                                                $pre_order <a href='".base_url()."produk/detail/$row[produk_seo]'>
                                                  <span style='font-size:15px; display:block; font-weight:400'>$row[nama_produk]</span>
                                                </a>
                                                <p style='border-bottom:1px dotted #cecece; margin-bottom:0px'>
                                                <small>$row[jumlah] Barang ($row[berat] gram), <b>Rp ".rupiah($row['harga_jual']-$row['diskon'])."</b><br></small></p>";
                                                  if ($row['keterangan_order']!='' OR trim($row['catatan'])!=''){
                                                    echo "<div style='border:1px dashed green; padding:2px 5px'>";
                                                    if ($row['keterangan_order']!=''){
                                                      echo "<span style='color:orange'>Variasi</span> <i style='color:#8a8a8a'>: $row[keterangan_order]</i><br>";
                                                    }
                                                    if (trim($row['catatan'])!=''){
                                                      echo "<span style='color:orange'>Catatan</span> <i style='color:#8a8a8a'>: $row[catatan]</i>";
                                                    }
                                                    echo "</div>";
                                                  }
                                                echo "</div>
                                            </div>";
                                      $i++;
                                    }
                          echo "</div>

                          <div class='col-md-5 col-12'>";
                            $cekk = $this->db->query("SELECT jenis_produk FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."' GROUP BY b.jenis_produk")->row_array();
                            if ($cekk['jenis_produk']=='Fisik'){
                              // Ongkir dan Kurir jika produk fisik
                                echo "<p style='font-size:1.6rem; font-weight:600; margin-bottom:0px'><i class='fa fa-car'></i> Pilih Pengiriman</p>
                                <input type='hidden' id='list_kecamatan_dari$noo' value='$rowx[kecamatan_id]'>
                                <select class='form-control form-mini text-success' name='kode_kurir$noo' id='list_kurir$noo' style='margin-bottom: 2px;background: #28a745; border-radius: 5px; color: #fff !important;'>
                                    <option value='0'>- Pilih Kurir -</option>";
                                    $kurir_data = $this->model_app->view_ordering('rb_kurir','id_kurir','ASC');
                                    if ($rowx['pilihan_kurir']==''){
                                      foreach ($kurir_data as $rowk) {
                                        echo "<option value='$rowk[kode_kurir]'>$rowk[nama_kurir]</option>";
                                      }
                                    }else{
                                      $kurir_terpilih = explode(',',$rowx['pilihan_kurir']);
                                      foreach ($kurir_data as $rowk) {
                                        foreach ($kurir_terpilih as $select_option){
                                          if($rowk['id_kurir'] == $select_option) {
                                            echo "<option value='$rowk[kode_kurir]'>$rowk[nama_kurir]</option>";
                                            break;
                                          }
                                        }
                                      }
                                    }

                                echo "</select>
                                <label style='display:block; cursor:pointer; margin-bottom:0rem'>
                                      <input type='checkbox' name='kurir' class='kurir$noo' value='cod'/> <span style='display:inline-block'>COD dengan Kurir Toko</span>
                                    </label>
                                <ul class='list-group list-group-flush'>
                                    <div id='list_kurir_div$noo'></div>
                                    <div id='loader$noo' style='display:none'>
                                      <center><img src='".base_url()."asset/images/loading.gif'></center>
                                    </div>
                                </ul>

                                <ul class='list-group list-group-flush' id='kurir-list$noo'>";
                                    if ($this->session->id_konsumen==''){
                                      $cod = $this->db->query("SELECT * FROM rb_reseller_cod where id_reseller='$rowx[id_reseller]'");
                                    }else{
                                      $ress = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
                                      $cod = $this->db->query("SELECT * FROM rb_reseller_cod where id_reseller='$rowx[id_reseller]'");
                                    }
                                    $service = 1;
                                    foreach ($cod->result_array() as $ros) {
                                      echo '<li id="'.$noo.$idn.'serv-'.$service.'" class="list-group-item clearall-kurir" style="cursor:pointer; margin:1px; padding-bottom: 5px; padding:5px 1.25rem; line-height: 1; border: 1px solid #e3e3e3; border-left: 3px solid red;" onclick="klikongkir'.$noo.'(\'COD (Cash on delivery)\',\''.$ros['nama_alamat'].'\',\''.$ros['biaya_cod'].'\',\''.number_format($ros['biaya_cod'],0).'\',this.id)">
                                                <span style="color:black;">COD - '.$ros['nama_alamat'].'</span><br><small><b>Tarif.</b> <b style="color:red">Rp '.number_format($ros['biaya_cod'],0).'</b> - Bayar Di tempat</small>
                                          </li>';
                                      $service++;
                                    }
            
                                    if ($cod->num_rows()<=0){
                                      echo "<center style='color:red'>COD Tidak Tersedia!</center>";
                                    }
            
                                echo "</ul>";
                            }else{
                              
                            }
                          echo "</div>

                          </div>
                          </div>";
                          $noo++;       
                        }
                ?>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-block--shopping-total">
                        <div class="ps-block__content">
                            <div class="ps-block__header">
                            <?php if ($cekk['jenis_produk']=='Fisik'){ ?>
                                <p style='margin-bottom:0px'>Berat<span> <?php echo "$total[total_berat] Gram"; ?></span></p>
                                <p style='margin-bottom:0px'>Ongkos Kirim <span> <input type='text' id='ongkir_view' style='background:none; text-align:right; width:110px' value='0' disabled/></span></p>
                                <?php 
                                }
                                
                                  $ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
                                  $fv = explode('|',$ref['keterangan']);
                                  if ($fv[0]>'0'){
                                    $fee_admin = $fv[0];
                                    echo "<p style='margin-bottom:0px'>Fee Admin <span>Rp ".rupiah($fv[0])."</span></p>";
                                  }else{
                                    $fee_admin = 0;
                                  }
                                ?>
                                <p>Subtotal <span> <?php echo "Rp ".rupiah($total['total']-$total['diskon_total']); ?></span></p>
                                <div class="form-group--nest" style='margin-top:10px'>
                                    <input class="form-control" name='kode_kupon' id='kode_kupon' type="text" placeholder="Kode Kupon / Voucher">
                                    <button type='button' id='submit_kupon' class="ps-btn"><span class='fa fa-check'></span></button>
                                </div>
                                <div class='kupon_list'></div>
                                <div class='kupon_list_pusat'></div>
                            </div>
                            <h3>Total <span id='totalbayar'></span></h3>
                        </div>
                    </div>
                    <?php if ($cekk['jenis_produk']=='Fisik'){ ?>
                        <button type='submit' name='submit' id='oksimpan' style='display: none' class="ps-btn ps-btn--fullwidth">Proses Pembayaran</a>
                        <button type='button' id='oksimpanx' style='background:#e3e3e3; color:#000 !important; border:1px solid #000' class="ps-btn ps-btn--fullwidth oksimpanx">Proses Pembayaran</a>
                    <?php }else{ ?>
                        <button type='submit' name='submit' id='oksimpan_digital' style='display: block' class="ps-btn ps-btn--fullwidth">Proses Pembayaran</a>
                    <?php } ?>
                </div>
                </div>
                <?php 
                  echo "<input type='hidden' id='fee_admin' value='$fee_admin'/>
                  <input type='hidden' id='kupon' value='".($kupon_pusat['diskon']==''?0:$kupon_pusat['diskon'])."'/>
                  <input type='hidden' name='totalx' id='totalx' value='".($total['total']+$fee_admin)."'/>
                        <input type='hidden' name='total' id='total' value='$total[total]'/>
                        <input type='hidden' name='ongkir' id='ongkir' style='color:red' value=''/>
                        <input type='hidden' name='berat' value='$total[total_berat]'/>
                        <input type='hidden' name='diskonnilai' id='diskonnilai' value='$diskon_total'/>
                        <input type='hidden' name='ongkir1' id='ongkir1' value='0'/>
                        <input type='hidden' name='service1' id='service1'/>
                        <input type='hidden' name='kurir1' id='kurir1'/>
                        <input type='hidden' name='ongkir2' id='ongkir2' value='0'/>
                        <input type='hidden' name='service2' id='service2'/>
                        <input type='hidden' name='kurir2' id='kurir2'/>
                        <input type='hidden' name='ongkir3' id='ongkir3' value='0'/>
                        <input type='hidden' name='service3' id='service3'/>
                        <input type='hidden' name='kurir3' id='kurir3'/>
                        <div class='kota'></div>";
                ?>
                </form>
            </div>
        </div>
        <hr>
    </div>
</div>


<script>
/*$(document).ready(function(){
    $("#submit").on("click", function(){
    var a = parseInt($('#a').val());
    var b = parseInt($('#b').val());
        var sum = a + b;
        $("#ongkir").val(sum);
    })
})*/
$("#form_alamat").hide();

$("#kurir-list1").hide();
$(".kurir1").change(function(){
    $("#kurir-list1").toggle();
});

$("#kurir-list2").hide();
$(".kurir2").change(function(){
    $("#kurir-list2").toggle();
});

$("#kurir-list3").hide();
$(".kurir3").change(function(){
    $("#kurir-list3").toggle();
});

function klikongkir1(data,detail,harga,harga_rp,id){
  $("#ongkir1").val(harga);
  $(".clearall-kurir").removeClass("selected-ongkir1");
  $('#'+id).addClass("selected-ongkir1");
  $('#service1').val(detail);
  $('#kurir1').val(data);
  var val1 = +$("#ongkir1").val();
  var val2 = +$("#ongkir2").val();
  var val3 = +$("#ongkir3").val();
  $("#ongkir").val(val1+val2+val3);
  $("#ongkir_view").val(toDuit(val1+val2+val3));
  $("#oksimpan").show();
  $("#oksimpanx").hide();
  hitung();
}

function klikongkir2(data,detail,harga,harga_rp,id){
  $("#ongkir2").val(harga);
  $(".clearall-kurir").removeClass("selected-ongkir2");
  $('#'+id).addClass("selected-ongkir2");
  $('#service2').val(detail);
  $('#kurir2').val(data);
  var val1 = +$("#ongkir1").val();
  var val2 = +$("#ongkir2").val();
  var val3 = +$("#ongkir3").val();
  $("#ongkir").val(val1+val2+val3);
  $("#ongkir_view").val(toDuit(val1+val2+val3));
  $("#oksimpan").show();
  $("#oksimpanx").hide();
  hitung();
}

function klikongkir3(data,detail,harga,harga_rp,id){
  $("#ongkir3").val(harga);
  $(".clearall-kurir").removeClass("selected-ongkir3");
  $('#'+id).addClass("selected-ongkir3");
  $('#service3').val(detail);
  $('#kurir3').val(data);
  var val1 = +$("#ongkir1").val();
  var val2 = +$("#ongkir2").val();
  var val3 = +$("#ongkir3").val();
  $("#ongkir").val(val1+val2+val3);
  $("#ongkir_view").val(toDuit(val1+val2+val3));
  $("#oksimpan").show();
  $("#oksimpanx").hide();
  hitung();
}

$(document).ready(function(){
$('#oksimpanx').click(function(){
    $('#Modal_Notif').modal('show');
    if ($('#ongkir').val()==''){
    $('#error_notif').html("Maaf, Anda Belum memilih Kurir untuk Pengiriman!");
    }else{
    $('#error_notif').html("Ada yang belum sesuai nih, Betulkan dulu ya!");
    }
});


show_kupon_list();
  show_kupon_pusat();
  function show_kupon_list(){
      $.ajax({
          url   : '<?php echo site_url("members/kupon_list"); ?>',
          type  : 'GET',
          async : true,
          dataType : 'json',
          success : function(data){
              var html = '';
              var i;
              for(i=0; i<data.length; i++){
                  html += '<p style="margin-bottom:0px">'+
                          '<a href="javascript:void(0);" class="ps-product__remove kupon_delete" style="cursor:pointer" data-id_penjualan_detail="'+data[i].id_penjualan_detail+'"><i style="color:red" class="fa fa-remove"></i></a> '+
                          '<b style="color:green">'+data[i].kode_kupon+'</b>'+
                          '<span>Rp -'+toRupiah(data[i].nilai_kupon)+'</span></p>';
              }
              $('.kupon_list').html(html);
          }
      });
  } 

  function show_kupon_pusat(){
      $.ajax({
          url   : '<?php echo site_url("members/kupon_list_pusat"); ?>',
          type  : 'GET',
          async : true,
          dataType : 'json',
          success : function(data){
              var html = '';
              var i;
              for(i=0; i<data.length; i++){
                  html += '<p style="margin-bottom:0px">'+
                          '<a href="javascript:void(0);" class="ps-product__remove kupon_deletex" style="cursor:pointer" data-id_penjualan_detail="'+data[i].id_penjualan_detail+'"><i style="color:red" class="fa fa-remove"></i></a> '+
                          '<b style="color:green">'+data[i].keterangan+'</b>'+
                          '<span>Rp -'+toRupiah(data[i].nilai_kupon)+'</span></p>';
              }
              $('.kupon_list_pusat').html(html);
          }
      });
  } 

  function sum_kupon_list(){
      $.ajax({
          url   : '<?php echo site_url("members/kupon_list_sum"); ?>',
          type  : 'GET',
          async : true,
          dataType : 'json',
          success : function(data){
              var i;
              for(i=0; i<data.length; i++){
                tot = $('#totalx').val();
                hasil = tot-data[i].total_nilai_kupon;
                $('#total').val(hasil);
              }
              hitung();
          }
      });
  } 

  function sum_kupon_pusat(){
      $.ajax({
          url   : '<?php echo site_url("members/kupon_list_sum_pusat"); ?>',
          type  : 'GET',
          async : true,
          dataType : 'json',
          success : function(data){
              $('#kupon').val(data.total_nilai_kupon);
              hitung();
          }
      });
  } 

  $('#submit_kupon').on('click',function(){
    var kode_kupon = $('#kode_kupon').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('members/kupon_used')?>",
        dataType : "JSON",
        data : {kode_kupon:kode_kupon},
        success: function(data){
          if(data==true){
            $('[name="kode_kupon"]').val("");
            show_kupon_list();
            sum_kupon_list();
            hitung();
          }else{
            if (data.pesan=='x'){
                $('[name="kode_kupon"]').val("");
                $('#kupon').val(data.nominal);
                show_kupon_pusat();
                hitung();
            }else{
              $('#Modal_Notif').modal('show');
              $('#error_notif').html(data.pesan);
              // alert(data.pesan);
            }
          }
          //console.log(data);
        }
    });
    return false;
  });

  $('#submitKupon').on('click',function(){
    var kode_kupon = $("input[type=radio][name=promo]:checked").val();
    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('members/kupon_used')?>",
        dataType : "JSON",
        data : {kode_kupon:kode_kupon},
        success: function(data){
          if(data==true){
            $('[name="kodeKupon"]').val("");
            $('#promo').modal('hide');
            show_kupon_list();
            sum_kupon_list();
            hitung();
          }else{
            if (data.pesan=='x'){
                $('[name="kodeKupon"]').val("");
                $('#promo').modal('hide');
                $('#kupon').val(data.nominal);
                show_kupon_pusat();
                hitung();
            }else{
              $('#Modal_Notif').modal('show');
              $('#error_notif').html(data.pesan);
              // alert(data.pesan);
            }
          }
          //console.log(data);
        }
    });
    return false;
  });

  $('.kupon_list').on('click','.kupon_delete',function(){
    var id = $(this).data('id_penjualan_detail');
      $.ajax({
          type : "POST",
          url  : "<?php echo site_url('members/kupon_cart_delete')?>",
          dataType : "JSON",
          data : {id:id},
          success: function(data){
            show_kupon_list();  
            sum_kupon_list();
            hitung();
          }
      });
      return false;
  });

  $('.kupon_list_pusat').on('click','.kupon_deletex',function(){
    var id = $(this).data('id_penjualan_detail');
      $.ajax({
          type : "POST",
          url  : "<?php echo site_url('members/kupon_cart_deletex')?>",
          dataType : "JSON",
          data : {id:id},
          success: function(data){
            show_kupon_pusat();
            $('#kupon').val('0');
            hitung();
          }
      });
      return false;
  });

//* select Provinsi */
var base_url    = "<?php echo base_url();?>";
$.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_provinsi',
    data: {},
    dataType  : 'html',
    success: function (data) {
        $("#list_provinsi").html(data);
    }
});
/* select Provinsi */

$("#list_provinsi").change(function(){
    var id_province = this.value;
    kota(id_province);
    $("#div_kota").show();
});

/* select Kota */
kota = function(id_province){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_kota',
    data: {id_province:id_province},
    dataType  : 'html',
    success: function (data) {
        $("#list_kotakab").html(data);
    },
    beforeSend: function () {
        
    },
    complete: function () {
      
    }
});
}

$("#list_kotakab").change(function(){
    var id_kota = this.value;
    kecamatan(id_kota);
    $("#div_kecamatan").show();
});

kecamatan = function(id_kota){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_kecamatan',
    data: {id_kota:id_kota},
    dataType  : 'html',
    success: function (data) {
        $("#list_kecamatan").html(data);
    }
});
}

$("#list_kurir1").change(function(){
    var id_kurir     = this.value;
    var id_kecamatan      = $("#list_kecamatan").val();
    cost1(id_kurir,id_kecamatan);
    $("#div_kurir1").show();
});

cost1 = function(id_kurir,id_kecamatan){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_cost/1/<?php echo $kota_asal[0]; ?>/<?php echo $berat[0]; ?>',
    data: {kurir_pengiriman:id_kurir,kecamatan_tujuan:id_kecamatan},
    dataType  : 'html',
    beforeSend: function(){
        $("#loader1").show();
        $("#list_kurir_div1").hide();
    },
    success: function (data) {
        $("#list_kurir_div1").html(data);
    },
    complete:function(response){
        // Hide image container
        $("#loader1").hide();
        $("#list_kurir_div1").show();
    }
});
}

$("#list_kurir2").change(function(){
    var id_kurir     = this.value;
    var id_kecamatan      = $("#list_kecamatan").val();
    cost2(id_kurir,id_kecamatan);
    $("#div_kurir2").show();
});

cost2 = function(id_kurir,id_kecamatan){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_cost/2/<?php echo $kota_asal[1]; ?>/<?php echo $berat[1]; ?>',
    data: {kurir_pengiriman:id_kurir,kecamatan_tujuan:id_kecamatan},
    dataType  : 'html',
    beforeSend: function(){
        $("#loader2").show();
        $("#list_kurir_div2").hide();
    },
    success: function (data) {
        $("#list_kurir_div2").html(data);
    },
    complete:function(response){
        // Hide image container
        $("#loader2").hide();
        $("#list_kurir_div2").show();
    }
});
}

$("#list_kurir3").change(function(){
    var id_kurir     = this.value;
    var id_kecamatan      = $("#list_kecamatan").val();
    cost3(id_kurir,id_kecamatan);
    $("#div_kurir3").show();
});

cost3 = function(id_kurir,id_kecamatan){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_cost/3/<?php echo $kota_asal[2]; ?>/<?php echo $berat[2]; ?>',
    data: {kurir_pengiriman:id_kurir,kecamatan_tujuan:id_kecamatan},
    dataType  : 'html',
    beforeSend: function(){
        $("#loader3").show();
        $("#list_kurir_div3").hide();
    },
    success: function (data) {
        $("#list_kurir_div3").html(data);
    },
    complete:function(response){
        // Hide image container
        $("#loader3").hide();
        $("#list_kurir_div3").show();
    }
});
}

$(".alamat").click(function(){
    $("#form_alamat").toggle();
});

$("#diskon").html(toDuit(0));
hitung();
});

function hitung(){
    var diskon=$('#diskonnilai').val();
    var total=$('#total').val();
    var ongkirx=$("#ongkir").val();
    var fee_admin=$("#fee_admin").val();
    var kupon_pusat = parseFloat($('#kupon').val());
    if (kupon_pusat>parseInt(ongkirx)){
      ongkir = 0;
    }else{
      ongkir = parseInt(ongkirx)-kupon_pusat;
    }

    if(parseFloat(ongkir) >= 0){
        $("#oksimpan").show();
    }else{
        $("#oksimpan").hide();
    }

    ongkir = ongkir || 0;
    var bayar=(parseFloat(total)+parseFloat(ongkir)+parseFloat(fee_admin));
    $("#totalbayar").html(toDuit(bayar));
}
</script>