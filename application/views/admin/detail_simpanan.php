  <style>
      .center {
          text-align: center;
      }
  </style>
  <div class="main-panel">
      <div class="content">
          <div class="page-inner">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex align-items-center">
                              <h4 class="card-title"><?= $title ?></h4>
                              <a href="<?= base_url('admin/simpanan') ?>" class="btn btn-primary btn-round ml-auto">
                                  <i class="fas fa-arrow-alt-circle-left"></i>
                                  Kembali
                              </a>
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>NO</th>
                                          <th>NIK</th>
                                          <th>JUMLAH</th>
                                          <th>Metode Pembayaran</th>
                                          <th>No Virtual</th>
                                          <th>Status</th>
                                          <th>TANGGAL</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($det_simpanan as $a) { ?>
                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->nik ?></td>
                                              <td><?= rupiah($a->jumlah) ?></td>
                                              <td><?= $a->metode_pembayaran ?></td>
                                              <td><?= $a->no_virtual ?></td>
                                              <td><?php if ($a->status == 100) { ?>
                                                      <button type="button" class="btn btn-danger" style="font-size: 10px;">PENDING</button>
                                                  <?php } elseif ($a->status == 200) { ?>
                                                      <button type="button" class="btn btn-success" style="font-size: 10px;">SUKSES</button>
                                                  <?php } ?>
                                              </td>
                                              <td><?= $a->tanggal_bayar ?></td>
                                              <td>
                                                  <div class="form-button-action">
                                                      <a href="<?= base_url('admin/cetak_persimpanan/' . $a->id) ?>" class="btn btn-link btn-primary btn-lg"><i class="fa fa-print"></i></a>
                                                      <button data-target="#edit-apk<?= $a->id ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </button>
                                                      <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
                                              </td>
                                          </tr>
                                          <div class="modal fade" id="edit-apk<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header no-bd">
                                                          <h5 class="modal-title">
                                                              <span class="fw-mediumbold">
                                                                  Detail </span>
                                                              <span class="fw-light">
                                                                  Simpanan
                                                              </span>
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">

                                                          <form action="<?= base_url('admin/update_simpanan'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="row">
                                                                  <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                  <input hidden type="text" class="form-control" id="nik" name="nik" placeholder="nik" value="<?= $a->nik ?>">
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Jumlah</label>
                                                                          <input type="text" class="form-control jml" id="jumlah" name="jumlah" placeholder="jumlah" value="<?= $a->jumlah ?>">
                                                                          <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer no-bd">
                                                                  <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                                                      <div class="modal-footer">
                                                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                          <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <?php } ?>
                                  </tbody>
                              </table>
                              <div class="box-header">
                                  <button class="btn btn-success"><b>Total Simpanan Wajib Anda : <?php echo (rupiah($jml['jumlah'], 2, ',', '.')) ?></b></button>
                                  <h3 class="label label-success"> </h3>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
      function deleteConfirm(url) {
          $('#btn-delete').attr('href', url);
          $('#deleteModal').modal();
      }
  </script>

  <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>