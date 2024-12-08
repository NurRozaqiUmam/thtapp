<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Produk;
use PHPExcel;
use PHPExcel_Writer_Excel2007;

class Produk extends Controller
{

    public function index()
    {
        $model = new M_Produk();

        $session = session();

        // Cek apakah pengguna sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $search = $this->request->getVar('search') ?? '';
        $kategori = $this->request->getVar('kategori') ?? 'semua';

        // Mengambil data produk
        if ($kategori === 'semua') {
            $produk = $model->like('nama_produk', $search)->orLike('kategori_produk', $search)->findAll();
        } else {
            $produk = $model->where('kategori_produk', $kategori)->like('nama_produk', $search)->findAll();
        }

        // Tentukan jumlah data per halaman
        $perPage = 10; // Contoh 10 data per halaman

        // Ambil halaman saat ini
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Ambil data produk dengan pagination
        $produk = $model->paginate($perPage, 'produk', $currentPage);

        $data = [
            'title' => 'Daftar Produk',
            'produk' => $produk,
            'pager' => $model->pager,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'totalItems' => $model->countAll(),
        ];

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('produk/index', $data);
        // echo view('templates/footer');
    }

    public function tambahProduk()
    {
        $model = new M_Produk();
        
        $data = [
            'title' => 'Tambah Produk',
            'validation' => \Config\Services::validation()
        ];

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('produk/tambahproduk');

    }

    public function store()
    {
        $model = new M_Produk();

        $rules = [
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama produk wajib diisi.'
                ],
            ],
            'kategori_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori produk wajib diisi.'
                ],
            ],
            'harga_beli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga beli wajib diisi.'
                ],
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga jual wajib diisi.'
                ],
            ],
            'stok_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok produk wajib diisi.'
                ],
            ],
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar produk wajib diisi.',
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 1 MB.',
                    'is_image' => 'File yang diupload bukan gambar.',
                    'mime_in' => 'File yang diupload bukan gambar.'
                ],
            ]
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Produk',
                'validation' => \Config\Services::validation()
            ];
            echo view('/produk/tambahproduk', $data);
        } else {
            $model = new M_Produk();
            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move('assets/images', $imageName);

            $data = [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'kategori_produk' => $this->request->getPost('kategori_produk'),
                'harga_beli' => $this->request->getPost('harga_beli'),
                'harga_jual' => $this->request->getPost('harga_jual'),
                'stok_produk' => $this->request->getPost('stok_produk'),
                'image' => $imageName
            ];

            if ($model->insert($data)) {
                return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan.');
            } else {
                return redirect()->to('/produk')->with('error', 'Gagal menambahkan produk.');
            }
        }

    }

    public function editproduk($id)
    {
        $model = new M_Produk();

        // Cari data produk berdasarkan ID
        $produk = $model->find($id);

        // Jika data produk tidak ada
        if (!$produk) {
            return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Produk',
            'produk' => $produk,
            'validation' => \Config\Services::validation()
        ];

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('produk/editproduk');
        
    }

    public function update($id)
    {
        $model = new M_Produk();

        $rules = [
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama produk wajib diisi.'
                ],
            ],
            'kategori_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori produk wajib diisi.'
                ],
            ],
            'harga_beli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga beli wajib diisi.'
                ],
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga jual wajib diisi.'
                ],
            ],
            'stok_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok produk wajib diisi.'
                ],
            ],
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar produk wajib diisi.',
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 1 MB.',
                    'is_image' => 'File yang diupload bukan gambar.',
                    'mime_in' => 'File yang diupload bukan gambar.'
                ],
            ]
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Edit Produk',
                'produk' => $produk,
                'validation' => \Config\Services::validation()
            ];
            echo view('/produk/editproduk', $data);
        } else {
            $model = new M_Produk();
            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move('assets/images', $imageName);

            $data = [
                'id' => $this->request->getPost('id'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'kategori_produk' => $this->request->getPost('kategori_produk'),
                'harga_beli' => $this->request->getPost('harga_beli'),
                'harga_jual' => $this->request->getPost('harga_jual'),
                'stok_produk' => $this->request->getPost('stok_produk'),
                'image' => $imageName
            ];

            if ($model->update($id, $data)) {
                return redirect()->to('/produk')->with('success', 'Data produk berhasil diedit.');
            } else {
                return redirect()->to('/produk')->with('error', 'Data produk gagal menambahkan produk.');
            }
        }

    }

    public function delete($id)
        {
            $model = new M_Produk();
    
            // Cari data produk berdasarkan ID
            $produk = $model->find($id);
    
            // Jika data produk tidak ada
            if (!$produk) {
                return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan.');
            }
    
            // Hapus data produk
            $model->delete($id);
    
            return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
        }

        public function excel() {
            $model = new M_Produk();
    
            // Ambil data produk
            $produk = $model->findAll();
    
            require_once APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php';
            require_once APPPATH . 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';
    
            // Buat objek PHPExcel
            $object = new PHPExcel();
    
            // Set properties
            $object->getProperties()->setCreator('SIMS Web App')
                ->setLastModifiedBy('SIMS Web App')
                ->setTitle('Data Produk')
                ->setSubject('Produk')
                ->setDescription('Laporan Data Produk')
                ->setKeywords('data produk');
    
            // Buat pengaturan pada sheet
            $object->setActiveSheetIndex(0);

            $object->getActiveSheet()->setCellValue('A1', 'NO');
            $object->getActiveSheet()->setCellValue('B1', 'NAMA PRODUK');
            $object->getActiveSheet()->setCellValue('C1', 'KATEGORI PRODUK');
            $object->getActiveSheet()->setCellValue('D1', 'HARGA BELI');
            $object->getActiveSheet()->setCellValue('E1', 'HARGA JUAL');
            $object->getActiveSheet()->setCellValue('F1', 'STOK PRODUK');
            
            $baris = 2;
            $no = 1;

            foreach ($produk as $item) {
                $sheet->setCellValue('A' . $baris, $no++);
                $sheet->setCellValue('B' . $baris, $item['nama_produk']);
                $sheet->setCellValue('C' . $baris, $item['kategori_produk']);
                $sheet->setCellValue('D' . $baris, $item['harga_beli']);
                $sheet->setCellValue('E' . $baris, $item['harga_jual']);
                $sheet->setCellValue('F' . $baris, $item['stok_produk']);

                $baris++;
            }

            $filename = 'Data Produk' . date('YmdHis') . '.xlsx';

            $object->getActiveSheet()->setTitle('Data Produk');

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
            $writer->save('php://output');

            exit;
        }

    }