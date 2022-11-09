@if ($message = Session::get('success'))
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8" data-alert="success">
        <x-alert.success :message="$message" />
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8" data-alert="danger">
        <x-alert.danger :message="$message" />
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8" data-alert="warning">>
        <x-alert.warning :message="$message" />
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8" data-alert="info">
        <x-alert.info :message="$message" />
    </div>
@endif
