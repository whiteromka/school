@php
    /** @var User $user */
    use App\Models\User;
@endphp

<div class="data-panel" data-panel-id="reviews">
    @include('components.profile._profile-data-head', ['name' => 'Ваши отзывы'])
    <div class="data-panel__body data-stream">
        <div id="reviews-app" v-cloak>
            <div class="table-responsive">
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
                    <tr v-for="review in reviews" :key="review.id"
                        :class="{ 'table-danger-row': review.status !== 'new' }">
                        <th scope="row">@{{ review.id }}</th>

                        <td>
                            <template v-if="editingId === review.id">
                                <textarea
                                    v-model="editMessage"
                                    class="form-control"
                                    rows="3"
                                ></textarea>
                                <div class="text-danger mt-1" v-if="errors.message" v-for="(msg, i) in errors.message" :key="'msg-'+i">
                                    @{{ msg }}
                                </div>
                            </template>
                            <template v-else>
                                @{{ review.message }}
                            </template>
                        </td>

                        <td>
                            <template v-if="editingId === review.id">
                                <select v-model="editStars" class="form-control">
                                    <option v-for="n in 5" :value="n" :key="n">@{{ n }}</option>
                                </select>
                                <div class="text-danger mt-1" v-if="errors.stars" v-for="(msg, i) in errors.stars" :key="'stars-'+i">
                                    @{{ msg }}
                                </div>
                            </template>
                            <template v-else>
                                @{{ review.stars }}
                            </template>
                        </td>

                        <td>@{{ formatStatus(review.status) }}</td>

                        <td>
                            <template v-if="review.status === 'new'">
                                <template v-if="editingId === review.id">
                                    <button
                                        class="btn-ico btn-ico-green"
                                        @click="saveReview(review)"
                                        :disabled="loading"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M64 80c-8.8 0-16 7.2-16 16l0 320c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-242.7c0-4.2-1.7-8.3-4.7-11.3L320 86.6 320 176c0 17.7-14.3 32-32 32l-160 0c-17.7 0-32-14.3-32-32l0-96-32 0zm80 0l0 80 128 0 0-80-128 0zM0 96C0 60.7 28.7 32 64 32l242.7 0c17 0 33.3 6.7 45.3 18.7L429.3 128c12 12 18.7 28.3 18.7 45.3L448 416c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM160 320a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/></svg>
                                    </button>
                                    <button
                                        class="btn-ico btn-ico-grey"
                                        @click="cancelEditing()"
                                        :disabled="loading"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M367.2 412.5L99.5 144.8c-22.4 31.4-35.5 69.8-35.5 111.2 0 106 86 192 192 192 41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3c22.4-31.4 35.5-69.8 35.5-111.2 0-106-86-192-192-192-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0 256 256 0 1 1 -512 0z"/></svg>
                                    </button>
                                </template>
                                <template v-else>
                                    <button
                                        class="btn-ico btn-ico-yellow"
                                        @click="startEditing(review)"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/></svg>
                                    </button>
                                    <button
                                        class="btn-ico btn-ico-red" style="width: 27px"
                                        @click="deleteReview(review)"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M166.2-16c-13.3 0-25.3 8.3-30 20.8L120 48 24 48C10.7 48 0 58.7 0 72S10.7 96 24 96l400 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-96 0-16.2-43.2C307.1-7.7 295.2-16 281.8-16L166.2-16zM32 144l0 304c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-304-48 0 0 304c0 8.8-7.2 16-16 16L96 464c-8.8 0-16-7.2-16-16l0-304-48 0zm160 72c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 176c0 13.3 10.7 24 24 24s24-10.7 24-24l0-176zm112 0c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 176c0 13.3 10.7 24 24 24s24-10.7 24-24l0-176z"/></svg>
                                    </button>
                                </template>
                            </template>
                        </td>
                    </tr>

                    <tr v-if="reviews.length === 0">
                        <td colspan="5" class="text-center text-muted">Отзывов пока нет</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

@push('scripts')
<script>
    const { createApp } = Vue;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    createApp({
        data() {
            return {
                reviews: [],
                csrfToken: csrfToken,

                // Отзыв
                editingId: null,
                editMessage: '',
                editStars: 1,
                errors: {},
                loading: false
            };
        },

        methods: {
            async loadReviews() {
                try {
                    const response = await fetch('/review/list');
                    if (response.ok) {
                        const data = await response.json();
                        this.reviews = data.reviews || [];
                    }
                } catch (error) {
                    console.error('Ошибка загрузки:', error);
                }
            },

            startEditing(review) {
                this.editingId = review.id;
                this.editMessage = review.message;
                this.editStars = review.stars;
                this.errors = {};
            },

            cancelEditing() {
                this.editingId = null;
                this.errors = {};
            },

            async saveReview(review) {
                this.loading = true;
                this.errors = {};

                const formData = new FormData();
                formData.append('id', review.id);
                formData.append('message', this.editMessage);
                formData.append('stars', this.editStars);
                formData.append('_token', this.csrfToken);

                try {
                    const response = await fetch('/review/update', {
                        method: 'POST',
                        headers: { 'Accept': 'application/json' },
                        body: formData
                    });

                    if (!response.ok) {
                        if (response.status === 422) {
                            const data = await response.json();
                            this.errors = data.errors || {};
                        } else if (response.status === 403) {
                            const data = await response.json();
                            alert(data.error || 'Ошибка сервера');
                        }
                        this.loading = false;
                        return;
                    }

                    const data = await response.json();

                    if (data.success) {
                        const idx = this.reviews.findIndex(r => r.id === data.review.id);
                        if (idx !== -1) {
                            this.reviews[idx] = data.review;
                        }
                        this.editingId = null;
                        this.errors = {};
                    }
                } catch (error) {
                    console.error('Ошибка сохранения:', error);
                } finally {
                    this.loading = false;
                }
            },

            async deleteReview(review) {
                if (!confirm('Удалить отзыв?')) {
                    return;
                }

                try {
                    const formData = new FormData();
                    formData.append('_token', this.csrfToken);

                    const response = await fetch(`/review/delete-review/${review.id}`, {
                        method: 'POST',
                        headers: { 'Accept': 'application/json' },
                        body: formData
                    });
                    if (!response.ok) {
                        console.log(`HTTP error! status: ${response.status}`);
                        return;
                    }
                    const data = await response.json();
                    if (data.success) {
                        this.reviews = this.reviews.filter(r => r.id !== review.id);
                    }
                } catch (error) {
                    console.error('Ошибка удаления:', error);
                }
            },

            formatStatus(status) {
                const map = {
                    'new': 'Новый',
                    'approved': 'Одобрен',
                    'rejected': 'Отклонен'
                };
                return map[status] || status;
            }
        },

        mounted() {
            this.loadReviews();
        }
    }).mount('#reviews-app');
</script>
@endpush
