<div class="container">
    <section class="section" id="services">
        <div class="section-header">
            <div class="section-label">Learning process</div>
            <h2 class="section-title">Что нужно для обучения</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>
        @php
            $data = [
                ['en' => 'Confident PC user','ru' => 'Уверенное владение ПК',
                'descr' => 'Мы ожидаем от студентов хороший уверенный уровень владения ПК'
                ],
                ['en' => 'Equipment','ru' => 'Оборудование',
                    'descr' => 'Вам понадобится компьютер или ноутбук на windows/linux, так же микрофон для общения'
                ],
                ['en' => 'Involvement','ru' => 'Вовлечённость',
                 'descr' => 'Обучение - это диалог. Ждём активного участия: вопросы, обсуждения, домашние задания. Чем больше вы вкладываете, тем быстрее растёте'
                ],
            ];
        @endphp

        <div class="services-grid">
            @foreach($data as $item)
            <div class="service-card">
                <div class="service-index">
                    <div class="left fs-20">{{ $item['en'] }}</div>
                </div>
                <div class="service-name">{{ $item['ru'] }}</div>
                <p class="service-desc">
                    {{ $item['descr']  }}
                </p>
            </div>
            @endforeach
        </div>

        <div style="height: 80px"></div>
        <div class="section-header">
            <div class="section-label">Learning process</div>
            <h2 class="section-title">Как учим</h2>
            <div class="section-divider" aria-hidden="true"></div>
        </div>

        @php
        $data2 = [
            ['en' => 'Live classes','ru' => 'Живые занятия',
            'descr' => 'Увидите как рассуждает реальный программист. Задавайте вопросы сразу, работайте вместе с менторами'
            ],
            ['en' => 'Practice & Homework','ru' => 'Практика и ДЗ',
            'descr' => 'Теория сразу закрепляется на задачах. От основ до техник, которые используют в индустрии прямо сейчас'
            ],
            ['en' => 'Building projects','ru' => 'Пишем проекты',
            'descr' => 'Каждый модуль завершается полноценным проектом. К концу модуля у вас будет готовый и проект в портфолио'
            ]
        ];
        @endphp

        <div class="services-grid">
            @foreach($data2 as $item)
                <div class="service-card">
                    <div class="service-index">
                        <div class="left fs-20">{{ $item['en']  }}</div>
                    </div>
                    <div class="service-name">{{ $item['ru']  }}</div>
                    <p class="service-desc">
                        {{ $item['descr']  }}
                    </p>
                </div>
            @endforeach
        </div>
    </section>
</div>
