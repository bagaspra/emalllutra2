<script language="JavaScript" type="text/JavaScript">
  function showSub(){
    <?php
    $query = $this->db->query("SELECT * FROM rb_kategori_produk");
    foreach ($query->result_array() as $data) {
       $id_kategori_produk = $data['id_kategori_produk'];
       echo "if (document.demo.a.value == \"".$id_kategori_produk."\")";
       echo "{";
       $query_sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$id_kategori_produk' AND id_parent='0'");
       $content = "document.getElementById('sub_kategori_produk').innerHTML = \"  <option value=''>- Pilih Sub Kategori Produk -</option>";
       $content .= main_menuxxxx($id_kategori_produk);
      //  foreach ($query_sub_kategori->result_array() as $data2) {
      //     $content .= "<option value='".$data2['id_kategori_produk_sub']."'>".$data2['nama_kategori_sub']."</option>";
      //  }
       $content .= "\"";
       echo $content;
       echo "}\n";
    }
    ?>
    }
</script>
<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
      <div class="ps-section__content">
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
          $attributes = array('class'=>'biodata','role'=>'form','name'=>'demo');
          echo form_open_multipart('members/tambah_produk',$attributes); 
        ?>
        <div class="row">
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 "><br>
        <?php 
          echo "<input type='hidden' name='id' value=''>
              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Kategori</b></label>
                  <div class='col-sm-9'>
                  <select name='a' class='form-control form-mini' onchange=\"showSub()\" required>
                    <option value='' selected>- Pilih Kategori Produk -</option>";
                    foreach ($record as $row){
                        echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                    }
                  echo "</select>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Sub-Kategori</b></label>
                  <div class='col-sm-9'>
                    <select name='aa' class='form-control form-mini' id='sub_kategori_produk'>
                    <option value='' selected>- Pilih Sub Kategori -</option>
                    </select>
                  </div>
              </div>
              

              <div class=''></div>

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Nama Produk</b></label>
                <div class='col-sm-9'>
                <input type='text' class='form-control form-mini' name='b' required>
                </div>
              </div>    
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'></b></label>
                <div class='col-sm-9'>
                  <div class='form-row'>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Satuan</label>
                      <input type='text' list='satuan' class='form-control form-mini' name='c' placeholder='-' autocomplete='off'>
                      <datalist id='satuan'>
                        <option value='Pcs'>
                        <option value='Unit'>
                        <option value='Buah'>
                        <option value='Pasang'>
                        <option value='Bungkus'>
                        <option value='Botol'>
                        <option value='Butir'>
                        <option value='Roll'>
                        <option value='Dus'>
                        <option value='Kaleng'>
                        <option value='Set'>
                      </datalist>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Berat /g</label>
                      <input type='number' class='form-control form-mini' name='berat' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Stok Awal</label>
                      <input type='number' class='form-control form-mini' name='stok' placeholder='' value='1'> 
                    </div>
                  </div>
                </div>
              </div>  

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'></b></label>
                <div class='col-sm-9'>
                  <div class='form-row'>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Harga Jual</label>
                      <div class='input-group'>
                      <div class='input-group-prepend'>
                        <div class='input-group-text'>Rp</div>
                      </div>
                      <input type='text' class='form-control form-mini formatNumber' name='f' placeholder='-' required>
                      </div>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Diskon</label>
                      <div class='input-group'>
                      <div class='input-group-prepend'>
                        <div class='input-group-text'>Rp</div>
                      </div>
                      <input type='text' class='form-control form-mini formatNumber' name='diskon' placeholder='-'> 
                      </div>
                    </div>
                  </div>
                </div>
              </div> 

              

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Min. Order</b></label>
                  <div class='col-sm-9'>
                  <input type='number' class='form-control form-mini' name='minimum' placeholder='' value='1'> 
                  </div>
              </div>

              <input type='hidden' class='form-control form-mini' name='e'>
              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Cuplikan</b></label>
                  <div class='col-sm-9'>
                  <textarea class='form-control' name='fff' style='height:120px'></textarea>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                  <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Keterangan</b></label>
                    <div class='col-sm-9'>
                    <textarea id='editor1' class='form-control' name='ff' style='height:180px'>$rows[keterangan]</textarea>
                    </div>
              </div>
              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Gambar</b></label>
                  <div class='col-sm-9'>
                  <div id='mulitplefileuploader' class='mt-2'>Choose files</div>
                  <div id='status'></div>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Jenis Produk</b></label>
                  <div class='col-sm-9'>
                  <select name='jenis_produk' id='jenis_produk' class='form-control form-mini'>";
                  $preorder = array('Fisik','Digital');
                  for ($i=0; $i < count($preorder) ; $i++) { 
                    echo "<option value='".$preorder[$i]."'>".$preorder[$i]."</option>";
                  }
                  echo "</select>
                  <div class='jenis_produk_file' style='display:none; margin-top:5px;'>
                    <div id='mulitplefileuploaderx' class='mt-2'>Choose files</div>
                    <div id='statusx'></div>
                  </div>
                  </div>
              </div>
              <br>
              
            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
            <div class='box-footer'>
                <button type='submit' name='submit' class='ps-btn margin-btn spinnerButton'>Tambahkan</button>
                <button type='button' onclick=\"history.back()\" class='ps-btn ps-btn--black margin-btn'>Cancel</button>
              </div>
            </div>
            </div>
            </div>";
            echo form_close();
        echo "</div>
    </div>";
