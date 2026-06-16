<?php
require_once __DIR__ . '/../includes/functions.php'; ensure_default_settings($pdo); require_recruiter();
$active = city_rates_active($pdo);
$rates = $active ? $pdo->query('SELECT * FROM city_rates ORDER BY city ASC')->fetchAll() : array();
$validFrom = get_setting($pdo, 'city_rates_valid_from', '');
$validTo = get_setting($pdo, 'city_rates_valid_to', '');
$pageTitle='Ставки по городам'; $bodyClass='app-layout'; $activePage='city-rates'; $pageHeading='Ставки по городам'; require __DIR__ . '/../includes/header.php'; require __DIR__ . '/../includes/recruiter-sidebar.php';
?>
<div class="recruiter-decor-2 recruiter-cityrates-decor-2" aria-hidden="true">
    <img src="<?= e(asset_url('img/recruiter-cityrates-decor-2.webp')) ?>" alt="" loading="lazy" onerror="this.style.display='none'">
</div>

<?php if (!$active): ?><div class="alert alert-warning">Ставки временно не обновлены, используйте глобальную ставку.</div><?php endif; ?>

<!-- Period dates display -->
<div class="city-rates-dates">
    <div style="font-weight:700;color:var(--muted);font-size:14px;">Период действия ставок:</div>
    <div style="display:flex;gap:16px;align-items:center;flex-wrap:wrap;">
        <label>С <input type="date" value="<?= e($validFrom) ?>" readonly></label>
        <label>По <input type="date" value="<?= e($validTo) ?>" readonly></label>
    </div>
</div>

<section class="panel reveal"><div class="panel-heading"><h2>Городские ставки</h2></div><div class="table-wrap"><table class="data-table"><thead><tr><th>Город</th><th>Ставка на авто</th><th>Ставка пешим</th><th>Максимум на курьера</th></tr></thead><tbody><?php if (!$rates): ?><tr><td colspan="4" class="empty-cell">Используется глобальная ставка: <?= format_money(get_setting($pdo,'reward_per_order','30')) ?>.</td></tr><?php endif; ?><?php foreach ($rates as $rate): $global=(float)get_setting($pdo,'reward_per_order','30'); $auto=city_rate_value($rate,'auto',$global); $foot=city_rate_value($rate,'foot',$global); ?><tr><td><?= e($rate['city']) ?></td><td><?= format_money($auto) ?></td><td><?= format_money($foot) ?></td><td><?= $rate['max_earnings_per_courier'] === null ? 'Без лимита' : format_money($rate['max_earnings_per_courier']) ?></td></tr><?php endforeach; ?></tbody></table></div></section>
<?php require __DIR__ . '/../includes/recruiter-footer.php'; ?>
