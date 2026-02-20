@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white border-gray-300 text-gray-900 focus:border-primary focus:ring-primary rounded-xl shadow-sm']) }}>