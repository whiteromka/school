<div class="data-panel" data-panel-id="additional-data">
    @include('components.profile._profile-data-head', ['name' => 'Дополнительные данные'])
    <div class="data-panel__body data-stream">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('POST')

            {{-- Данные профиля --}}
            <div class="card_ mb-4">
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthday" class="form-label">Дата рождения</label>
                                <input type="text" id="birthday" name="birthday" placeholder="2000-01-01"
                                       value="{{ old('birthday', $user->profile?->birthday?->format('Y-m-d')) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country" class="form-label">Страна</label>
                                <input type="text" id="country" name="country"
                                       value="{{ old('country', $user->profile->country) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender" class="form-label">Пол</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="">Не указано</option>
                                    <option
                                        value="male" {{ old('gender', $user->profile->gender) === 'male' ? 'selected' : '' }}>
                                        Мужской
                                    </option>
                                    <option
                                        value="female" {{ old('gender', $user->profile->gender) === 'female' ? 'selected' : '' }}>
                                        Женский
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="form-label">Город</label>
                                <input type="text" id="city" name="city" placeholder="Москва"
                                       value="{{ old('city', $user->profile->city) }}">
                            </div>
                        </div>
                        <div>
                            <br>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="industry" class="form-label">Сфера деятельности</label>
                                <input type="text" id="industry" name="industry"
                                       placeholder="Торговля, логистика"
                                       value="{{ old('industry', $user->profile->industry) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="job" class="form-label">Должность</label>
                                <input type="text" id="job" name="job" placeholder="Менеджер по развитию"
                                       value="{{ old('job', $user->profile->job) }}">
                            </div>
                        </div>
                        <div>
                            <br>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="years_experience" class="form-label">Опыт работы в IT (лет)</label>
                                <input type="text" id="years_experience" name="years_experience" placeholder="0"
                                       min="0" max="50"
                                       value="{{ old('years_experience', $user->profile->years_experience) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="github" class="form-label">GitHub</label>
                                <input type="url" id="github" name="github"
                                       value="{{ old('github', $user->profile->github) }}"
                                       placeholder="https://github.com/username">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="obout" class="form-label">О себе</label>
                                <textarea id="obout" name="obout" rows="4"
                                          placeholder="Что нам нужно знать о вас?"
                                          maxlength="1000">{{ old('obout', $user->profile->obout) }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="custom-checkbox">
                                    <input type="hidden" name="is_free_offer" value="0">
                                    <input type="checkbox" id="is_free_offer" name="is_free_offer" value="1"
                                        {{ old('is_free_offer', $user->profile->is_free_offer) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    <span class="label-text">Готов стажироваться бесплатно</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="custom-checkbox">
                                    <input type="hidden" name="is_money_offer" value="0">
                                    <input type="checkbox" id="is_money_offer" name="is_money_offer" value="1"
                                        {{ old('is_money_offer', $user->profile->is_money_offer) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    <span class="label-text">Только оплачиваемая стажировка</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn--secondary_ btn-s" id="loadMoreVacancies" data-offset="6">
                    <span class="btn__content">Сохранить</span>
                    <span class="btn__glitch"></span>
                    <span class="btn__label">xv-003</span>
                </button>
            </div>
        </form>
    </div>
</div>
