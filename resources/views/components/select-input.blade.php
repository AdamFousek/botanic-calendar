@props(['options' => [], 'empty' => false])

<select {!! $attributes->merge(['class' => 'mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 inline-block p-2.5 w-56']) !!}>
    @if($empty)<option value>{{ __('Select value') }}</option> @endif
    @foreach($options as $key => $sort)
        <option value="{{ $key }}">{{ __($sort) }}</option>
    @endforeach
</select>