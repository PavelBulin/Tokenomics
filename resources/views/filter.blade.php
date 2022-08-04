<x-form action="{{ route('home') }}" method="get">
  <div class="row">
      <div class="col-12 col-md-4">
          <div class="mb-3">
              <x-input name="search" value="{{ request('search') }}" placeholder="{{ __('Поиск') }}" />
          </div>
      </div>
  </div>
</x-form>