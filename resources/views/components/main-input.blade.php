<div class="flex flex-col gap-3">
	<label for="{{ $id }}">
		{!! $label !!}
		@if ($required ?? '' ?? '')
			<span class="text-red-500">*</span>
		@endif
	</label>
	<input type="{{ $type ?? 'text' }}" id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" class="custom-input" autocomplete="off" {{ $required ?? '' ? 'required' : '' }}>
	@error($name)
		<p class="text-red-500 text-sm mt-1">{{ $message }}*</p>
	@enderror
</div>
