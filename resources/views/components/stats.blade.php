<div class="stats w-full mt-8">
    <div class="stat place-items-center">
        <div class="stat-title text-xl">Products</div>
        <div class="stat-value text-4xl">{{ $stats[0] }}</div>
        <div class="stat-desc text-base">{{ date('M d', strtotime('-1 month')) }} - {{ date('M d') }}</div>
    </div>

    <div class="stat place-items-center">
        <div class="stat-title text-xl">New Clients</div>
        <div class="stat-value text-success text-4xl">{{ $stats[1] }}</div>
        <div class="stat-desc text-success text-base">Month</div>
    </div>

    <div class="stat place-items-center">
        <div class="stat-title text-xl">Top Product</div>
        <div class="stat-value">{{ number_format($stats[2], 0, ',', '.') }}€</div>
        <div class="stat-desc text-base">Over all</div>
    </div>
</div>
