<div class="stats w-full mt-9 overflow-hidden">
    <div class="stat place-items-center w-full hidden md:block">
        <div class="stat-title text-2xl 2xl:text-lg">Products</div>
        <div class="stat-value text-5xl 2xl:text-3xl">{{ $stats[0] }}</div>
        <div class="stat-desc text-lg 2xl:text-base">{{ date('M d', strtotime('-1 month')) }} - {{ date('M d') }}</div>
    </div>

    <div class="stat place-items-center w-full">
        <div class="stat-title text-xl sm:text-2xl 2xl:text-lg">New Clients</div>
        <div class="stat-value text-success text-4xl sm:text-5xl 2xl:text-3xl">{{ $stats[1] }}</div>
        <div class="stat-desc text-success text-lg 2xl:text-base">Month</div>
    </div>

    <div class="stat place-items-center w-full">
        <div class="stat-title text-xl sm:text-2xl 2xl:text-lg">Top Product</div>
        <div class="stat-value text-primary text-4xl sm:text-5xl 2xl:text-3xl">{{ number_format($stats[2], 0, ',', '.') }}€</div>
        <div class="stat-desc text-lg 2xl:text-base">Over all</div>
    </div>
</div>
