-- Migration: add tenant scoping (owner_admin_id / admin_id)
-- Safe order: add columns as NULL, backfill, then add FK + NOT NULL.

-- 1) Add nullable columns
ALTER TABLE users ADD COLUMN owner_admin_id BIGINT UNSIGNED NULL AFTER id;
ALTER TABLE rooms ADD COLUMN owner_admin_id BIGINT UNSIGNED NULL AFTER id;
ALTER TABLE bookings ADD COLUMN admin_id BIGINT UNSIGNED NULL AFTER id;

-- 2) Set owner_admin_id for existing admins to themselves
UPDATE users SET owner_admin_id = id WHERE role = 'admin' AND owner_admin_id IS NULL;

-- 3) Assign existing data to an admin
-- Replace 1 with the correct admin id
UPDATE rooms SET owner_admin_id = 1 WHERE owner_admin_id IS NULL;
UPDATE users SET owner_admin_id = 1 WHERE role = 'user' AND owner_admin_id IS NULL;
UPDATE bookings SET admin_id = 1 WHERE admin_id IS NULL;

-- 4) Add indexes + foreign keys
ALTER TABLE users
  ADD KEY idx_users_owner (owner_admin_id),
  ADD CONSTRAINT fk_users_owner_admin FOREIGN KEY (owner_admin_id) REFERENCES users(id)
    ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE rooms
  ADD KEY idx_rooms_owner (owner_admin_id),
  ADD CONSTRAINT fk_rooms_owner_admin FOREIGN KEY (owner_admin_id) REFERENCES users(id)
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE bookings
  ADD KEY idx_bookings_admin (admin_id),
  ADD CONSTRAINT fk_bookings_admin FOREIGN KEY (admin_id) REFERENCES users(id)
    ON DELETE CASCADE ON UPDATE CASCADE;

-- 5) Enforce NOT NULL after backfill
ALTER TABLE rooms MODIFY owner_admin_id BIGINT UNSIGNED NOT NULL;
ALTER TABLE bookings MODIFY admin_id BIGINT UNSIGNED NOT NULL;
