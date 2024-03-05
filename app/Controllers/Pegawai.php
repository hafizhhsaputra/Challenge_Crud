<?php

namespace App\Controllers;

use App\Models\ModelPegawai;

class Pegawai extends BaseController
{
	protected $model;

	public function __construct()
	{
		$this->model = new ModelPegawai();
	}

	public function hapus($id)
	{
		$this->model->delete($id);
		return redirect()->to('/pegawai'); // Sesuaikan dengan route yang benar
	}

	public function edit($id)
	{
		$data = $this->model->find($id);
		return json_encode($data);
	}

	public function foto($filename)
{
    // Path ke direktori foto
    $path = WRITEPATH . 'uploads/' . $filename;

    // Memeriksa apakah file ada
    if (file_exists($path)) {
        // Mendapatkan tipe konten dari file
        $mimeType = mime_content_type($path);

        // Mengirim header tipe konten
        header('Content-Type: ' . $mimeType);

        // Mengirimkan konten file
        readfile($path);
    } else {
        // Jika file tidak ditemukan, kirimkan respons not found
        return $this->response->setStatusCode(404)->setBody('File not found');
    }
}

	public function simpan()
	{
		$validation = \Config\Services::validation();

		$validation->setRules([
			'nama' => 'required|min_length[5]',
			'email' => 'required|valid_email',
			'bidang' => 'required|min_length[5]',
			'alamat' => 'required|min_length[5]',
			'foto' => [
    		'label' => 'Foto',
    		'rules' => 'uploaded[foto]|max_size[foto,10240]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]',
    		'errors' => [
        	'uploaded' => '{field} harus diunggah.',
        	'max_size' => 'Ukuran {field} tidak boleh lebih dari 10MB.',
        	'is_image' => '{field} harus berupa file gambar.',
        	'mime_in' => 'Format {field} harus jpg, jpeg, png, atau gif.'
    ]
]


		]);

		if ($validation->withRequest($this->request)->run()) {
			$id = $this->request->getPost('id');
			$nama = $this->request->getPost('nama');
			$email = $this->request->getPost('email');
			$bidang = $this->request->getPost('bidang');
			$alamat = $this->request->getPost('alamat');

			$data = [
				'nama' => $nama,
				'email' => $email,
				'bidang' => $bidang,
				'alamat' => $alamat
			];

			$this->model->save($data);

			$hasil['sukses'] = "Berhasil memasukkan data";
			$hasil['error'] = false;
		} else {
			$hasil['sukses'] = false;
			$hasil['error'] = $validation->getErrors();
		}

		return json_encode($hasil);
	}

	public function index()
	{
		$jumlahBaris = 5;
		$katakunci = $this->request->getGet('katakunci');
		$data['katakunci'] = $katakunci;

		if ($katakunci) {
			$pencarian = $this->model->cari($katakunci);
		} else {
			$pencarian = $this->model;
		}

		$data['dataPegawai'] = $pencarian->orderBy('id', 'desc')->paginate($jumlahBaris);
		$data['pager'] = $this->model->pager;
		$data['nomor'] = ($this->request->getVar('page')) ? $this->request->getVar('page') : 0;

		// Mengambil nama file foto dari setiap data pegawai
		foreach ($data['dataPegawai'] as &$pegawai) {
			$pegawai['foto'] = base_url('uploads/' . $pegawai['foto']);
		}

		return view('pegawai_view', $data);
	}
}