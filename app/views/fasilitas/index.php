<?php
$id_siswa = 0;
?>
<div class="content mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Data fasilitas</h4>
                        <p class="card-category">Selamat Datang</p>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <?php
                            $role = $_SESSION['role'];
                            if ($role == 1) {


                            ?>
                                <div class="row">
                                    <?php
                                    Flasher::Message();
                                    ?>
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahCustomer">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="col-lg-9">
                                        <form action="<?= base_url; ?>/datafasilitas/carifasilitas" method="POST">
                                            <div class="input-group mb-3 mt-2">
                                                <input type="text" class="form-control" name="key" placeholder="Cari fasilitas" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                                                <a href="<?= base_url; ?>/datafasilitas"><button class="btn btn-outline-secondary" type="button">Reset</button></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                            <div class="container">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Gambar</th>
                                            <?php if ($role == 1) { ?>
                                                <th scope="col">Aksi</th>

                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1; ?>
                                        <?php

                                        foreach ($data['data_fasilitas'] as $fasilitas) : ?>
                                            <form action="<?= base_url; ?>/fasilitaspaud/hapusfasilitas" method="POST">
                                                <input type="hidden" value="<?= $fasilitas['id_fasilitas']; ?>" name="id_fasilitas">
                                                <tr>
                                                    <th scope="row"><?= $i; ?></th>
                                                    <td><?php echo $fasilitas['nama_fasilitas'] ?></td>
                                                    <td><img src="<?= base_url; ?>/img/<?= $fasilitas['gambar_fasilitas']; ?>" alt="" style="width: 400px;  height: 400px    ;"></td>
                                                    <?php if ($role == 1) { ?>
                                                        <td>

                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                                <a href="<?= base_url; ?>/detailfasilitas/<?= $fasilitas['id_fasilitas']; ?>" class="btn btn-success"><span style="color: white" class="material-icons">
                                                                        remove_red_eye
                                                                    </span></a>

                                                                <button onclick="return confirm('Apakah anda yakin akan menghapus?')" type="submit" class="btn btn-danger"><span style="color: white" class="material-icons">
                                                                        delete
                                                                    </span></button>
                                                            </div>
                                                        </td>

                                                    <?php } ?>

                                                </tr>

                                            </form>
                                        <?php $i++;
                                        endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                            <hr class="mt-2">
                            <div class="d-flex justify-content-center">
                                <!-- {{ $data->links('vendor.pagination.simple-tailwind') }} -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah siswa -->
<div class="modal fade" id="tambahCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url; ?>/fasilitaspaud/tambah" method="POST" enctype="multipart/form-data">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nama Fasilitas</span>
                        <input required type="text" id="nama_fasilitas" name="nama_fasilitas" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Gambar</span>
                        <input required type="file" id="gambar_fasilitas" name="gambar_fasilitas" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>

        </div>
    </div>
</div>