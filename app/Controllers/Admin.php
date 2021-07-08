<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\OrangModel;

class Admin extends BaseController
{
    protected $PostModel;
    protected $UserModel;
    protected $OrangModel;
    public function __construct()
    {
        $this->PostModel = new PostModel();
        $this->UserModel = new UserModel();
        $this->OrangModel = new OrangModel();
    }

    // tampilan data sudah di pagination
    // public function orang()
    // {
    //     $jumlahPage = $this->request->getVar('page_dataorang') ? $this->request->getVar('page_dataorang') : 1;

    //     $data = [
    //         'title' => 'Data Orang',
    //         'orang' => $this->OrangModel->paginate(10, 'dataorang'),
    //         'pager' => $this->OrangModel->pager,
    //         'jumlahPage' => $jumlahPage
    //     ];
    //     return view('orang', $data);
    // }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('admin/login', $data);
    }

    // tampilan login
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('admin/home', $data);
    }

    // tampilam home
    public function home()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('admin/home', $data);
    }

    // proses login
    public function process()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $this->UserModel->where([
            'username' => $username
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser['password'])) {
                session()->set([
                    'username' => $dataUser['username'],
                    'nama' => $dataUser['nama'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('/admin/home'));
            } else {
                session()->setFlashdata('error', '1Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Data Username Tidak ditemukan');
            return redirect()->back();
        }
    }
    function logout()
    {
        session()->destroy();
        return redirect()->to('/Admin');
    }

    public function post()
    {
        //$post = $this->PostModel->findAll();
        $jumlahPage = $this->request->getVar('page_post') ? $this->request->getVar('page_post') : 1;
        $data = [
            'title'         => 'Post',
            'post'          => $this->PostModel->getIdPost(),
            'pager'         => $this->PostModel->pager,
            'jumlahPage'    => $jumlahPage
        ];


        return view('admin/post', $data);
    }


    public function user()
    {
        // $user = $this->UserModel->findAll();
        $jumlahPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $data = [
            'title'          => 'User',
            'user'          =>  $this->UserModel->getIdUser(),
            'pager'         => $this->UserModel->pager,
            'jumlahPage'    => $jumlahPage
        ];

        return view('admin/user', $data);
    }

    // detail post
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Post',
            'post' => $this->PostModel->getIdPost($id)
        ];

        // cek jika data tidak ada
        if (empty($data['post'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tersebut" . $id . "Tidak ditemukan");
        }

        return view('admin/detail', $data);
    }



    // tambah data post
    public function create_post()
    {
        $data = [
            'title' => 'Form Tambah Data Post',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/create_post', $data);
    }

    // tambah data user
    public function create_user()
    {
        $data = [
            'title' => 'Form Tambah Data User',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/create_user', $data);
    }

    // save data post
    public function save_post()
    {
        // validasi data user
        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'erros' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,5024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'File bukan Gambar.',
                    'mime_in' => 'Format file bukan JPG,JPEG,PNG.'
                ]
            ],
            'tanggal' => 'required'
        ])) {
            // $validation = \Config\Services::validation();
            // notif
            // session()->setFlashdata('alert', 'form harus di isi semua');

            // return redirect()->to('/Admin/create_user')->withInput()->with('validation', $validation);
            return redirect()->to('/Admin/create_post')->withInput();
        }

        // simpan gambar
        $gambar = $this->request->getFile('gambar');
        // $namaGambar = $gambar->getRandomName();
        $gambar->move('img');
        $namaGambar = $gambar->getName('gambar');

        $this->PostModel->save([
            'foto' => $namaGambar,
            'tgl_post' => $this->request->getVar('tanggal'),
            'judul' => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ]);

        // notif
        session()->setFlashdata('notif', 'Data Berhasil di tambahkan');

        return redirect()->to('/Admin/post');
    }

    // save data user
    public function save_user()
    {
        // validasi data user
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => '{field}  harus di isi.',
                    'is_unique' => '{field} sudah ada.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'erros' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  harus di isi.'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // notif
            // session()->setFlashdata('alert', 'form harus di isi semua');

            // return redirect()->to('/Admin/create_user')->withInput()->with('validation', $validation);
            return redirect()->to('/Admin/create_user')->withInput();
        }
        $this->UserModel->save([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'nama' => $this->request->getVar('nama'),
            'lvl' => $this->request->getVar('level'),
            'status' => 1
        ]);

        // notif
        session()->setFlashdata('notif', 'Data Berhasil di tambahkan');

        return redirect()->to('/Admin/user');
    }

    // hapus data user
    public function delete_user($id)
    {
        $this->UserModel->delete($id);
        session()->setFlashdata('notif', 'Data berhasil di dihapus');
        return redirect()->to('/Admin/user');
    }

    // hapus data post
    public function delete_post($id)
    {

        // id gambar
        $gambar = $this->PostModel->getIdPost($id);

        // hapus gambar
        unlink('img/' . $gambar['foto']);


        $this->PostModel->delete($id);
        session()->setFlashdata('notif', 'Data berhasil di dihapus');
        return redirect()->to('/Admin/post');
    }

    // tampilan edit data user
    public function edit_user($id)
    {
        $data = [
            'title' => 'Form Ubah Data User',
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->getIdUser($id)
        ];

        return view('admin/edit_user', $data);
    }

    // tampilan edit data post
    public function edit_post($id)
    {
        $data = [
            'title' => 'Form Ubah Data Post',
            'validation' => \Config\Services::validation(),
            'post' => $this->PostModel->getIdPost($id)
        ];

        return view('admin/edit_post', $data);
    }

    // Update user
    public function update_user($id)
    {
        // cek username
        $user_lama = $this->UserModel->getIdUser($id);
        if ($user_lama['username'] == $this->request->getVar('username')) {
            $rule_user = 'required';
        } else {
            $rule_user = 'required|is_unique[user.username]';
        }

        // validasi data user
        if (!$this->validate([
            'username' => [
                'rules' => $rule_user,
                'errors' => [
                    'required' => '{field}  harus di isi.',
                    'is_unique' => '{field} sudah ada.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'erros' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  harus di isi.'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // notif
            // session()->setFlashdata('alert', 'form harus di isi semua');

            // return redirect()->to('/Admin/edit_user/' . $user_lama['id_user'])->withInput()->with('validation', $validation);
            return redirect()->to('/Admin/edit_user/' . $user_lama['id_user'])->withInput();
        }
        $this->UserModel->save([
            'id_user' => $id,
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'nama' => $this->request->getVar('nama'),
            'lvl' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status')
        ]);
        // notif
        session()->setFlashdata('notif', 'Data Berhasil di ubah');

        return redirect()->to('/Admin/user');
    }

    // Update post
    public function update_post($id)
    {
        // validasi data user
        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'erros' => [
                    'required' => '{field}  harus di isi.'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,5024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'File bukan Gambar.',
                    'mime_in' => 'Format file bukan JPG,JPEG,PNG.'
                ]
            ],
            'tanggal' => 'required'
        ])) {
            // $validation = \Config\Services::validation();
            // notif
            // session()->setFlashdata('alert', 'form harus di isi semua');

            // return redirect()->to('/Admin/create_user')->withInput()->with('validation', $validation);
            return redirect()->to('/Admin/edit_post/' . $id)->withInput();
        }

        // simpan gambar
        $gambar = $this->request->getFile('gambar');
        // cek gamba
        if ($gambar->getError() == 4) {
            $gambar = $this->request->getVar('gambarLama');
        } else {
            // nama gambar
            $namaGambar = $gambar->getName('gambar');
            // pindah foto
            $gambar->move('img');
            // hapus foto lama
            unlink('img/' . $this->request->getVar('gambarLama'));
        }

        $this->PostModel->save([
            'id_post' => $id,
            'foto' => $namaGambar,
            'tgl_post' => $this->request->getVar('tanggal'),
            'judul' => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ]);

        // notif
        session()->setFlashdata('notif', 'Data Berhasil di Ubah');

        return redirect()->to('/Admin/post');
    }
}

// public function order()
// {
//     echo view('admin/layout/header');
//     echo view('admin/order');
//     echo view('admin/layout/footer');
// }