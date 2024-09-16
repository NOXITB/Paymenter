<div class="bg-primary-800 p-6 rounded-lg mt-2">
    <div class="flex flex-col md:flex-row justify-between">
        <h1 class="text-2xl font-semibold text-white">{{ __('services.services') }}</h1>
    </div>
    <div class="w-full overflow-x-auto">

    <table class="w-full border-spacing-y-2 border-separate">
        <thead>
            <tr>
                <th class="text-left pl-2">{{ __('services.name') }}</th>
                <th class="text-left">{{ __('services.price') }}</th>
                <th class="text-left">{{ __('services.status') }}</th>
                <th class="text-left">{{ __('services.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr class="bg-primary-700 text-white">
                    <td class="p-2 rounded-l-md">{{ $service->product->name }} - {{ $service->plan->name }}</td>
                    <td>{{ $service->formattedPrice }}</td>
                    <td>
                        <span
                            class="font-semibold p-1 px-1.5 border rounded-md @if ($service->status == 'active') bg-green-800 border-green-600 text-green-500 @elseif($service->status == 'cancelled') bg-red-900 border-red-600 text-red-300  @else bg-yellow-800 border-yellow-600 text-yellow-200 @endif">
                            {{ ucfirst($service->status) }}
                        </span>
                    </td>
                    <td class="p-1 rounded-r-md">
                        <a href="{{ route('services.show', $service) }}" wire:navigate>
                            <x-button.primary class="h-fit !w-fit">
                                {{ __('services.view') }}
                            </x-button.primary>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $services->links() }}

</div>
