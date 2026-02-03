-- Migration: add articles table
CREATE TABLE IF NOT EXISTS articles (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(220) NOT NULL,
  category VARCHAR(80) NULL,
  excerpt VARCHAR(300) NULL,
  content TEXT NULL,
  cover_url VARCHAR(255) NULL,
  author VARCHAR(120) NULL,
  published_at DATETIME NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_articles_slug (slug),
  KEY idx_articles_published (published_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
