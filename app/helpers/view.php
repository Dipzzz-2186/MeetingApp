<?php
require_once __DIR__ . '/layout.php';

function render_view(string $view, array $data = [], string $title = '', string $body_class = ''): void {
    extract($data, EXTR_SKIP);
    render_header($title, $body_class);
    require __DIR__ . '/../views/' . $view . '.php';
    render_footer();
}
