<?php

class SuperAdminController
{
    public static function dashboard(): void {
        require_superadmin();
        global $pdo;

        $stats = [
            'admins'   => $pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn(),
            'users'    => $pdo->query("SELECT COUNT(*) FROM users WHERE role='user'")->fetchColumn(),
            'rooms'    => $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn(),
            'bookings' => $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn(),
        ];

        render_view('super/dashboard', compact('stats'), 'Super Admin Dashboard');
    }

    public static function admins(): void {
        require_superadmin();
        global $pdo;

        $admins = $pdo->query("
            SELECT a.*, COUNT(u.id) total_users
            FROM users a
            LEFT JOIN users u ON u.owner_admin_id = a.id
            WHERE a.role='admin'
            GROUP BY a.id
        ")->fetchAll();

        render_view('super/admins', compact('admins'), 'List Admin');
    }

    public static function users(): void {
        require_superadmin();
        global $pdo;

        $users = $pdo->query("
            SELECT u.*, a.name AS admin_name
            FROM users u
            LEFT JOIN users a ON a.id = u.owner_admin_id
            WHERE u.role='user'
            ORDER BY a.name, u.name
        ")->fetchAll();

        render_view('super/users', compact('users'), 'List Users');
    }

    public static function bookings(): void {
        require_superadmin();
        global $pdo;

        $bookings = $pdo->query("
            SELECT b.*, r.name room_name, u.name user_name, a.name admin_name
            FROM bookings b
            JOIN rooms r ON r.id=b.room_id
            JOIN users u ON u.id=b.user_id
            JOIN users a ON a.id=b.admin_id
            ORDER BY b.start_time DESC
        ")->fetchAll();

        render_view('super/bookings', compact('bookings'), 'All Bookings');
    }

    public static function articles(): void {
        require_superadmin();
        global $pdo;

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'create') {
                $title = trim($_POST['title'] ?? '');
                $category = trim($_POST['category'] ?? '');
                $excerpt = trim($_POST['excerpt'] ?? '');
                $content = trim($_POST['content'] ?? '');
                $cover_url = trim($_POST['cover_url'] ?? '');
                $author = trim($_POST['author'] ?? '');
                $published_at = trim($_POST['published_at'] ?? '');

                if ($title === '') {
                    $error = 'Judul wajib diisi.';
                } else {
                    $slug = self::slugify($title);
                    $base = $slug;
                    $i = 1;
                    while (self::slugExists($pdo, $slug)) {
                        $slug = $base . '-' . $i;
                        $i++;
                    }
                    $stmt = $pdo->prepare("
                        INSERT INTO articles (title, slug, category, excerpt, content, cover_url, author, published_at)
                        VALUES (:title, :slug, :category, :excerpt, :content, :cover_url, :author, :published_at)
                    ");
                    $stmt->execute([
                        ':title' => $title,
                        ':slug' => $slug,
                        ':category' => $category !== '' ? $category : null,
                        ':excerpt' => $excerpt !== '' ? $excerpt : null,
                        ':content' => $content !== '' ? $content : null,
                        ':cover_url' => $cover_url !== '' ? $cover_url : null,
                        ':author' => $author !== '' ? $author : null,
                        ':published_at' => $published_at !== '' ? $published_at : null,
                    ]);
                }
            }

            if ($action === 'delete') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = :id");
                    $stmt->execute([':id' => $id]);
                }
            }
        }

        $articles = $pdo->query("
            SELECT id, title, slug, category, author, published_at, created_at
            FROM articles
            ORDER BY created_at DESC, id DESC
        ")->fetchAll();

        render_view('super/articles', compact('articles', 'error'), 'Manage Articles');
    }

    private static function slugify(string $text): string {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        return $text !== '' ? $text : 'article';
    }

    private static function slugExists(PDO $pdo, string $slug): bool {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return (int)$stmt->fetchColumn() > 0;
    }
}
