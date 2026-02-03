<?php

class HomeController {
    public static function index(): void {
        render_view('home/index', [], 'Home');
    }

    public static function articles(): void {
        global $pdo;
        $stmt = $pdo->query("
            SELECT id, title, slug, category, excerpt, cover_url, author, published_at
            FROM articles
            WHERE published_at IS NOT NULL
            ORDER BY published_at DESC, id DESC
            LIMIT 24
        ");
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        render_view('home/articles', ['articles' => $articles], 'Articles');
    }
}
