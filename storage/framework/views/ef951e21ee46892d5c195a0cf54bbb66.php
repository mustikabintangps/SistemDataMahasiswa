

<?php $__env->startSection('title', 'HOME - Data Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold">
            <i class="bi bi-mortarboard-fill text-primary me-2"></i>
            Data Mahasiswa
        </h2>
    </div>
</div>

<!-- Statistik Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-light mb-1">Total Mahasiswa</h6>
                        <h3 class="fw-bold mb-0"><?php echo e($totalMahasiswa); ?></h3>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-light mb-1">Laki-laki</h6>
                        <h3 class="fw-bold mb-0"><?php echo e($totalLaki); ?></h3>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-gender-male"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-light mb-1">Perempuan</h6>
                        <h3 class="fw-bold mb-0"><?php echo e($totalPerempuan); ?></h3>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-gender-female"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Form -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('home')); ?>" method="GET" class="row g-3">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           class="form-control border-start-0 ps-0" 
                           name="search" 
                           placeholder="Cari mahasiswa berdasarkan nama..." 
                           value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-2"></i>Cari
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Data Mahasiswa -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <?php if($mahasiswas->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Gender</th>
                            <th>Usia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $mahasiswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="fw-semibold"><?php echo e($mhs->nim); ?></span></td>
                            <td><?php echo e($mhs->nama); ?></td>
                            <td><?php echo e(Str::limit($mhs->alamat, 30)); ?></td>
                            <td><?php echo e($mhs->tanggal_lahir->format('d/m/Y')); ?></td>
                            <td>
                                <?php if($mhs->gender == 'L'): ?>
                                    <span class="badge bg-info">Laki-laki</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Perempuan</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($mhs->usia); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($mahasiswas->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">Tidak ada data mahasiswa</h5>
                <p class="text-muted mb-0">Silakan tambahkan data melalui menu ADMIN</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Herd\pengelolaan_mahasiswa\resources\views/home.blade.php ENDPATH**/ ?>