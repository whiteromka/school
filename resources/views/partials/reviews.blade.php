@php
    use App\Models\Review;
    use Illuminate\Support\Collection;

    /** @var Collection|Review[] $reviews */
@endphp
@if($reviews->isEmpty())
    <h2 class="font-tektur font-w-100 ta-c">нет отзывов</h2>
@else
    <div class="reviews-list">
        @foreach($reviews as $review)
            <div class="review-item mb-3 js-cy-brackets">
                <div class="card-body_ row">
                    <div class="col-sm-12 col-md-6">
                        <h6 class="mb-0">
                            {{ $review->user->getFullNameOrEmail() }}
                            @if($review->module)
                                 <small class="grey"> | {{ $review->module->name }}</small>
                            @endif
                        </h6>
                    </div>
                    <div class="col-sm-12 col-md-6 text-md-end">
                        <span class="grey fs-13" style="padding-bottom: 10px">
                            {{ $review->created_at->format('d.m.Y') }}
                        </span>
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $review->stars)
                                <span class="cyan">*</span>
                            @else
                                <span class="dark-grey">*</span>
                            @endif
                        @endfor
                    </div>
                    <p class="mb-0">{{ $review->message }}</p>

                </div>
            </div>
        @endforeach
    </div>
@endif
