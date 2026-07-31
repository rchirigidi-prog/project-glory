    /**
     * Get all support requests ordered by newest first.
     */
    public function allLatest(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM support_requests
            ORDER BY created_at DESC
        ");

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Count all requests.
     */
    public function countAll(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*) AS total
            FROM support_requests
        ");

        return (int) $stmt->fetch()['total'];
    }

    /**
     * Count new requests.
     */
    public function countNew(): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM support_requests
            WHERE status = 'new'
        ");

        $stmt->execute();

        return (int) $stmt->fetch()['total'];
    }

    /**
     * Get requests by status.
     */
    public function getByStatus(string $status): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM support_requests
            WHERE status = :status
            ORDER BY created_at DESC
        ");

        $stmt->execute([
            'status' => $status
        ]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }