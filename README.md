# Яндекс Еда Рекрутинг — модернизированная версия

Платформа для рекрутеров курьеров с личным кабинетом, админ-панелью, графиками, выплатами, FAQ, подтверждением почты и усиленной защитой.

## Новая структура

- `public/` — публичные страницы: `index.php`, `login.php`, `register.php`, `verify.php`, `forgot-password.php`, `reset-password.php`, `logout.php`.
- `admin/index.php` — единая админ-панель с вкладками статистики, проверки, рекрутеров, курьеров, ставок, новостей и настроек.
- `recruiter/` — кабинет рекрутера: дашборд, добавление курьера, городские ставки, FAQ, выплаты.
- `includes/` — общие функции, header/footer, сайдбары, безопасность.
- `assets/css/style.css` — весь CSS сайта.
- `assets/js/script.js` и `assets/js/admin.js` — общая логика и админские графики/таблицы.
- `assets/icons/` — будущие WebP-иконки меню.
- `uploads/news/` — изображения новостей.
- `config/mail.php` — SMTP и reCAPTCHA.

## Установка базы данных

1. Создайте базу MySQL/MariaDB.
2. Импортируйте `database.sql`.
3. Для существующей базы выполните ALTER-команды из нижней части `database.sql` или откройте сайт: `ensure_default_settings()` попытается добавить недостающие поля автоматически.
4. Проверьте настройки подключения в `includes/config.php` или задайте переменные окружения: `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`.

Новые поля и таблицы:

- `users.email_verified`, `users.email_verification_code`, `users.email_verification_expires_at`, `users.last_verification_sent_at`.
- `users.balance_correction`.
- `city_rates.max_earnings_per_courier`.
- `news.image_path`.
- `password_resets`.
- `login_attempts`.
- `balance_history`.

## Создание первого администратора

Главная страница больше не показывает форму создания администратора. Если в базе нет администратора, лендинг остаётся обычным. Первого администратора создавайте только через существующий `setup.php` — файл не изменялся.

## Настройка SMTP для support@partner-yaedalavka.ru

Откройте `config/mail.php` и заполните:

```php
return array(
    'host' => 'smtp.your-provider.ru',
    'port' => 587,
    'username' => 'support@partner-yaedalavka.ru',
    'password' => 'SMTP_PASSWORD',
    'encryption' => 'tls',
    'from_email' => 'support@partner-yaedalavka.ru',
    'from_name' => 'Поддержка партнёров Яндекс Еды',
);
```

Рекомендуемые параметры:

- порт `587` + `tls`;
- порт `465` + `ssl`, если так требует почтовый провайдер;
- логин обычно равен полному адресу `support@partner-yaedalavka.ru`;
- пароль — пароль SMTP/пароль приложения, а не пароль от панели хостинга.

Для отправки через PHPMailer установите зависимости Composer так, чтобы появился `vendor/autoload.php`. Если PHPMailer недоступен, код использует PHP `mail()` как fallback, но для production лучше PHPMailer + SMTP.

## reCAPTCHA v2 checkbox

В `config/mail.php` заполните:

- `recaptcha_site_key` — публичный ключ;
- `recaptcha_secret_key` — секретный ключ.

Если ключи пустые, проверка пропускается, чтобы локальная разработка не блокировалась.

## Основные функции

