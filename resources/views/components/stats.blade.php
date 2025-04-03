<div class="stats w-full mt-8">
    <div class="stat place-items-center">
        <div class="stat-title">Products</div>
        <div class="stat-value">{{ $stats[0] }}</div>
        <div class="stat-desc">{{ date('M d', strtotime('-1 month')) }} - {{ date('M d') }}</div>
    </div>

    <div class="stat place-items-center">
        <div class="stat-title">New Clients</div>
        <div class="stat-value text-secondary">{{ $stats[1] }}</div>
        <div class="stat-desc text-secondary">Today</div>
    </div>

    <div class="stat place-items-center">
        <div class="stat-title">Top Product</div>
        <div class="stat-value">{{ $stats[2] }}$</div>
        <div class="stat-desc">All</div>
    </div>
</div>
