<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="section-header">
                <div class="section-label">Reviews</div>
                <h2 class="section-title">
                    <span class="js-glitch" data-text="Отзывы">Отзывы</span>
                </h2>
                <div class="section-divider" aria-hidden="true"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="grey fs-p-small">
                Друзья мы не хотим вводить вас в заблуждение и не станем сами себе писать тут фейковые хвалебные отзывы о нашей работе.
                Мы никого не обманываем! Тут отображаются настоящие отзывы которые вы пишите о нашей деятельности, конструктивная критика приветствуется.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div>
                @livewire('reviews')
            </div>
        </div>

        <div class="col-md-4">
            <div class="review-form-container" id="review-form-container">
                @include('components.form-review-main-page')
{{--                @include('partials.review-form', [--}}
{{--                    'activeModules' => $activeModules,--}}
{{--                    'errors' => $emptyErrorBag,--}}
{{--                    'oldInput' => [],--}}
{{--                    'success' => false,--}}
{{--                    'captcha' => $captcha--}}
{{--                ])--}}

            </div>
        </div>
    </div>
</div>
