@extends('layouts.app')
@section('title', 'Category Training Center Poliban')
@section('content')
<div class="h-[112px]">
    <x-nav/>
</div>
<section id="Category" class="w-full max-w-[1280px] mx-auto px-[52px] mt-[52px] mb-[100px]">
    <div class="flex flex-col gap-9">
        <div class="flex flex-col items-center gap-1">
            <h1 class="font-Neue-Plak-bold text-[32px] leading-[44.54px] capitalize">
                {{$category->name}} ({{$category->workshops->count()}})
            </h1>
            <div class="flex items-center gap-2 ">
                <a class="font-medium text-aktiv-grey last:font-semibold last:text-aktiv-black">Homepage</a>
                <span>></span>
                <a class="font-medium text-aktiv-grey last:font-semibold last:text-aktiv-black">Category Workshop</a>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-6">
            @forelse ($category->workshops as $itemNewWorkshop)
            <a href="{{ route('front.details', $itemNewWorkshop->slug) }}" class="card">
                <div class="flex flex-col h-full justify-between rounded-3xl p-6 gap-9 bg-white">
                    <div class="flex flex-col gap-[18px]">
                        <div class="flex item-center gap-3">
                            <div class="w-16 h-16 rounded-full flex shrink-0 overflow-hidden">
                                <img src="{{ Storage::url($itemNewWorkshop->instructor->avatar) }}" class="w-full h-full object-cover"/>
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <p class="font-semibold text-lg leading-[27px]">
                                    {{ $itemNewWorkshop->instructor->name }}
                                </p>
                                <p class="font-medium text-aktiv-grey">
                                    {{ $itemNewWorkshop->instructor->occupation }}
                                </p>
                            </div>
                        </div>
                        <div class="thumbnail-container relative h-[200px] rounded-xl bg-[#D9D9D9] overflow-hidden">
                            <img src="{{ Storage::url($itemNewWorkshop->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                            @if ($itemNewWorkshop->is_open)
                                @if ($itemNewWorkshop->has_started)<div class="absolute top-3 left-3 flex items-center rounded-full py-3 px-5 gap-1 bg-aktiv-orange text-white z-10">
                                    <img src="{{asset('assets/images/icons/timer-start.svg')}}" class="w-6 h-6" alt="icon">
                                    <span class="font-semibold">STARTED</span>
                                </div>
                                @else
                                <div class="absolute top-3 left-3 flex items-center rounded-full py-3 px-5 gap-1 bg-aktiv-green text-white z-10">
                                    <img src="{{asset('assets/images/icons/medal-star.svg')}}" class="w-6 h-6" alt="icon">
                                    <span class="font-semibold">OPEN</span>
                                </div>
                                @endif
                            @else
                            <div class="absolute top-3 left-3 flex items-center rounded-full py-3 px-5 gap-1 bg-aktiv-red text-white z-10">
                                <img src="{{asset('assets/images/icons/sand-timer.svg')}}" class="w-6 h-6" alt="icon">
                                <span class="font-semibold">CLOSED</span>
                            </div>
                            @endif
                        </div>
                        <div class="card-detail flex flex-col gap-2">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1">
                                    <img src="{{asset('assets/images/icons/calendar-2.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                    <span class="font-medium text-aktiv-grey">
                                        {{$itemNewWorkshop->started_at->format('M d Y')}}
                                    </span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <img src="{{asset('assets/images/icons/timer.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                                    <span class="font-medium text-aktiv-grey">
                                        {{$itemNewWorkshop->time_at->format('h:i A')}}
                                    </span>
                                </div>
                            </div>
                            <h3 class="title min-h-[56px] font-semibold text-xl line-clamp-2 hover:line-clamp-none">
                                {{$itemNewWorkshop->name}}
                            </h3>
                            <p class="font-medium text-aktiv-grey">
                                {{$itemNewWorkshop->category->name}}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-[6px]">
                            <p class="font-semibold text-2xl leading-8 text-aktiv-red">
                                Rp {{number_format($itemNewWorkshop->price, 0, ',', '.')}}
                            </p>
                            <p class="font-medium text-aktiv-grey">/person</p>
                        </div>
                        <img src="{{asset('assets/images/icons/arrow-right.svg')}}" class="w-12 h-12 flex shrink-0" alt="icon">
                    </div>
                </div>
            </a>
            @empty
            <p>belum ada data workshop terbaru</p>
            @endforelse
        </div>

    </div>
</section>

@endsection