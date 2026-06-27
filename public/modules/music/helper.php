<?php

require_once __DIR__ . '/../../config/database.php';

class AlbumHelper
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAlbums()
    {
        $sql = "SELECT * FROM albums
                ORDER BY release_date DESC,
                id DESC";

        return $this->db
                    ->query($sql)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

}