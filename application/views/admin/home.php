

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                MAKANAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $produk ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                PELANGGAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pelanggan ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            if ($this->session->userdata('level_login')=='SUPERADMIN' OR $this->session->userdata('level_login')=='PEMILIK') {
                                $pp = 'TRANSAKSI';
                            }else if ($this->session->userdata('level_login')=='WAITER' OR $this->session->userdata('level_login')=='KOKI' OR $this->session->userdata('level_login')=='KASIR'){
                                $pp = 'MAKANAN';
                            }
                         ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?= $pp ?>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $transaksi .' (Rp. '.number_format($omset,2,',','.').')'?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                PENGGUNA</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Visi dan Misi</h6>
                                   
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <label>VISI</label>
                                    <ul>
                                        <li>Memberdayakan masyarakat melalui kenikmatan makanan, visi kami adalah menciptakan pengalaman bersantap yang hangat dan ramah yang menumbuhkan hubungan dan kenangan. Kami berusaha menjadi tujuan utama untuk kuliner lezat yang bersumber dari daerah setempat yang tidak hanya memuaskan selera pelanggan kami tetapi juga mendukung ekonomi lokal dan mempromosikan keberlanjutan.
                                        </li>
                                    </ul>
                                    <label>MISI</label>
                                    <ul>
                                        <li>Di Chania Restaurant, misi kami adalah menyediakan layanan yang luar biasa, makanan berkualitas, dan pengalaman bersantap unik yang melampaui harapan pelanggan kami. Kami berkomitmen untuk:
                                            <ol>
                                                <li>1. Sumber Lokal : Bermitra dengan petani dan pemasok lokal untuk memastikan bahan-bahan paling segar dan berkualitas tinggi untuk hidangan kami.</li>
                                                <li>2. Perpaduan Budaya : Memadukan cita rasa tradisional dengan sentuhan modern untuk menciptakan pengalaman kuliner unik yang mencerminkan keberagaman komunitas kami.</li>
                                                <li>3. Keterlibatan Komunitas : Menyelenggarakan acara dan kegiatan yang menyatukan orang, meningkatkan hubungan sosial, dan mendukung tujuan lokal.</li>
                                                <li>4. Keberlanjutan : Menerapkan praktik ramah lingkungan dan mengurangi limbah untuk meminimalkan dampak lingkungan kami.</li>
                                                <li>5. Pengembangan Karyawan : Menyediakan pelatihan berkelanjutan dan kesempatan untuk berkembang guna memberdayakan anggota tim kami dan menumbuhkan lingkungan kerja yang positif. Dengan menjalankan nilai-nilai ini, kami bertujuan untuk membangun basis pelanggan yang loyal, berkontribusi terhadap masyarakat lokal, dan menjadikan diri sebagai pemimpin dalam industri kuliner.</li>
                                            </ol>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
