<?php

class HomeController {
    public static function index(): void {
        render_view('home/index', [], 'Home');
    }
}
