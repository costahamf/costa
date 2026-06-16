<?php
require_once __DIR__ . '/../includes/functions.php';
ensure_default_settings($pdo);
$pageTitle = 'Партнёрская платформа для рекрутеров';
$bodyClass = 'landing-page';
require __DIR__ . '/../includes/header.php';
?>
<header class="landing-header">
    <a class="brand" href="index.php"><span class="brand-mark">Я</span>Партнёр</a>
    <nav><a href="#benefits">Преимущества</a><a href="#process">Процесс</a><a href="login.php">Войти</a><a class="button small" href="register.php">Стать партнёром</a></nav>
</header>
<main class="landing-main">
    <section class="hero-section reveal">
        <div class="hero-decor" aria-hidden="true">
            <img class="decor-img decor-hero-courier" src="<?= e(asset_url('img/hero-courier-3d.webp')) ?>" alt="" loading="lazy" onerror="this.style.display='none'">
        </div>
        <div class="hero-content">
            <p class="eyebrow">Партнёрская сеть Яндекс Еды</p>
            <h1>Привлекайте курьеров в Яндекс Еду и зарабатывайте</h1>
            <p>Вы получаете вознаграждение за каждого активного курьера. Прозрачная статистика, быстрые выплаты</p>
            <div class="hero-actions">
                <a class="button" href="register.php">Начать зарабатывать</a>
                <a class="button button-outline" href="login.php">Войти</a>
            </div>
        </div>
    </section>
    <section id="benefits" class="section-block reveal">
        <div class="section-heading centered">
            <p class="eyebrow">Преимущества</p>
            <h2>Инструменты, которые экономят время рекрутера</h2>
        </div>
        <div class="benefits-grid">
            <article class="benefit-card">
                <div class="benefit-icon-wrap">
                    <img class="benefit-icon-img" src="<?= e(asset_url('img/benefit-payout-icon.webp')) ?>" alt="" loading="lazy" onerror="this.style.display='none'">
                </div>
                <h3>Мгновенные выплаты</h3>
                <p>Доход считается по активным курьерам, городским ставкам и одобренным выплатам. Выводите средства когда удобно.</p>
            </article>
            <article class="benefit-card">
                <div class="benefit-icon-wrap">
                    <img class="benefit-icon-img" src="<?= e(asset_url('img/benefit-stats-icon.webp')) ?>" alt="" loading="lazy" onerror="this.style.display='none'">
                </div>
                <h3>Прозрачная статистика</h3>
                <p>Все ключевые показатели под рукой: курьеры, заказы, ставка города, доступный баланс и история выплат.</p>
            </article>
            <article class="benefit-card">
                <div class="benefit-icon-wrap">
                    <img class="benefit-icon-img" src="<?= e(asset_url('img/benefit-mobile-icon.webp')) ?>" alt="" loading="lazy" onerror="this.style.display='none'">
                </div>
                <h3>Работа из любой точки</h3>
                <p>Удобный мобильный интерфейс кабинета позволяет управлять рекрутингом с телефона или планшета.</p>
            </article>
        </div>
        <div class="decor-img decor-benefits-1" aria-hidden="true">
            <img src="<?= e(asset_url('img/index-decor-1.webp')) ?>" alt="" loading="lazy" onerror="this.style.display='none'">
        </div>
        <div class="decor-img decor-benefits-2" aria-hidden="true">
            <img src="<?= e(asset_url('img/index-decor-2.webp')) ?>" alt="" loading="lazy" onerror="this.style.display='none'">
        </div>
    </section>
    <section id="process" class="section-block process-section reveal">
        <div class="section-heading centered">
            <p class="eyebrow">Как это работает</p>
            <h2>Три шага до стабильной воронки</h2>
        </div>
        <div class="process-grid">
            <article class="process-card"><span>01</span><h3>Регистрируетесь</h3><p>Подтверждаете email и получаете персональную реферальную ссылку.</p></article>
            <article class="process-card"><span>02</span><h3>Приглашаете курьеров</h3><p>Кандидаты попадают в систему, а администратор подтверждает их статус.</p></article>
            <article class="process-card"><span>03</span><h3>Получаете выплаты</h3><p>Отправляете заявку на вывод, когда баланс достигает минимальной суммы.</p></article>
        </div>
    </section>
    <section class="section-block reveal">
        <div class="split-card">
            <div>
                <p class="eyebrow">Аналитика</p>
                <h2>Все ключевые показатели под рукой</h2>
                <p>Курьеры, заказы, ставка города, доступный баланс и история выплат собраны в единой панели с аккуратным мобильным интерфейсом.</p>
            </div>
            <img src="<?= e(asset_url('img/analytics.webp')) ?>" alt="Аналитика" loading="lazy" onerror="this.style.display='none'">
        </div>
    </section>
    <section class="section-block faq-section reveal">
        <div class="section-heading centered">
            <p class="eyebrow">FAQ</p>
            <h2>Частые вопросы</h2>
        </div>
        <div class="faq-accordion">
            <details class="faq-item">
                <summary class="faq-question">Когда можно запросить выплату?</summary>
                <div class="faq-answer"><p>После достижения минимальной суммы, указанной в настройках платформы.</p></div>
            </details>
            <details class="faq-item">
                <summary class="faq-question">Как курьер привязывается к рекрутеру?</summary>
                <div class="faq-answer"><p>Через персональную ссылку или ручное добавление в личном кабинете рекрутера.</p></div>
            </details>
        </div>
    </section>
</main>
<footer class="site-footer"><p>© <?= date('Y') ?> Яндекс Еда Рекрутинг. Все права защищены.</p><a href="mailto:support@partner-yaedalavka.ru">support@partner-yaedalavka.ru</a></footer>
<?php require __DIR__ . '/../includes/footer.php'; ?>
