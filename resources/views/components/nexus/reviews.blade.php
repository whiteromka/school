<div class="container section">
    <div class="row">
        <div class="col-md-6">
            <div class="section-header">
                <div class="section-label">Reviews</div>
                <h2 class="section-title">Отзывы</h2>
                <div class="section-divider" aria-hidden="true"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <p class="grey">
                Друзья мы не хотим вводить вас в заблуждение и не станем сами себе писать тут фейковые хвалебные отзывы о нашей работе.
                Мы никого не обманываем! Тут отображаются настоящие отзывы которые вы пишите о нашей деятельности, конструктивная критика приветствуется.
            </p>
            <br><br><br><br>
            <h2 class="font-tektur font-w-100 ta-c">нет отзывов</h2>
        </div>
        <div class="col-md-4">

            <div class="review-form-container" id="review-form-container">
                @include('partials.review-form', ['activeModules' => $activeModules, 'captcha' => $captcha])
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('review-form-container');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            // Обработчик отправки формы (делегирование событий)
            container.addEventListener('submit', async function(e) {
                e.preventDefault();

                const form = e.target;
                const submitBtn = form.querySelector('#review-submit-btn');
                const btnContent = submitBtn?.querySelector('.btn__content');
                if (!submitBtn || submitBtn.disabled) return;

                // Блокировка кнопки
                submitBtn.disabled = true;
                if (btnContent) {
                    btnContent.textContent = 'Отправка...';
                }

                // Сбор данных формы
                const formData = new FormData(form);

                try {
                    const response = await fetch('/review/store', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'text/html'
                        }
                    });

                    const html = await response.text();
                    container.innerHTML = html;

                } catch (error) {
                    console.error('Error submitting review:', error);
                }
            });

            // Обработчик обновления капчи (делегирование)
            container.addEventListener('click', function(e) {
                if (e.target.closest('#refresh-captcha')) {
                    e.preventDefault();
                    const btn = e.target.closest('#refresh-captcha');
                    btn.disabled = true;
                    btn.style.opacity = '0.5';

                    fetch('/review/refresh-captcha', {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            const captchaGroup = document.getElementById('captcha-group');
                            if (captchaGroup) {
                                captchaGroup.innerHTML = html;
                            }
                            // Очищаем поле ввода капчи
                            const captchaInput = document.getElementById('captcha');
                            if (captchaInput) {
                                captchaInput.value = '';
                                captchaInput.classList.remove('is-invalid');
                            }
                        })
                        .catch(error => {
                            console.error('Error refreshing captcha:', error);
                        })
                        .finally(() => {
                            btn.disabled = false;
                            btn.style.opacity = '1';
                        });
                }
            });

            // Очистка ошибок при вводе
            container.addEventListener('input', function(e) {
                const target = e.target;
                if (target.tagName === 'SELECT' || target.tagName === 'TEXTAREA') {
                    target.classList.remove('is-invalid');
                    const errorEl = target.parentElement.querySelector('.invalid-feedback');
                    if (errorEl) {
                        errorEl.style.display = 'none';
                    }
                }
                // Очищаем ошибку капчи при вводе
                if (target.id === 'captcha') {
                    target.classList.remove('is-invalid');
                    const errorEl = document.querySelector('#captcha-group .invalid-feedback');
                    if (errorEl) {
                        errorEl.style.display = 'none';
                    }
                }
            });
        });
    </script>
@endpush
