@php
    /** @var User $user */
    use App\Models\Review;use App\Models\User;
@endphp

<div class="data-panel" data-panel-id="reviews">
    @include('components.profile._profile-data-head', ['name' => 'Ваши отзывы'])
    <div class="data-panel__body data-stream">
        <h1>Отзывы</h1>
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Отзыв</th>
                <th scope="col">Оценка</th>
                <th scope="col">Статус</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @php
                $number = 1;
            @endphp
            @foreach($user->reviews as $review)
                <tr id="jsReview-{{ $review->id }}" class="{{ $review->status === Review::STATUS_REJECTED ? 'table-danger' : '' }}">
                    <th scope="row"> {{ $review->id  }} </th>
                    <td class="js-review-message">{{ $review->message }}</td>
                    <td class="js-review-stars">{{ $review->stars }}</td>
                    <td>{{ $review->getRuStatus() }}</td>
                    <td>
                        @if($review->status !== Review::STATUS_APPROVED)
                        <a href="#" title="Редактировать" aria-label="Редактировать" data-review-id="{{ $review->id }}" class="js-btn-edit" data-bs-toggle="modal" data-bs-target="#editReview">
                            <svg
                                 style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="grey"
                                      d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path>
                            </svg>
                        </a>
                        <a href="#" title="Удалить" aria-label="Удалить" data-review-id="{{ $review->id }}" class="js-btn-delete"
                                onclick="return confirm('Удалить отзыв?')">
                            <svg
                                 style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="grey"
                                      d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path>
                            </svg>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--modal window--}}
<div class="modal fade" id="editReview" tabindex="-1" aria-labelledby="editReview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editReviewLabel">Редактировать отзыв</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="js-review-form" class="contact-form" method="POST">
                    @csrf

                    <input value="" name="id" id="reviewId" hidden>

                    <div class="form-group">
                        <label for="stars">Stars</label>
                        <select id="stars" name="stars" class="form-control">
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <div class="js-review-stars-error" style="color: red;"></div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" class="form-control" rows="5">{{ $oldInput['message'] ?? '' }}</textarea>
                    </div>
                    <div class="js-review-message-error" style="color: red;"></div>

                    <div class="d-flex align-items-center justify-content-end">
                        <button type="submit" id="review-submit-btn" class="btn btn-s js-review-update-btn">
                            <span class="btn__content">Обновить</span>
                            <span class="btn__glitch"></span>
                            <span class="btn__label">r25</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // удаляем отзыв
        document.querySelectorAll(".js-btn-delete").forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                let reviewId = btn.dataset.reviewId;
                async function sendData() {
                    try {
                        const response = await fetch(`/review/delete-review/${reviewId}`);
                        if (!response.ok) {
                            console.log(`HTTP error! status: ${response.status}`);
                        }
                        const result = await response.json();
                        if (result.success) {
                            document.getElementById("jsReview-" + reviewId).remove();
                        }
                    } catch (error) {
                        console.error('Ошибка fetch:', error);
                    }
                }
                sendData();
            });
        });

        // тянем данные с сервера, подставляем данные в модальное окно
        document.querySelectorAll(".js-btn-edit").forEach(btn => {
            btn.addEventListener("click", () => {
                let reviewId = btn.dataset.reviewId;
                async function receiveReviewData() {
                    try {
                        const response = await fetch(`/review/get-by-id/${reviewId}`);
                        if (!response.ok) {
                            console.log(`HTTP error! status: ${response.status}`);
                        }
                        const result = await response.json();
                        if (result.success) {
                            let review = result.review;
                            document.getElementById("reviewId").value = result.review.id;
                            document.getElementById('message').value = review.message;
                            let starsEl = document.getElementById('stars');
                            let optionElems = starsEl.querySelectorAll("option");
                            optionElems.forEach(option => {
                                if (option.value === String(review.stars)) {
                                    option.selected = true;
                                }
                            })
                        }
                    } catch (error) {
                        console.error('Ошибка fetch:', error);
                    }
                }
                receiveReviewData();
            });
        });

        // отправляем данные для обновления, получаем ответ, подставляем в таблицу
        document.querySelector(".js-review-update-btn").addEventListener("click", (e) => {
            e.preventDefault();
            const formData = new FormData(document.getElementById("js-review-form"));

            async function update() {
                const response = await fetch('/review/update', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    body: formData
                });

                if (!response.ok) {
                    if (response.status === 422) {
                        let errors = await response.json();
                        const errorMessage = errors.errors?.message?.[0] ?? null;
                        const starsError = errors.errors?.stars?.[0] ?? null;
                        document.querySelector(".js-review-message-error").textContent = errorMessage;
                        document.querySelector(".js-review-stars-error").textContent = starsError;
                    }
                    throw new Error(`Ошибка сервера: ${response.status}`);
                }

                const data = await response.json();
                if (data.success) {
                    let row = document.getElementById("jsReview-" + data.review.id);
                    row.querySelector(".js-review-message").textContent = data.review.message;
                    row.querySelector(".js-review-stars").textContent = data.review.stars;

                    document.querySelector(".js-review-message-error").textContent = "";
                    document.querySelector(".js-review-stars-error").textContent = "";

                    document.querySelector(".btn-close").click();
                }
            }
            update();
        });
    </script>
@endpush
