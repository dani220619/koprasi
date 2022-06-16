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
                <!-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                  <i class="fa fa-plus"></i>
                  Add Row
                </button> -->
              </div>
            </div>
            <div class="card-body">
              <!-- Modal -->
              <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover">
                  <thead class="center">
                    <tr>
                      <th>ID</th>
                      <th>Nama Owner</th>
                      <th>Alamat</th>
                      <th>Telpon</th>
                      <th>Title</th>
                      <th>Nama Aplikasi</th>
                      <th>Logo</th>
                      <th>Copy Right</th>
                      <th>Versi</th>
                      <th>Tahun</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="center">
                    <?php
                    foreach ($apl as $a) { ?>

                      <tr>
                        <td><?= $a->id ?></td>
                        <td><?= $a->nama_owner ?></td>
                        <td><?= $a->alamat ?></td>
                        <td><?= $a->tlp ?></td>
                        <td><?= $a->title ?></td>
                        <td><?= $a->nama_aplikasi ?></td>
                        <td><?= $a->logo ?></td>
                        <td><?= $a->copy_right ?></td>
                        <td><?= $a->versi ?></td>
                        <td><?= $a->tahun ?></td>
                        <td>
                          <div class="form-button-action">
                            <button data-target="#edit-apk<?= $a->id ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                              <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" data-toggle="modal" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <div class="modal fade" id="edit-apk<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header no-bd">
                              <h5 class="modal-title">
                                <span class="fw-mediumbold">
                                  Edit</span>
                                <span class="fw-light">
                                  Aplikasi
                                </span>
                              </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <form action="<?php echo base_url() . 'aplikasi/update'; ?>" method="post" enctype="multipart/form-data">
                                <input id="id" name="id" value="<?= $a->id ?>" type="text" class="form-control" placeholder="fill name" hidden>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                      <label>Nama Owner</label>
                                      <input id="nama_owner" name="nama_owner" value="<?= $a->nama_owner ?>" type="text" class="form-control" placeholder="fill name">
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                      <label>Alamat</label>
                                      <input id="alamat" name="alamat" value="<?= $a->alamat ?>" type="text" class="form-control" placeholder="fill position">
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                      <label>Telpon</label>
                                      <input id="tlp" name="tlp" value="<?= $a->tlp ?>" type="text" class="form-control" placeholder="fill office">
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                      <label>Title</label>
                                      <input id="title" name="title" value="<?= $a->title ?>" type="text" class="form-control" placeholder="fill name">
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                      <label>Nama Aplikasi</label>
                                      <input id="nama_aplikasi" name="nama_aplikasi" value="<?= $a->nama_aplikasi ?>" type="text" class="form-control" placeholder="fill position">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                      <label>Logo</label>
                                      <input type="file" class="form-control" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                      <label>Copy Right</label>
                                      <input id="copy_right" name="copy_right" value="<?= $a->copy_right ?>" type="text" class="form-control" placeholder="fill name">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                      <label>Versi</label>
                                      <input id="versi" name="versi" value="<?= $a->versi ?>" type="text" class="form-control" placeholder="fill position">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                      <label>Tahun</label>
                                      <input id="tahun" name="tahun" value="<?= $a->tahun ?>" type="text" class="form-control" placeholder="fill office">
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
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#datatables').DataTable({});
    });
  </script>