

<?php $__env->startSection('title', 'ADMIN - Kelola Data Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold">
            <i class="bi bi-gear-fill text-primary me-2"></i>
            Kelola Data Mahasiswa
        </h2>
        <p class="text-muted">Halaman untuk mengelola data mahasiswa (Tambah, Edit, Hapus)</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="<?php echo e(route('admin.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Mahasiswa
        </a>
    </div>
</div>

<!-- Search Form -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('admin.index')); ?>" method="GET" class="row g-3">
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
                            <th>Aksi</th>
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
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('admin.edit', $mhs->id)); ?>" 
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.destroy', $mhs->id)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
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
                <a href="<?php echo e(route('admin.create')); ?>" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Asus\Herd\pengelolaan_mahasiswa\resources\views/admin/index.blade.php ENDPATH**/ ?>