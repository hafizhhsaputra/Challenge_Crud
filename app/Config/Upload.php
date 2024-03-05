<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Upload extends BaseConfig
{
    // Maksimum ukuran file yang diizinkan (dalam kilobita)
    public $maxSize = 10240; // 10MB

    // Tipe-tipe file yang diizinkan untuk diunggah
    public $allowedTypes = 'jpg|jpeg|png|gif';

    // Direktori tempat file akan disimpan
    public $uploadPath = WRITEPATH . 'uploads/'; // Direktori uploads di dalam folder writeable

    // Apakah nama file harus diacak atau tidak
    public $encryptName = true;

    // Apakah file yang ada sebelumnya akan diganti atau tidak
    public $overwrite = false;

    // Apakah harus membuat sub-direktori secara otomatis jika belum ada
    public $createSubDirectories = true;

    // Izinkan penamaan ulang file jika ada konflik
    public $allowNameDuplicates = false;
}
