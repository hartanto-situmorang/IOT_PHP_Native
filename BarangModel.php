<?php

class BarangModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=project', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function updateStok($code_barang, $jumlah)
    {
        $query = $this->db->prepare('SELECT stok FROM barang WHERE code_barang = :code');
        $query->execute(['code' => $code_barang]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $currentStok = $row['stok'];

            // Calculate the new stok
            $newStok = $currentStok + $jumlah;

            // Update the stok in Barang table
            $query = $this->db->prepare('UPDATE barang SET stok = :stok WHERE code_barang = :code');
            $query->execute(['stok' => $newStok, 'code' => $code_barang]);
            return true;
        }
    }

    public function getBarang()
    {
        $query = $this->db->query('SELECT * FROM barang');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBarangByCode($code_barang)
    {
        $query = $this->db->prepare('SELECT * FROM barang WHERE code_barang = :code');
        $query->execute(['code' => $code_barang]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBarang($code_barang)
    {
        $query = $this->db->prepare('DELETE FROM barang WHERE code_barang = :code');
        return $query->execute(['code' => $code_barang]);
    }

    public function saveBarang($data)
    {
        $query = $this->db->prepare('INSERT INTO barang (code_barang,nama,type,jenis,buffer) VALUES (:code_barang, :nama, :type,:jenis,:buffer)');
        return $query->execute($data);
    }

    public function updateStokmasuk($code_barang, $jumlah)
    {
        $query = $this->db->prepare('SELECT stok FROM barang WHERE code_barang = :code');
        $query->execute(['code' => $code_barang]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $currentStok = $row['stok'];

            // Calculate the new stok
            $newStok = $currentStok - $jumlah;

            // Update the stok in Barang table
            $query = $this->db->prepare('UPDATE barang SET stok = :stok WHERE code_barang = :code');
            $query->execute(['stok' => $newStok, 'code' => $code_barang]);
            return true;
        }
    }
    public function updateStokkeluar($code_barang, $jumlah)
    {
        $query = $this->db->prepare('SELECT stok FROM barang WHERE code_barang = :code');
        $query->execute(['code' => $code_barang]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $currentStok = $row['stok'];

            // Calculate the new stok
            $newStok = $currentStok + $jumlah;

            // Update the stok in Barang table
            $query = $this->db->prepare('UPDATE barang SET stok = :stok WHERE code_barang = :code');
            $query->execute(['stok' => $newStok, 'code' => $code_barang]);
            return true;
        }
    }

    public function updateBarang($code_barang, $nama, $type_baut, $jenis,$buffer)
    {
        $query = $this->db->prepare('UPDATE barang SET nama = :nama,buffer = :buffer, type = :type, jenis = :jenis WHERE code_barang = :code');
        $query->execute(['nama' => $nama,'buffer' => $buffer, 'type' => $type_baut, 'jenis' => $jenis, 'code' => $code_barang]);
        return true;
    }
}
