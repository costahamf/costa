-- Adds separate city reward rates for auto and foot couriers and stores news images on notifications.
ALTER TABLE city_rates ADD COLUMN reward_auto INT UNSIGNED NOT NULL DEFAULT 0;
ALTER TABLE city_rates ADD COLUMN reward_foot INT UNSIGNED NOT NULL DEFAULT 0;
UPDATE city_rates SET reward_auto = reward_per_order WHERE reward_auto = 0 AND reward_per_order > 0;
UPDATE city_rates SET reward_foot = reward_per_order WHERE reward_foot = 0 AND reward_per_order > 0;
ALTER TABLE notifications ADD COLUMN image_path VARCHAR(255) NULL DEFAULT NULL;
