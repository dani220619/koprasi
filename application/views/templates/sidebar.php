 <?php
    date_default_timezone_set("Asia/jakarta");
    ?>
 <div class="sidebar sidebar-style-2">
     <div class="sidebar-wrapper scrollbar scrollbar-inner">
         <div class="sidebar-content">
             <div class="user">
                 <div class="avatar-sm float-left mr-2">

                     <img src="<?php echo base_url(); ?>assets/foto/user/<?php echo $this->session->userdata['image']; ?>" alt="..." class="avatar-img rounded-circle">
                 </div>
                 <div class="info">
                     <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                         <span>
                             <?php echo $this->session->userdata['username']; ?>

                             <b>
                                 <div class="fas fa-clock"></div> <span id="jam" style="font-size:20px; color: black;"></span>
                             </b>



                         </span>
                     </a>


                 </div>
             </div>


             <ul class="nav nav-primary">
                 <?php if ($_SESSION["id_level"] == ("1")) { ?>
                     <li class="nav-item active">
                         <a href="<?= base_url('dashboard') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-home"></i>
                             <p>Dashboard</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#master">
                             <i class="fas fa-layer-group"></i>
                             <p>Master Data</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="master">
                             <ul class="nav nav-collapse">

                                 <li>
                                     <a href="<?= base_url('admin/anggota') ?>">
                                         <span class="sub-item">Anggota</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/pegawai') ?>">
                                         <span class="sub-item">Pegawai</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/user_data') ?>">
                                         <span class="sub-item">User</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#simpanan">
                             <i class="fas fa-save"></i>
                             <p>Keuangan</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="simpanan">
                             <ul class="nav nav-collapse">

                                 <li>
                                     <a href="<?= base_url('admin/simpanan') ?>">
                                         <span class="sub-item">Simpanan</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/pinjaman') ?>">
                                         <span class="sub-item">Pinjaman</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/list_angsuran') ?>">
                                         <span class="sub-item">Angsuran</span>
                                     </a>
                                 </li>

                             </ul>
                         </div>
                     </li>


                     <li class="nav-item">
                         <a data-toggle="collapse" href="#base">
                             <i class="fas fa-cogs"></i>
                             <p>System</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="base">
                             <ul class="nav nav-collapse">
                                 <li>
                                     <a href="<?= base_url('aplikasi/index') ?>">
                                         <span class="sub-item">Aplikasi</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/backup_data') ?>">
                                         <span class="sub-item">Backup Data</span>
                                     </a>
                                 </li>

                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url('login/logout') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-home"></i>
                             <p>Logout</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                 <?php } ?>
             </ul>
         </div>
     </div>
 </div>
 <script type="text/javascript">
     window.onload = function() {
         jam();
     }

     function jam() {
         var e = document.getElementById('jam'),
             d = new Date(),
             h, m, s;
         h = d.getHours();
         m = set(d.getMinutes());
         s = set(d.getSeconds());

         e.innerHTML = h + ':' + m + ':' + s;

         setTimeout('jam()', 1000);
     }

     function set(e) {
         e = e < 10 ? '0' + e : e;
         return e;
     }
 </script>