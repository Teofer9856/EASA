<div class="stat mt-8 flex ml-40">
        <div>
            <div class="stat-title">Total Sells</div>
            <div class="stat-value text-primary">{{$profits['thisMonth']}}</div>
            <div class="stat-desc">
                @if (number_format(($profits['thisMonth']/$profits['lastMonth'])-1, 2) > 0)
                    {{explode(".", number_format(($profits['thisMonth']/$profits['lastMonth'])-1, 2))[1]}}% more than last month
                @else
                    {{explode(".", number_format(($profits['thisMonth']/$profits['lastMonth'])-1, 2))[1]}}% less than last month
                @endif
            </div>
        </div>
        <div class="stat-figure text-primary">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            class="inline-block h-8 w-8 stroke-current">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
        </div>
</div>