?>
<script>
(function ($) {
  $(document).ready(function(){
    // Options search field
    $('#search').keyup(function(){
        var valThis = $(this).val().toLowerCase();
        $('input[type=checkbox]').each(function(){
            var text = $("label[for='"+$(this).attr('id')+"']").text().toLowerCase();
            (text.indexOf(valThis) == 0) ? $(this).parent().show() : $(this).parent().hide();
        });
    });
    // Search clear button
    $("#search-clear").click(function(){
      $("#search").val("");
      $('input[type=checkbox]').each(function(){
        $(this).parent().show();
      });
    });
  });
})(jQuery);   

$(document).ready(function(){
var Privileges = jQuery('#pre_order_status');
Privileges.change(function () {
    if ($(this).val() == 'Ya') {
      $("#pre_order_status").attr("style", "width:40%; display:inline-block");
      $(".lama_pre_order").attr("style", "display:inline");
      $("input[name='pre_order']").prop('required',true);
    }else{
      $("#pre_order_status").removeAttr("style");
      $(".lama_pre_order").attr("style", "display:none");
      $("input[name='pre_order']").removeAttr('required');
    }
});

var jenisProduk = jQuery('#jenis_produk');
jenisProduk.change(function () {
    if ($(this).val() == 'Digital') {
      $(".jenis_produk_file").attr("style", "display:block; margin-top:5px;");
      $("input[name='jenis_produk_file']").prop('required',true);
    }else{
      $(".jenis_produk_file").attr("style", "display:none");
      $("input[name='jenis_produk_file']").removeAttr('required');
    }
});

var settings = {
    url: "<?php echo base_url().$this->uri->segment(1); ?>/upload",
    formData: {id: "<?php echo $this->session->id_konsumen; ?>"},
    dragDrop: true,
    
	  maxFileCount:10,
    fileName: "uploadFile",
	  maxFileSize:5000*1024,
    allowedTypes:"jpg,png,jpeg,gif",		
    returnType:"json",
	onSuccess:function(files,data,xhr)
    {
       // alert((data));
    },
    showDone:false,
    showDelete:true,
    deleteCallback: function(data,pd) {
        $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFile",{op: "delete", name:data},
            function(resp, textStatus, jqXHR) {
                // $("#status").append("<div>File Deleted</div>");   
            });
        for(var i=0;i<data.length;i++) {
            $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFile",{op:"delete",name:data[i]},
            function(resp, textStatus, jqXHR) {
                // $("#status").append("<div>File Deleted</div>");  
            });
        }   
        pd.statusbar.hide();
    }   
}
$("#mulitplefileuploader").uploadFile(settings);
});

