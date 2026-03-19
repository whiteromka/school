@php
    use Illuminate\Support\Collection;

    /** @var Collection $reviews */
@endphp
<div>
    @if($reviews->isEmpty())
        <h2 class="font-tektur font-w-100 ta-c">нет отзывов</h2>
    @else
        <div class="reviews-list">
            @foreach($reviews as $review)
                <div class="review-item-wrap mb-3 js-cy-brackets_">

                    <div class="review-item">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <h6 class="mb-0" style="color: #00ccff">
                                    {{ $review['user_name'] }}
                                    @if($review['module_name'])
                                        <small class="grey"> | {{ $review['module_name'] }}</small>
                                    @endif
                                </h6>
                            </div>
                            <div class="col-sm-12 col-md-6 text-md-end">
                            <span class="grey fs-13" style="padding-bottom: 10px">
                                {{ $review['created_at'] }}
                            </span>
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $review['stars'])
                                        <span class="cyan">*</span>
                                    @else
                                        <span class="dark-grey">*</span>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="mb-0" style="padding: 12px 12px">{{ $review['message'] }}</p>

                    <div class="cy-brackets-tl" style="border-color: orange; width: 6px; height: 6px;"></div>
                    <div class="cy-brackets-tr" style="border-color: orange; width: 6px; height: 6px;"></div>
                    <div class="cy-brackets-bl" style="border-color: orange; width: 6px; height: 6px;"></div>
                    <div class="cy-brackets-br" style="border-color: orange; width: 6px; height: 6px;"></div>
                </div>
            @endforeach
        </div>

        @if($hasMore)

            <div class="col-12 px-1 d-flex justify-content-end">
                <button class="btn btn-s btn--secondary" wire:click="loadMore">
                    <span class="btn__content">Еще отзывы</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">r25</span>
                </button>
            </div>
        @endif
    @endif
</div>
