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
            <button type="submit" class="btn btn-s" :disabled="loading">
                <span class="btn__content">
                    @{{ loading ? 'Отправка...' : 'Отправить' }}
                </span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </button>
        </div>
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
