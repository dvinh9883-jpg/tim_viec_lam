<?php
class UserModel
{
    public function find(int $id): ?array
    {
        $s = db()->prepare('SELECT * FROM users WHERE id=?');
        $s->execute([$id]);
        return $s->fetch() ?: null;
    }
}