$(document).ready(function(){
var settingsx = {
    url: "<?php echo base_url().$this->uri->segment(1); ?>/uploadx",
    formData: {id: "<?php echo $this->session->id_konsumen; ?>x"},
    dragDrop: true,
    
	  maxFileCount:10,
    fileName: "uploadFile",
	  maxFileSize:50000*1024,
    allowedTypes:"zip,rar,tar",		
    returnType:"json",
	onSuccess:function(files,data,xhr)
    {
       // alert((data));
    },
    showDone:false,
    showDelete:true,
    deleteCallback: function(data,pd) {
        $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFilex",{op: "delete", name:data},
            function(resp, textStatus, jqXHR) {
                // $("#status").append("<div>File Deleted</div>");   
            });
        for(var i=0;i<data.length;i++) {
            $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFilex",{op:"delete",name:data[i]},
            function(resp, textStatus, jqXHR) {
                // $("#status").append("<div>File Deleted</div>");  
            });
        }   
        pd.statusbar.hide();
    }   
}
$("#mulitplefileuploaderx").uploadFile(settingsx);
});
</script>
<script>
var intTextBox = 2;
function addElement() {
    intTextBox++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox);
    objNewDiv.innerHTML = '<input style="width:58%; display:inline-block" placeholder="Input ' + intTextBox + ' ........." type="text" class="form-control form-mini" id="warna_' + intTextBox + '" name="warna[]"/> <input style="width:40%; display:inline-block" placeholder="+ Harga ' + intTextBox + ' ........." type="number" class="form-control form-mini" id="hargaa_' + intTextBox + '" name="hargaa[]"/>';
    document.getElementById('content').appendChild(objNewDiv);
}

function removeElement() {
    if(0 < intTextBox) {
        document.getElementById('content').removeChild(document.getElementById('div_' + intTextBox));
        intTextBox--;
    } else {
        alert("Tidak ditemukan textbox untuk dihapus.");
    }
}

var intTextBox1 = 2;
function addElement1() {
    intTextBox1++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div1_' + intTextBox1);
    objNewDiv.innerHTML = '<input style="width:58%; display:inline-block" placeholder="Input ' + intTextBox1 + ' ........."  type="text" class="form-control form-mini" id="ukuran_' + intTextBox1 + '" name="ukuran[]"/> <input style="width:40%; display:inline-block" placeholder="+ Harga ' + intTextBox + ' ........." type="number" class="form-control form-mini" id="hargab_' + intTextBox + '" name="hargab[]"/>';
    document.getElementById('content1').appendChild(objNewDiv);
}

function removeElement1() {
    if(0 < intTextBox1) {
        document.getElementById('content1').removeChild(document.getElementById('div1_' + intTextBox1));
        intTextBox1--;
    } else {
      alert("Tidak ditemukan textbox untuk dihapus.");
    }
}

var intTextBox2 = 2;
function addElement2() {
    intTextBox2++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div2_' + intTextBox2);
    objNewDiv.innerHTML = '<input style="width:58%; display:inline-block" placeholder="Input ' + intTextBox2 + ' ........."  type="text" class="form-control form-mini" id="lainnya_' + intTextBox2 + '" name="lainnya[]"/> <input style="width:40%; display:inline-block" placeholder="+ Harga ' + intTextBox + ' ........." type="number" class="form-control form-mini" id="hargac_' + intTextBox + '" name="hargac[]"/>';
    document.getElementById('content2').appendChild(objNewDiv);
}

function removeElement2() {
    if(0 < intTextBox2) {
        document.getElementById('content2').removeChild(document.getElementById('div2_' + intTextBox2));
        intTextBox2--;
    } else {
      alert("Tidak ditemukan textbox untuk dihapus.");
    }
}

var intTextBoxg = 1;
function addElementg() {
    intTextBoxg++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div3_' + intTextBoxg);
    objNewDiv.innerHTML = '<input style="width:39%; display:inline-block" placeholder="Jumlah ' + intTextBoxg + '"  type="number" class="form-control form-mini" id="jumlah_' + intTextBoxg + '" name="jumlah[]"/> <input style="width:58%; display:inline-block" placeholder="Harga Group ' + intTextBoxg + '"  type="number" class="form-control form-mini" id="harga_' + intTextBoxg + '" name="harga[]"/>';
    document.getElementById('group').appendChild(objNewDiv);
}

function removeElementg() {
    if(0 < intTextBoxg) {
        document.getElementById('group').removeChild(document.getElementById('div3_' + intTextBoxg));
        intTextBoxg--;
    } else {
      alert("Tidak ditemukan textbox untuk dihapus.");
    }
}
</script>
