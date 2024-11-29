<section class="service-single-area pt-120 pb-120">
	<div class="container">
		<div class="row g-4">
			<div class="col-lg-8 order-2 order-lg-1">
				<div class="service-single__left-item">
					<div class="image mb-50">
						<img src="{{ asset($content->service_video_cover->value) }}" alt="image">
						<div class="service-single__video-btn">
							<div class="video-btn video-pulse wow fadeIn" data-wow-delay="200ms"
							     data-wow-duration="1500ms">
								<a class="video-popup" href="{{ $content->video_link->value }}"><i
										class="fa-solid fa-play"></i></a>
							</div>
						</div>
					</div>
					<h3 class="title mb-30">{{ $content->heading->value }}</h3>
					<p class="mb-30">{{ $content->summary->value }}</p>

					{!! $content->content->value !!}
				</div>
			</div>
			<div class="col-lg-4 order-1 order-lg-2">
				<div class="service-single__right-item">
					<div class="item sub-bg mb-30">
						<h4 class="mb-20">{{ __('All Services') }}</h4>
						<ul class="category service-category light-area">
							@foreach(\App\Models\ComponentContent::where('component_id', $componentId)->select('id', 'content')->get() as $item)
								@php
									$itemContent = _tr($item->content, false);
                                    
                                    $url = route('content.details', ['section' => $section, 'id' => $item->id]);
								@endphp
								<li class="@if($url == request()->url()) active @endif">
									<a href="{{ $url }}">{{ $itemContent->heading->value }}</a>
									<i class="fa-regular fa-arrow-right-long primary-color"></i>
								</li>
							@endforeach
						
						</ul>
					</div>
					<div class="item sub-bg mb-30">
						<h4 class="mb-20">{{ __('Opening Hours') }}</h4>
						<ul class="category">
							<li class="secondary-color justify-content-start gap-3">
								<x-svg i="clock" />
								{{ $content->full_open_time->value }}
							</li>
							<li class="secondary-color justify-content-start gap-3">
								<x-svg i="clock" />
								{{ $content->half_open_time->value }}
							</li>
							<li class="secondary-color justify-content-start gap-3">
								<x-svg i="clock" />
								{{ $content->closed_time->value }}
							</li>
							<li class="secondary-color justify-content-start gap-3">
								<x-svg i="clock" />
								{{ $content->service->value }}
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>