- Лендинг без упоминания создания администратора.
- Lazy loading для изображений через `loading="lazy"`, включая меню-иконки и картинки лендинга/новостей.
- Админские графики Chart.js: новые рекрутеры, новые курьеры, динамика вознаграждений за 30 дней.
- Ручная корректировка баланса рекрутера с историей в `balance_history`.
- Прямое редактирование `orders_count` у курьеров.
- Городские ставки с лимитом `max_earnings_per_courier` и глобальным периодом действия.
- Накопительное редактирование ставок: изменения сохраняются только кнопкой «Сохранить все изменения».
- Новости с изображением WebP до 2 МБ, загрузка в `uploads/news/`, миниатюра и удаление изображения.
- Подтверждение почты при регистрации 6-значным кодом.
- Восстановление пароля 6-значным кодом.
- Лимит входа: 5 неудачных попыток за 15 минут.
- CSRF-токены на формах.
- XSS-защита через `htmlspecialchars` в функции `e()`.
- Security headers: `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, базовый `Content-Security-Policy`.
- Современные карточки, hover-анимации, sticky table headers, zebra rows, мобильное burger-меню.
- Центрированный Hero-блок на главной с декоративным 3D-курьером.
- Боковая панель уведомлений (slide-out) при клике на колокольчик.
- Декоративные 3D-изображения (clay style) на всех страницах.
- Логотип «Я партнёр» в шапке.

## Декоративные 3D-изображения: список файлов и промпты

Все изображения в стиле **3D clay / low poly**, пастельные тона, полупрозрачность ~0.7, формат **WebP**.
Размещаются через CSS-класс `.decor-img` (position: absolute; opacity: 0.7; pointer-events: none; z-index: 0).
Контент имеет z-index: 1. Положение регулируется через `top/left/bottom/right` в CSS.

### Главная страница (index.php)

| Файл | Описание | Размер | Промпт |
|------|----------|--------|--------|
| `hero-courier-3d.webp` | Изометрический 3D-курьер на велосипеде, пастельные тона, low poly / clay style | 400×400 px | `3D изометрический курьер на велосипеде, мультяшный, пастельные тона, глиняная текстура, без фона, мягкое освещение, низкая детализация, игрушечный вид, 400x400, webp` |
| `index-decor-1.webp` | Абстрактная 3D-форма (мягкий куб) | 300×300 px | `3D абстрактная геометрическая фигура, пастельные тона, clay texture, прозрачный фон, мягкие тени, 300x300, webp` |
| `index-decor-2.webp` | Стилизованный пакет еды | 250×250 px | `3D иконка пакета с едой, изометрическая, пастельные тона, глина, без фона, мягкий свет, 250x250, webp` |
| `benefit-payout-icon.webp` | 3D-монета/кошелёк для карточки «Мгновенные выплаты» | 80×80 px | `3D изометрическая монета с долларом, пастельные тона, clay, 80x80, webp` |
| `benefit-stats-icon.webp` | 3D-график/диаграмма для карточки «Прозрачная статистика» | 80×80 px | `3D изометрическая диаграмма/график, пастельные тона, clay, 80x80, webp` |
| `benefit-mobile-icon.webp` | 3D-смартфон для карточки «Работа из любой точки» | 80×80 px | `3D изометрический смартфон, пастельные тона, clay, 80x80, webp` |

### Страницы рекрутера (recruiter/)

| Страница | Файл 1 | Файл 2 |
|----------|--------|--------|
| dashboard.php | `recruiter-dashboard-decor-1.webp` (280×280) | `recruiter-dashboard-decor-2.webp` (220×220) |
| city-rates.php | `recruiter-cityrates-decor-1.webp` (260×260) | `recruiter-cityrates-decor-2.webp` (200×200) |
| faq.php | `recruiter-faq-decor-1.webp` (240×240) | `recruiter-faq-decor-2.webp` (180×180) |
| withdraw.php | `recruiter-withdraw-decor-1.webp` (260×260) | `recruiter-withdraw-decor-2.webp` (200×200) |

**Промпты для рекрутера (пример для dashboard, остальные аналогично):**
- `recruiter-dashboard-decor-1.webp` — `3D clay isometric abstract shape, soft pastel yellow cream, rounded cube, transparent background, soft shadows, 280x280, webp`
- `recruiter-dashboard-decor-2.webp` — `3D clay isometric delivery bag with check mark, pastel tones, soft lighting, transparent background, 220x220, webp`

### Страницы админки (admin/)

| Страница (tab) | Файл 1 | Файл 2 |
|----------------|--------|--------|
| stats | `admin-stats-decor-1.webp` (280×280) | `admin-stats-decor-2.webp` (220×220) |
| verification | `admin-verification-decor-1.webp` (260×260) | `admin-verification-decor-2.webp` (200×200) |
| recruiters | `admin-recruiters-decor-1.webp` (260×260) | `admin-recruiters-decor-2.webp` (200×200) |
| couriers | `admin-couriers-decor-1.webp` (260×260) | `admin-couriers-decor-2.webp` (200×200) |
| city-rates | `admin-cityrates-decor-1.webp` (260×260) | `admin-cityrates-decor-2.webp` (200×200) |
| news | `admin-news-decor-1.webp` (260×260) | `admin-news-decor-2.webp` (200×200) |
| settings | `admin-settings-decor-1.webp` (260×260) | `admin-settings-decor-2.webp` (200×200) |

**Промпты для админки (пример для stats):**
- `admin-stats-decor-1.webp` — `3D clay isometric analytics chart bars, pastel yellow dark palette, premium style, transparent background, 280x280, webp`
- `admin-stats-decor-2.webp` — `3D clay isometric shield with check, verification theme, pastel tones, transparent background, 220x220, webp`

### Логотип

| Файл | Описание | Размер | Промпт |
|------|----------|--------|--------|
| `logo-partner.webp` | Логотип «Я партнер» в стиле 3D clay, буквы объёмные, пастельные тона | 150×50 px | `3D текст "Я партнер", мягкие пастельные тона, глиняная текстура, объёмные буквы, прозрачный фон, 150x50, webp` |

### Иконки меню (существующие, в assets/icons/)

1. `dashboard-icon.webp` — `3D isometric clay icon, analytics dashboard with yellow chart, soft rounded shapes, non photorealistic, transparent background, 64x64`
2. `couriers-icon.webp` — `3D isometric clay icon, friendly courier backpack and scooter, yellow black accents, non photorealistic, transparent background, 64x64`
3. `city-rates-icon.webp` — `3D isometric clay icon, city map pin with coin, warm yellow palette, non photorealistic, transparent background, 64x64`
4. `faq-icon.webp` — `3D isometric clay icon, question mark speech bubble, soft yellow and cream, non photorealistic, transparent background, 64x64`
5. `withdraw-icon.webp` — `3D isometric clay icon, wallet with ruble coin, yellow black details, non photorealistic, transparent background, 64x64`
6. `support-icon.webp` — `3D isometric clay icon, Telegram paper plane and headset, yellow accent, non photorealistic, transparent background, 64x64`
7. `admin-stats-icon.webp` — `3D isometric clay icon, admin statistics bars and line chart, premium yellow dark palette, transparent background, 64x64`
8. `admin-recruiters-icon.webp` — `3D isometric clay icon, group of recruiters people avatars, friendly rounded style, transparent background, 64x64`
9. `admin-news-icon.webp` — `3D isometric clay icon, newspaper card with image placeholder, yellow badge, transparent background, 64x64`
10. `admin-verification-icon.webp` — `3D isometric clay icon, shield with check mark, secure verification, yellow and dark accents, transparent background, 64x64`
11. `settings-icon.webp` — `3D isometric clay icon, gear and sliders, warm yellow black cream palette, transparent background, 64x64`
12. `add-courier-icon.webp` — `3D isometric clay icon, user plus sign and delivery bag, non photorealistic, transparent background, 64x64`

## Инструкция по корректировке положения декоративных изображений

Все декоративные изображения используют CSS-класс `.decor-img`:
```css
.decor-img {
  position: absolute;
  opacity: 0.7;
  pointer-events: none;
  z-index: 0;
}
```

Конкретное положение задаётся через дополнительные классы (например, `.recruiter-dashboard-decor-1`):
```css
.recruiter-dashboard-decor-1 {
  width: 280px;
  height: 280px;
  top: 20px;
  right: 20px;
}
```

**Как изменить положение:**
1. Найдите соответствующий класс в `assets/css/style.css` (секция «Recruiter pages decorative images» или «Admin pages decor»).
2. Измените значения `top`, `left`, `bottom`, `right` по необходимости.
3. Можно также изменить `width` и `height`.
4. На мобильных (<900px) декоративные изображения скрыты через `@media(max-width:900px) { .recruiter-decor-1, .recruiter-decor-2, .admin-decor-1, .admin-decor-2 { display: none; } }`.

## Какие ненужные файлы удалить из репозитория GitHub

После переноса структуры можно удалить устаревшие дубликаты, если они не используются вашим хостингом как entrypoint:

- `style.css` — перенесён в `assets/css/style.css`.
- `script.js` — перенесён в `assets/js/script.js`.
- `public/style.css` — больше не используется.
- `public/script.js` — больше не используется.
- Корневые дубликаты страниц `index.php`, `login.php`, `register.php`, `logout.php`, `dashboard.php`, `admin.php`, `courier-signup.php`, `functions.php`, если они не являются специальными прокси/алиасами хостинга.

Перед удалением корневых PHP-дубликатов проверьте маршрутизацию на хостинге. Основные рабочие файлы теперь находятся в `public/`, `admin/`, `recruiter/`, `includes/`, `assets/`, `config/`.
