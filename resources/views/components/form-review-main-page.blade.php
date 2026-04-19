<div id="review-app" class="review-form-container">

    <div v-if="success" class="alert alert-success alert-dismissible fade show">
        Отзыв успешно добавлен.
        <button type="button" class="btn-close" @click="success = false"></button>
    </div>

    <form @submit.prevent="submitForm" class="contact-form">

        <div class="form-group">
            <label>Module</label>
            <select v-model="form.modules_id"
                    class="form-control"
                    :class="{ 'is-invalid': errors.modules_id }">

                <option value="">Модуль</option>
                <option v-for="(name, id) in modules" :key="id" :value="id">
                    @{{ name }}
                </option>
            </select>

            <div v-if="errors.modules_id" class="invalid-feedback" style="display:block;">
                @{{ errors.modules_id[0] }}
            </div>
        </div>

        <div class="form-group">
            <label>Stars</label>
            <select v-model="form.stars"
                    class="form-control"
                    :class="{ 'is-invalid': errors.stars }">

                <option value="">Оценка</option>
                <option v-for="i in 5" :key="i" :value="i">@{{ i }}</option>
            </select>

            <div v-if="errors.stars" class="invalid-feedback" style="display:block;">
                @{{ errors.stars[0] }}
            </div>
        </div>

        <div class="form-group">
            <label>Message</label>
            <textarea v-model="form.message"
                      class="form-control"
                      rows="5"
                      :class="{ 'is-invalid': errors.message }"></textarea>

            <div v-if="errors.message" class="invalid-feedback" style="display:block;">
                @{{ errors.message[0] }}
            </div>
        </div>

        <div v-if="errors.auth" class="invalid-feedback" style="display:block; margin-bottom:10px;">
            @{{ errors.auth[0] }}
        </div>

        <div class="d-flex align-items-center justify-content-end">
            @guest
            <div class="sign-error js-cy-brackets" data-color="red" data-context="Требуется авторизация">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22">
                    <path fill="red" d="M256 0c14.7 0 28.2 8.1 35.2 21l216 400c6.7 12.4 6.4 27.4-.8 39.5S486.1 480 472 480L40 480c-14.1 0-27.2-7.4-34.4-19.5s-7.5-27.1-.8-39.5l216-400c7-12.9 20.5-21 35.2-21zm0 352a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0-192c-18.2 0-32.7 15.5-31.4 33.7l7.4 104c.9 12.5 11.4 22.3 23.9 22.3 12.6 0 23-9.7 23.9-22.3l7.4-104c1.3-18.2-13.1-33.7-31.4-33.7z"></path>
                </svg>
                <i>auth</i>
            </div>
            @endguest
            <button type="submit" class="btn btn-s" :disabled="loading">
                <span class="btn__content">
                    @{{ loading ? 'Отправка...' : 'Отправить' }}
                </span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </button>
        </div>

{{--        <div class="d-flex align-items-center justify-content-end">--}}
{{--            @guest--}}
{{--                <div class="sign-error js-cy-brackets" data-color="red" data-context="Требуется авторизация">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22">--}}
{{--                        <path fill="red" d="M256 0c14.7 0 28.2 8.1 35.2 21l216 400c6.7 12.4 6.4 27.4-.8 39.5S486.1 480 472 480L40 480c-14.1 0-27.2-7.4-34.4-19.5s-7.5-27.1-.8-39.5l216-400c7-12.9 20.5-21 35.2-21zm0 352a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0-192c-18.2 0-32.7 15.5-31.4 33.7l7.4 104c.9 12.5 11.4 22.3 23.9 22.3 12.6 0 23-9.7 23.9-22.3l7.4-104c1.3-18.2-13.1-33.7-31.4-33.7z"></path>--}}
{{--                    </svg>--}}
{{--                    <i>auth</i>--}}
{{--                </div>--}}
{{--                <button type="submit" id="review-submit-btn" class="btn btn-s" disabled>--}}
{{--                    <span class="btn__content">Отправить</span>--}}
{{--                    <span class="btn__glitch"></span>--}}
{{--                    <span class="btn__label">r25</span>--}}
{{--                </button>--}}
{{--            @else--}}
{{--                <button type="submit" id="review-submit-btn" class="btn btn-s">--}}
{{--                    <span class="btn__content">Отправить</span>--}}
{{--                    <span class="btn__glitch"></span>--}}
{{--                    <span class="btn__label">r25</span>--}}
{{--                </button>--}}
{{--            @endguest--}}
{{--        </div>--}}
    </form>
</div>

<!-- Vue CDN -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                modules: {}, // грузим с API
                form: {
                    modules_id: '',
                    stars: '',
                    message: ''
                },
                errors: {},
                success: false,
                loading: false,
                modulesLoading: false
            }
        },

        async mounted() {
            await this.loadModules();
        },

        methods: {

            async loadModules() {
                this.modulesLoading = true;

                try {
                    const response = await fetch('/review/user-modules', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.status === 401) {
                        this.errors = data.errors || {
                            auth: ['Требуется авторизация']
                        };
                        return;
                    }

                    if (!response.ok) {
                        throw new Error('Ошибка загрузки модулей');
                    }

                    this.modules = data.data;

                } catch (e) {
                    console.error(e);
                } finally {
                    this.modulesLoading = false;
                }
            },

            async submitForm() {
                this.loading = true;
                this.errors = {};
                this.success = false;

                try {
                    const response = await fetch('/review/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify(this.form)
                    });

                    const data = await response.json();

                    if ([422, 401].includes(response.status)) {
                        this.errors = data.errors;
                        return;
                    }

                    if (!response.ok) {
                        throw new Error('Server error');
                    }

                    this.success = true;

                    this.form = {
                        modules_id: '',
                        stars: '',
                        message: ''
                    };

                } catch (e) {
                    console.error(e);
                } finally {
                    this.loading = false;
                }
            }
        }
    }).mount('#review-app');
</script>
