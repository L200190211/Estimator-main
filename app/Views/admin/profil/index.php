<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img src="/assets/img/profil/<?= $profil['foto']; ?>" alt="Profile" class="rounded-circle">
          <h2><?= $profil['nama_pengguna']; ?></h2>
          <h3 class="text-center"><?= $profil['perusahaan']; ?></h3>
          <p class="small fst-italic text-center"><?= $profil['profil']; ?></p>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">
          <?php
              $session = session();?>
            <li class="nav-item ">
              <button class="nav-link <?= $session->getFlashdata('error') == '' ? 'active' : '' ?>" data-bs-toggle="tab" data-bs-target="#profile-overview">Profil</button>
            </li>

            <li class="nav-item">
              <button class="nav-link <?= $session->getFlashdata('error') != '' ? 'active' : '' ?>" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade <?= $session->getFlashdata('error') == '' ? 'active show' : '' ?> profile-overview" id="profile-overview">
              <?php
              if ($session->getFlashdata('erroremail')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <?= $session->getFlashdata('erroremail'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php endif; ?>
              <h5 class="card-title">Detail Profil</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Nama Pengguna</div>
                <div class="col-lg-9 col-md-8"><?= $profil['nama_pengguna']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Perusahaan</div>
                <div class="col-lg-9 col-md-8"><?= $profil['perusahaan']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Alamat</div>
                <div class="col-lg-9 col-md-8"><?= $profil['alamat']; ?></div>
              </div>
              
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Lokasi Kantor</div>
                <div class="col-lg-9 col-md-8"><?= $profil['wilayah']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?= $profil['email']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Whatsapp</div>
                <div class="col-lg-9 col-md-8"><?= $profil['no_wa']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">No. Telp</div>
                <div class="col-lg-9 col-md-8"><?= $profil['no_telp']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Website</div>
                <div class="col-lg-9 col-md-8"><?= $profil['website']; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Tag</div>
                <div class="col-lg-9 col-md-8">
                  <?php foreach ($tag as $itemtag) : ?>
                    <span class="badge rounded-pill bg-success"><?= $itemtag; ?></span>
                  <?php endforeach ?>
                </div>
              </div>

              <!-- Edit Profil Modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editprofilModal">
              <i class="ri-edit-line"></i> Edit Profil
              </button>

              <div class="modal fade" id="editprofilModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content px-2">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Profil</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <!-- Profile Edit Form -->
                      <form action="/profile/update/<?= $profil['id_pengguna']; ?>" method="POST" enctype="multipart/form-data" >
                        <?= csrf_field(); ?>
                        <input type="hidden" name="fotoLama" value="<?= $profil['foto']; ?>" >
                        <div class="row mb-3">
                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                            <div class="col-md-8 col-lg-9">
                              <img src="/assets/img/profil/<?= $profil['foto']; ?>" alt="Profile" id="img-preview" style="max-width: 450px ;">
                              <div class="pt-2 input-group">
                                <input type="file" class="form-control" id="foto" name="foto"  aria-describedby="inputGroupFileAddon04" aria-label="Upload" onchange="previewImg()">
                              </div>
                            </div>
                          </div>
                                            
                        <div class="row mb-3">
                          <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="nama_pengguna" type="text" class="form-control" id="nama" value="<?= $profil['nama_pengguna']; ?>" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="tentang" class="col-md-4 col-lg-3 col-form-label">Tentang</label>
                          <div class="col-md-8 col-lg-9">
                            <textarea name="profil" class="form-control" id="tentang" style="height: 150px" required><?= $profil['profil']; ?></textarea>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="perusahaan" class="col-md-4 col-lg-3 col-form-label">Perusahaan</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="perusahaan" type="text" class="form-control" id="perusahaan" value="<?= $profil['perusahaan']; ?>" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="alamat" type="text" class="form-control" id="alamat" value="<?= $profil['alamat']; ?>" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="lokasi_kantor" class="col-md-4 col-lg-3 col-form-label">Lokasi Kantor</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="selectpicker border" data-live-search="true" name="id_wilayah" data-width="100%" required>
                                <option value="<?= $profil['id_wilayah']; ?>" selected><?= $profil['wilayah']; ?></option>

                                <?php foreach ($wilayah as $item) : ?>
                                    <option value="<?= $item['id_wilayah']; ?>"><?= $item['wilayah']; ?></option>
                                <?php endforeach ?>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="email" type="email" class="form-control" id="Email" value="<?= $profil['email']; ?>" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="whatsapp" class="col-md-4 col-lg-3 col-form-label">Whatsapp</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="no_wa" type="text" class="form-control" id="whatsapp" value="<?= $profil['no_wa']; ?>" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="no_telp" class="col-md-4 col-lg-3 col-form-label">No. Telp</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="no_telp" type="text" class="form-control" id="no_telp" value="<?= $profil['no_telp']; ?>" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="website" class="col-md-4 col-lg-3 col-form-label">Website</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="website" type="text" class="form-control" id="website" value="<?= $profil['website']; ?>" required>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="tag" class="col-md-4 col-lg-3 col-form-label">Tag
                            
                          </label>
                          <div class="col-md-8 col-lg-9">
                            <input name="tags" type="text" class="form-control" id="tag" value="<?= $profil['tags']; ?>" required>
                            <span class="text-danger d-block">Pisah kan tag dengan tanda koma (contoh : lampu, led)</span>
                          </div>
                        </div>

                        <!-- <div class="text-center">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div> -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form><!-- End Profile Edit Form -->                      
                  </div>
                </div>
              </div>
              <!-- End Edit Profil Modal-->
            </div>

           <!-- Change Password Form -->
            <div class="tab-pane fade pt-3 <?= $session->getFlashdata('error') != '' ? 'active show' : '' ?>" id="profile-change-password">
              <?php
              if ($session->getFlashdata('error')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <?= $session->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php endif; ?>
              <form action="/profile/ganti/<?= $profil['id_pengguna']; ?>" method="POST">
               <?= csrf_field(); ?>
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword" minlength="8" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Ulangi Password Baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword" minlength="8" required  >
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary"><i class="ri-edit-line"></i> Ganti Password</button>
                </div>
              </form>
            </div>
           <!-- End Change Password Form -->

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>

<?php
$session = session();
?>
<?php if ($session->getFlashdata('pesan')) : ?>
    <script>
        swal({
            title: "Good job!",
            text: "<?= $session->getFlashdata('pesan'); ?>",
            icon: "success",
            button: "Oke!",
        });
    </script>
<?php endif; ?>

<?= $this->endSection(); ?>