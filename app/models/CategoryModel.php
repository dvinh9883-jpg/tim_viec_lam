<?php
class CategoryModel
{
    public function all(): array
    {
        return db()->query('SELECT * FROM categories ORDER BY name')->fetchAll();
    }
}
