<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php
            //memanggil koneksi
  				  include('library/koneksi.php');

            $kode = $_GET['kode'];
  				  $sql="SELECT pelanggan.nama_pelanggan FROM transaksi
                  LEFT JOIN pelanggan ON transaksi.kode_pelanggan = pelanggan.kode_pelanggan
                  LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
                  WHERE transaksi.no_transaksi = '$kode'
                  GROUP BY transaksi.no_transaksi;";
  				  $query=mysqli_query($conn, $sql);
  				  $result=mysqli_fetch_array($query);
              ?>
            <h1><?php echo $result['nama_pelanggan']; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  <?php
        //menampilkan data user
				  $kode = $_GET['kode'];
				  $sql="SELECT transaksi.no_transaksi AS nota, transaksi.tanggal, transaksi.kode_pelanggan, pelanggan.nama_pelanggan, transaksi.grandtotal, transaksi.grandtotal-(SELECT SUM(jumlah) FROM bayar WHERE no_transaksi = nota) AS jumlah FROM transaksi
                LEFT JOIN pelanggan ON transaksi.kode_pelanggan = pelanggan.kode_pelanggan
                LEFT JOIN bayar ON transaksi.no_transaksi = bayar.no_transaksi
                WHERE transaksi.no_transaksi = '$kode'
                GROUP BY transaksi.no_transaksi;";
				  $query=mysqli_query($conn, $sql);
				  $row = mysqli_fetch_array($query);

			  ?>
              <form action="transaksi-belum-simpan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">No Transaksi</label>
                    <input type="text" name="no_transaksi" class="form-control" id="exampleInputEmail1" placeholder="no_transaksi" value="<?php echo $row['nota'];?>">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input type="text" name="Tanggal" class="form-control" id="exampleInputEmail1" placeholder="tanggal" value="<?php echo $row['tanggal'];?>">
                    <label for="exampleInputEmail1">jumlah</label>
                    <input type="text" name="jumlah" class="form-control" id="exampleInputEmail1" placeholder="jumlah" value="<?php echo $row['jumlah'];?>">
                    <label for="exampleInputEmail1">jenis pembayaran</label>
                    <select class="custom-select rounded-0" name="jenis_bayar" id="exampleSelectRounded0">
                    <option value = "belum">Belum</option>
                    <option value = "cash">Cash</option>
                    <option value = "transfer">Transfer</option>
                    <option value = "debit">debit</option>
                    </select>
                    <label for="exampleInputEmail1">bayar</label>
                    <input type="text" name="bayar" class="form-control" id="exampleInputEmail1" placeholder="bayar" value="">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
