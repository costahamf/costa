<?php
require_once __DIR__ . '/sidebar.php';
$activePage = isset($activePage) ? $activePage : '';
$unreadCount = is_logged_in() ? unread_notifications_count($pdo, current_user_id()) : 0;
$notifications = is_logged_in() ? latest_notifications($pdo, current_user_id()) : array();
$supportUrl = get_setting($pdo, 'support_bot_url', 'https://t.me/ваш_бот');
?>
<aside class="app-sidebar" id="appSidebar" data-sidebar>
    <div class="sidebar-brand-row">
        <a class="brand" href="<?= e(recruiter_url('dashboard.php')) ?>"><span class="brand-mark">Я</span><span>Партнёр</span></a>
        <button class="sidebar-close" type="button" data-sidebar-close aria-label="Закрыть меню"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <nav class="sidebar-nav" aria-label="Навигация рекрутера">
        <a class="<?= $activePage === 'dashboard' ? 'active' : '' ?>" href="<?= e(recruiter_url('dashboard.php')) ?>"><i class="fa-solid fa-chart-line menu-icon-fa"></i><span>Дашборд</span></a>
        <a class="<?= $activePage === 'add-courier' ? 'active' : '' ?>" href="<?= e(recruiter_url('add-courier.php')) ?>"><i class="fa-solid fa-user-plus menu-icon-fa"></i><span>Добавить курьера</span></a>
        <a class="<?= $activePage === 'withdraw' ? 'active' : '' ?>" href="<?= e(recruiter_url('withdraw.php')) ?>"><i class="fa-solid fa-wallet menu-icon-fa"></i><span>Выплаты</span></a>
        <a class="<?= $activePage === 'city-rates' ? 'active' : '' ?>" href="<?= e(recruiter_url('city-rates.php')) ?>"><i class="fa-solid fa-location-dot menu-icon-fa"></i><span>Ставки</span></a>
        <a class="<?= $activePage === 'faq' ? 'active' : '' ?>" href="<?= e(recruiter_url('faq.php')) ?>"><i class="fa-solid fa-circle-question menu-icon-fa"></i><span>FAQ</span></a>
        <a href="<?= e($supportUrl) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-telegram menu-icon-fa"></i><span>Тех.поддержка</span></a>
    </nav>
    <div class="notifications-widget">
        <button class="notification-toggle" type="button" data-notifications-sidebar-toggle>
            <i class="fa-solid fa-bell"></i> Уведомления <?php if ($unreadCount): ?><b><?= (int)$unreadCount ?></b><?php endif; ?>
        </button>
    </div>
    <div class="sidebar-footer"><a class="button button-outline button-full" href="<?= e(url_for('logout.php')) ?>">Выйти</a></div>
</aside>
<div class="sidebar-backdrop" data-sidebar-backdrop></div>

<!-- Notifications Sidebar (slide-out from right) -->
<aside class="notifications-sidebar" data-notifications-sidebar aria-label="Уведомления">
    <div class="notifications-sidebar-header">
        <h3>Уведомления</h3>
        <button class="notifications-sidebar-close" type="button" data-notifications-sidebar-close aria-label="Закрыть"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="notifications-sidebar-body" data-notifications-sidebar-body>
        <?php if (!$notifications): ?>
            <div class="notifications-sidebar-empty">Новых уведомлений нет.</div>
        <?php else: ?>
            <?php foreach ($notifications as $note): ?>
                <article class="<?= $note['is_read'] ? '' : 'unread' ?>">
                    <h4><?= e($note['title']) ?></h4>
                    <?php if (!empty($note['image_path'])): ?><img class="notification-news-image" src="<?= e(upload_url($note['image_path'])) ?>" alt="" loading="lazy"><?php endif; ?>
                    <p><?= e($note['message']) ?></p>
                    <time><?= e(date('d.m.Y H:i', strtotime($note['created_at']))) ?></time>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</aside>
<div class="notifications-sidebar-overlay" data-notifications-sidebar-overlay></div>

<header class="mobile-topbar">
    <button class="icon-button" type="button" data-sidebar-toggle aria-label="Открыть меню"><i class="fa-solid fa-bars"></i></button>
    <a class="brand" href="<?= e(recruiter_url('dashboard.php')) ?>"><span class="brand-mark">Я</span><span>Партнёр</span></a>
    <a class="button small" href="<?= e(url_for('logout.php')) ?>">Выйти</a>
</header>
<div class="app-content">
    <div class="content-topline"><div><p class="eyebrow">Личный кабинет</p><h1><?= e($pageHeading) ?></h1></div><span class="user-chip"><?= e($_SESSION['email']) ?></span></div>
