<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Control_model extends CI_Model {
     
    public function __construct()
    {
        parent::__construct();
        $this->load->database();        
    }

    public function getData()
    {
        $i = 1;
        $produk_kita = $this->db->query("SELECT * from produk_kita");
        
        foreach($produk_kita->result() as $rowa) {
            $akses="<center><a href='#' class='tooltip-success' data-rel='tooltip' title='Ubah' ><button class='btn btn-success ace-icon fa fa-pencil-square-o bigger-120'>Edit</button></a>  <a href='#' class='tooltip-error' data-rel='tooltip' title='Hapus' ><button class='btn btn-danger ace-icon fa fa-trash-o bigger-120'>Hapus</button></a></center>";
            
            $row = array();
            $row[] = $i;
            $row[] = $rowa->kategori_cabe;
            $row[] = $rowa->nama_cabe;
            $row[] = '<img src="'. base_url() .'/upload/'. $rowa->img .'" >';
            $row[] = $rowa->img;
            $row[] = $rowa->harga;
            $row[] = $rowa->stok;
            $row[] = $akses;
            $row[] = $rowa->nama_cabe;

            $data['data'][] = $row;
            $i++;
        }
        echo json_encode($data);
    }

    public function add()
    {
        $kategoriCabe = $this->input->post('txtKategoriCabe');
        $namaCabe = $this->input->post('txtNamaCabe');
        $gambar = $this->input->post('txtGambar');
        $harga = $this->input->post('txtHarga');
        $stok = $this->input->post('txtStok');
        $idCabe = $this->input->post('txtIdCabe');

        $sql = "SELECT * FROM produk_kita WHERE nama_cabe ='$idCabe'";
        $result =$this->db->query($sql);

        if ($result->num_rows() > 0){
            if($this->db->simple_query("UPDATE produk_kita
                    SET kategori_cabe = '$kategoriCabe', nama_cabe = '$namaCabe' , img = '$gambar', harga = '$harga', stok = '$stok'
                    WHERE nama_cabe='$idCabe'")) {       
                $data['msg'][0] = "ok";
                $data['msg'][1] = "Data berhasil diubah.....";
            } else {
                $error = $this->db->error();
                $myJSON = json_encode($error['code'].": ".$error['message']);
                $data['msg'][0] = "err";
                $data['msg'][1] = $myJSON;
            }
        
        } else {
        
            if($this->db->simple_query("INSERT INTO produk_kita(kategori_cabe, nama_cabe, img, harga, stok)
                    VALUES ('$kategoriCabe', '$namaCabe', '$gambar', '$harga', '$stok')")){       
                $data['msg'][0] = "ok";
                $data['msg'][1] = "Data berhasil ditambahkan.....";
            } else {
                $error = $this->db->error();
                $myJSON = json_encode($error['code'].": ".$error['message']);
                $data['msg'][0] = "err";
                $data['msg'][1] = $myJSON;
            }
        }

        echo json_encode($data);
    }

    public function hapus()
    {
        $idCabe = $this->input->post('id');
        
            if($this->db->simple_query("DELETE FROM produk_kita WHERE nama_cabe = '$idCabe'")){       
                $data['msg'][0] = "hapus";
                $data['msg'][1] = "Data berhasil dihapus.....";
            } else {
                $error = $this->db->error();
                $myJSON = json_encode($error['code'].": ".$error['message']);
                $data['msg'][0] = "err";
                $data['msg'][1] = $myJSON;
            }
        
        echo json_encode($data);
    }


    public function getData2()
    {
        $query = $this->db->query("SELECT * FROM produk_kita ORDER BY img ASC");

        return $query->result();
    }

    public function akses()
    {
        $akses = $this->db->get_where('user_menu', ['url' => 'control' ])->row_array();
        $am = $akses['id'];
        $role = $this->session->userdata('role_id');

        $query = $this->db->query("SELECT menu_id FROM user_access_menu WHERE menu_id = '$am' AND role_id = '$role'");

        return $query->result();
    }

}