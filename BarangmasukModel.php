<?php

class BarangmasukModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=project', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getBarang()
    {
        $query = $this->db->query('SELECT * FROM barang_masuk
    INNER JOIN barang ON barang_masuk.code_barang = barang.code_barang');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getJumlahById($id)
    {
        $stmt = $this->db->prepare('SELECT jumlah FROM Barang_masuk WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn();
    }

    public function getcodebyId($id)
    {
        $stmt = $this->db->prepare('SELECT code_barang FROM Barang_masuk WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn();
    }

    public function deleteRecord($id)
    {
        $query = $this->db->prepare('DELETE FROM barang_masuk WHERE id = :id');
        return $query->execute(['id' => $id]);
    }

    public function getBarangByCode($code_barang)
    {
        $query = $this->db->prepare('SELECT * FROM barang_masuk
        LEFT JOIN barang ON barang_masuk.code_barang = barang.code_barang WHERE barang_masuk.code_barang = :code');
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
        $query = $this->db->prepare('INSERT INTO barang_masuk (code_barang, tanggal, jumlah) VALUES (:code_barang, :tanggal, :jumlah)');
        $query->execute($data);

        $code_barang = $data['code_barang'];
        $jumlah = $data['jumlah'];

        // Update the stock in the 'barang' table
        $updateQuery = $this->db->prepare('UPDATE barang SET stok = stok + :jumlah WHERE code_barang = :code_barang');
        $updateQuery->bindParam(':code_barang', $code_barang);
        $updateQuery->bindParam(':jumlah', $jumlah);
        $updateQuery->execute();

        return $query->rowCount(); // Return the number of affected rows
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

    public function updateBarang($code_barang, $nama, $type_baut, $jenis,$buffer)
    {
        $query = $this->db->prepare('UPDATE barang SET nama = :nama,buffer = :buffer, type = :type, jenis = :jenis WHERE code_barang = :code');
        return $query->execute(['nama' => $nama,'buffer' => $buffer, 'type' => $type_baut, 'jenis' => $jenis, 'code' => $code_barang]);
    }
}
