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
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-0">{{ $review->user->name ?? 'Аноним' }}</h6>
                            @if($review->module)
                                <small class="text-muted">{{ $review->module->name }}</small>
                            @endif
                        </div>
                        <div class="text-warning">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $review->stars)
                                    <i class="bi bi-star-fill"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p class="card-text mb-0">{{ $review->message }}</p>
                    <small class="text-muted">{{ $review->created_at->format('d.m.Y H:i') }}</small>
                </div>
            </div>
        @endforeach
    </div>
@endif
