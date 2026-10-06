<?php
class JobModel
{
    public function search(string $q = '', int $category = 0): array
    {
        $sql = 'SELECT j.*,u.name employer,c.name category_name FROM jobs j JOIN users u ON u.id=j.employer_id LEFT JOIN categories c ON c.id=j.category_id WHERE 1';
        $p = [];
        if ($q !== '') {
            $sql .= ' AND (j.title LIKE ? OR j.location LIKE ? OR j.description LIKE ?)';
            $x = '%' . $q . '%';
            $p = [$x, $x, $x];
        }
        if ($category) {
            $sql .= ' AND j.category_id=?';
            $p[] = $category;
        }
        $sql .= ' ORDER BY j.created_at DESC';
        $s = db()->prepare($sql);
        $s->execute($p);
        return $s->fetchAll();
    }
    public function find(int $id): ?array
    {
        $s = db()->prepare('SELECT j.*,u.name employer,u.email employer_email,c.name category_name FROM jobs j JOIN users u ON u.id=j.employer_id LEFT JOIN categories c ON c.id=j.category_id WHERE j.id=?');
        $s->execute([$id]);
        return $s->fetch() ?: null;
    }
    public function byEmployer(int $id): array
    {
        $s = db()->prepare('SELECT j.*,c.name category_name,(SELECT COUNT(*) FROM applications a WHERE a.job_id=j.id) applications FROM jobs j LEFT JOIN categories c ON c.id=j.category_id WHERE j.employer_id=? ORDER BY j.created_at DESC');
        $s->execute([$id]);
        return $s->fetchAll();
    }
    public function findOwned(int $id, int $uid): ?array
    {
        $s = db()->prepare('SELECT * FROM jobs WHERE id=? AND employer_id=?');
        $s->execute([$id, $uid]);
        return $s->fetch() ?: null;
    }
    public function create(array $d, int $uid): void
    {
        $s = db()->prepare('INSERT INTO jobs(employer_id,category_id,title,location,salary,job_type,description,deadline) VALUES(?,?,?,?,?,?,?,?)');
        $s->execute([$uid, (int)$d['category_id'], trim($d['title']), trim($d['location']), trim($d['salary']), $d['job_type'], trim($d['description']), $d['deadline'] ?: null]);
    }
    public function update(int $id, array $d): void
    {
        $s = db()->prepare('UPDATE jobs SET category_id=?,title=?,location=?,salary=?,job_type=?,description=?,deadline=? WHERE id=?');
        $s->execute([(int)$d['category_id'], trim($d['title']), trim($d['location']), trim($d['salary']), $d['job_type'], trim($d['description']), $d['deadline'] ?: null, $id]);
    }
    public function delete(int $id, int $uid): void
    {
        $s = db()->prepare('DELETE FROM jobs WHERE id=? AND employer_id=?');
        $s->execute([$id, $uid]);
    }
}
