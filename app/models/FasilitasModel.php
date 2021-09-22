<?php

class FasilitasModel
{

    private $table = 'tb_fasilitas';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getallFasilitas()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getdetailFasilitas($id_fasilitas)
    {
        $query = "SELECT * FROM tb_fasilitas where id_fasilitas = $id_fasilitas";
        $this->db->query($query);
        return $this->db->single();
    }


    public function tambahFasilitas($data, $foto)
    {
        $fotofasilitas = $foto['gambar_fasilitas']['name'];
        $tmpfotofasilitas = $foto['gambar_fasilitas']['tmp_name'];
        $fotofasilitasbaru = date('dmYHis') . $fotofasilitas;
        $pathfotofasilitas = "img/" . $fotofasilitasbaru;

        if (move_uploaded_file($tmpfotofasilitas, $pathfotofasilitas)) {

            $query = "INSERT INTO tb_fasilitas (nama_fasilitas,gambar_fasilitas)
        VALUES(:nama_fasilitas,:gambar_fasilitas)";
            $this->db->query($query);
            $this->db->bind('nama_fasilitas', $data['nama_fasilitas']);
            $this->db->bind('gambar_fasilitas', $fotofasilitasbaru);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function editGuru($data)
    {

        $query = "UPDATE tb_guru  
        SET
         nama_guru=:nama_guru, 
         nama_lembaga =:nama_lembaga, 
         ttl_guru =:ttl_guru,
         ktp_guru = :ktp_guru, 
         tmt =:tmt, 
         tahun_kerja =:tahun_kerja,
         bulan_kerja =:bulan_kerja, 
         status_guru=:status_guru , 
         alamat_lembaga =:alamat_lembaga, 
         alamat_rumah = :alamat_rumah,
         pendidikan_guru = :pendidikan_guru,
         tempatlahir_guru = :tempatlahir_guru
            WHERE id_guru = :id_guru";

        $this->db->query($query);
        $this->db->bind('nama_guru', $data['nama_guru']);
        $this->db->bind('nama_lembaga', $data['nama_lembaga']);
        $this->db->bind('ttl_guru', $data['ttl_guru']);
        $this->db->bind('ktp_guru', $data['ktp_guru']);
        $this->db->bind('tmt', $data['tmt']);
        $this->db->bind('tahun_kerja', $data['tahun_kerja']);
        $this->db->bind('bulan_kerja', $data['bulan_kerja']);
        $this->db->bind('status_guru', $data['status_guru']);
        $this->db->bind('alamat_lembaga', $data['alamat_lembaga']);
        $this->db->bind('alamat_rumah', $data['alamat_rumah']);
        $this->db->bind('pendidikan_guru', $data['pendidikan_guru']);
        $this->db->bind('tempatlahir_guru', $data['tempatlahir_guru']);
        $this->db->bind('id_guru', $data['id_guru']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariGuru()
    {
        $key = $_POST['key'];
        $query = "SELECT * FROM tb_guru WHERE  nama_guru LIKE :key";
        $this->db->query($query);
        $this->db->bind('key', "%$key%");
        return $this->db->resultSet();
    }

    public function hapusfasilitas($data)
    {
        $query = "DELETE tb_fasilitas FROM tb_fasilitas  WHERE id_fasilitas = :id_fasilitas";
        $this->db->query($query);
        $this->db->bind('id_fasilitas', $data['id_fasilitas']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editfoto($data)
    {



        if ($_FILES['btn_editfoto']['name'] == null) {
            $query = "UPDATE tb_fasilitas  
            SET
             nama_fasilitas= :nama_fasilitas
             WHERE id_fasilitas = :id_fasilitas";
            $this->db->query($query);
            $this->db->bind('id_fasilitas',  $data['id_fasilitas']);
            $this->db->bind('nama_fasilitas',  $data['nama_fasilitas']);
            $this->db->execute();

            return $this->db->rowCount();
        } else {
            $fotofasilitas = $_FILES['btn_editfoto']['name'];

            $tmpfotofasilitas = $_FILES['btn_editfoto']['tmp_name'];

            $fotofasilitasbaru = date('dmYHis') . $fotofasilitas;
            // Set path folder tempat menyimpan fotonya
            $pathfotofasilitas = "img/" . $fotofasilitasbaru;
            if (move_uploaded_file($tmpfotofasilitas, $pathfotofasilitas)) {

                $query = "UPDATE tb_fasilitas  
                    SET
                     gambar_fasilitas= :gambar_fasilitas,
                     nama_fasilitas= :nama_fasilitas
                     WHERE id_fasilitas = :id_fasilitas";
                $this->db->query($query);
                $this->db->bind('gambar_fasilitas', $fotofasilitasbaru);
                $this->db->bind('id_fasilitas',  $data['id_fasilitas']);
                $this->db->bind('nama_fasilitas',  $data['nama_fasilitas']);
                $this->db->execute();

                return $this->db->rowCount();
            }
        }
    }
}
