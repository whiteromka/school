<?php

namespace App\Services\HH;

use App\Models\Setting;
use App\Models\Vacancy;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Http;

class HHParserService implements HHInterface
{
    private string $xsrftoken = '284b54011cfa342518eeec849b51800f';
    private string $cookie = 'hhuid=R!_xkzFm5ZbYgWYH5HE8BQ--; __ddg2_=75d82SMYgZt4Ninh; hhtoken=FnXPCg9qNRT!Z2z8ulOhgmg7ecSO; tmr_lvid=93b0bfdd05330c31ea0504015e5fda8c; tmr_lvidTS=1711793266711; _ym_uid=1711793267855666928; __ddgid_=4LMSYzeXY1259LHv; _ym_d=1767805511; __ddg1_=DsIzFVYN63f1oQJstivK; _xsrf=284b54011cfa342518eeec849b51800f; crypted_hhuid=2B0CCDB7D2A0B948E3EC9C12E454D7FC61B59640B3363FCF1B71DCC79AFD0C50; hhul=b8772dea8b09d6511357bf76553e3f036043fdefbed79e83e5d107238f8cf669; GMT=3; redirect_host=hh.ru; region_clarified=hh.ru; uxs_uid=e35ed630-ee7d-11ee-8d40-af8d9726c8a3; display=desktop; _ibc=False; iap.uid=cd1ce9f882eb46b780754db775c0b853; cookie_policy_agreement=true; TZ=Europe%2FMoscow; HOSTILE_ON=0; hhrole=applicant; _hi=21401866; crypted_id=4BE4AD54CE6926347654C7F1A4392898A5471C6F722104504734B32F0D03E9F8; __ddg9_=198.244.179.151; _ym_isad=1; _ym_visorc=b; __zzatgib-w-hh=MDA0dC0jViV+FmELHw4/aQsbSl1pCENQGC9LX3RePG0laEkTJUMPUgotGxkxdCoNO0BdQXZ1eCs9ah9gOVURCxIXRF5cVWl1FRpLSiVueCplJS0xViR8SylEXFR/KiIYeW8lVgkTVy8NPjteLW8PJwsSWAkhCklpC15zXV8WPkQhbAs4LBtFOA8teB1keEdXa1lLRHdsKlg4PF1ucykwLEAhUGd4WiVIEU40Kx4Yem8rVjgQXUFydHQbN1ddHBEkWA4hPwsXXFU+NVQOPHVXLw0uOF4tbx5mTl8kTFxPfScgE35nFRtQSxgvS18zWn4lDzRDS1sKFA4/VFFCQisVWVJ1KW59OjAbRVcfYEtZIEtbU2shC1E0NWYQSk9NRzM4P2h9HlQcOVURDxYSNhcjEn5yKVQQEl1BQ3R1MTdXYTAPFhFNRxU9VlJPQyhrG3FYMA==lJFILg==; device_magritte_breakpoint=s; device_breakpoint=s; gsscgib-w-hh=61oZOLMmZBKDGk9m8QRnjLB/JZjf1FjhDlKh9D3XkQ6f2GcFLPkzR8XDCXahOE9UIHF0+3VruhYOJD5dk51iZ1e7ou88QAGhfg3+Rn5MrgnDRfsvZc4MvjeVj99RtlncG5FmGytwspwB6IYvoAAqn/1+BDtO4BQl9+9vAnpuulXYBNMWL6upKgDc4WwfCGfaVgQXCAeYtOudG7UcEkzTkaNAGgYwstMAZzbGHONKS3u7Wcx42s6gyi8b2OAQ1aNNwll2WT8I; cfidsgib-w-hh=WEV/FBxeXTlfyteBWVF0Pf33W7eNwP5bJcrKD56s88Rk5D9plNWIBo1n1Sc5zguqatBQOBgx7P+dueU/NIJ7JtVYnHl6arD6xPwofUtXnukeJHHPJNNBE4FDs5+io4dgUTQkm/b0kgCX8gxiDFWlFCLpbzgDTS6chtG7t22a; cfidsgib-w-hh=WEV/FBxeXTlfyteBWVF0Pf33W7eNwP5bJcrKD56s88Rk5D9plNWIBo1n1Sc5zguqatBQOBgx7P+dueU/NIJ7JtVYnHl6arD6xPwofUtXnukeJHHPJNNBE4FDs5+io4dgUTQkm/b0kgCX8gxiDFWlFCLpbzgDTS6chtG7t22a; gsscgib-w-hh=61oZOLMmZBKDGk9m8QRnjLB/JZjf1FjhDlKh9D3XkQ6f2GcFLPkzR8XDCXahOE9UIHF0+3VruhYOJD5dk51iZ1e7ou88QAGhfg3+Rn5MrgnDRfsvZc4MvjeVj99RtlncG5FmGytwspwB6IYvoAAqn/1+BDtO4BQl9+9vAnpuulXYBNMWL6upKgDc4WwfCGfaVgQXCAeYtOudG7UcEkzTkaNAGgYwstMAZzbGHONKS3u7Wcx42s6gyi8b2OAQ1aNNwll2WT8I; regions=1; __ddg8_=mokNeREmU6zOm7uP; __ddg10_=1776597879; fgsscgib-w-hh=ugGV6cc4371b6ca3f9ff35722be467c8721b4856';

    private function tryGetXsrfToken()
    {
        $value = Setting::query()
            ->where('name', 'xsrftoken')
            ->value('value');

        return $value ?? $this->xsrftoken;
    }

    private function tryGetCookies()
    {
        $value = Setting::query()
            ->where('name', 'cookie')
            ->value('value');

        return $value ?? $this->cookie;
    }

    /**
     * Получить вакансии с hh.ru распарсить и сохранить в БД
     */
    public function fetchVacancies(string $type = 'PHP'): void
    {
        $xsrfToken = $this->tryGetXsrfToken();
        $cookie = $this->tryGetCookies();

        $textSearch = $type == 'PHP' ? 'Php программист' : 'JavaScript программист';
        $url = 'https://hh.ru/shards/vacancy/search';
        try {
            $response = Http::withHeaders([
                'accept' => 'application/json',
                'accept-language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
                'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'x-requested-with' => 'XMLHttpRequest',
                'referer' => 'https://hh.ru/search/vacancy',
                'x-xsrftoken' => $xsrfToken,
                'cookie' => $cookie,
            ])->get($url, [
                'enable_snippets' => 'true',
                'ored_clusters' => 'true',
                'search_field' => 'name',
                'search_period' => 7,
                'search_session_id' => 'f57af1cb-0fa7-46e2-91c8-0c5c42cd31fa',
                'text' => $textSearch,
            ]);
        } catch (Exception $e) {
            logger()->error('FetchVacancies failed', [
                'error' => $e->getMessage(),
            ]);
            //dd($e);
        }

        $res = $response->json();
        if ($response->status() === 200) {
            if (!empty($res['vacancySearchResult']['vacancies'])) {
               foreach ($res['vacancySearchResult']['vacancies'] as $vacancy) {
                   $this->parseVacancy($vacancy, $type);
               }
            }
        }
    }

    /**
     * @param array $vacancy
     * @param string $type
     * @return void
     */
    private function parseVacancy(array $vacancy, string $type = 'PHP'): void
    {
        try {
            Vacancy::query()->updateOrCreate(
                [
                    'hh_id' => $vacancy['vacancyId'],
                ],
                [
                    'type' => $type,
                    'name' => $vacancy['name'] ?? null,

                    // Локация
                    'area_id' => $vacancy['area']['@id'] ?? null,
                    'area_name' => $vacancy['area']['name'] ?? null,

                    // Зарплата
                    'salary_from' => $vacancy['compensation']['from'] ?? null,
                    'salary_to' => $vacancy['compensation']['to'] ?? null,
                    'salary_currency' => $vacancy['compensation']['currencyCode'] ?? null,
                    'salary_gross' => $vacancy['compensation']['gross'] ?? null,

                    // Описание
                    'requirement' => $this->cleanText($vacancy['snippet']['req'] ?? null),
                    'responsibility' => $this->cleanText($vacancy['snippet']['resp'] ?? null),

                    // Опыт
                    'experience' => $vacancy['workExperience'] ?? null,

                    // Тип занятости
                    'employment_name' => $vacancy['employment']['@type'] ?? null,

                    // Дата публикации
                    'published_at' => isset($vacancy['publicationTime']['$'])
                        ? Carbon::parse($vacancy['publicationTime']['$'])
                        : null,

                    // URL
                    'url' => $vacancy['links']['desktop'] ?? null,

                    // Отклики
                    'responses_count' => $vacancy['responsesCount'] ?? null,

                    // Скиллы (парсим строку в массив)
                    'key_skills' => isset($vacancy['snippet']['skill'])
                        ? $this->skills($vacancy['snippet']['skill'])
                        : [],
                ]
            );
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return; // пропускаем и берем на обработку следующую вакансию
            }

            logger()->error('Vacancy parse failed', [
                'hh_id' => $vacancy['vacancyId'] ?? null,
                'error' => $e->getMessage(),
            ]);

            dd($e);
        }
    }

    private function cleanText(?string $text): ?string
    {
        if (!$text) {
            return null;
        }
        return str_replace(['<highlighttext>', '</highlighttext>'], '', $text);
    }

    private function skills(string $skills): array
    {
        return array_map('trim', explode(',', $skills));
    }
}


//  $res => array:17 [▼
//    "searchClustersOrder" => array:18 [▶]
//    "searchCatalog" => null
//    "searchClusters" => array:18 [▶]
//    "searchCounts" => array:5 [▶]
//    "searchMixingNeighbours" => null
//    "searchRequestId" => "1776596597826a9151ee530205c73025"
//    "vacancySearchResult" => array:21 [▼
//      "savedSearches" => array:6 [▶]
//      "criteria" => array:65 [▶]
//      "totalUsedFilters" => 2
//      "vacancies" => array:50 [▼ // тут список вакансий

// это одна вакансия
// array:55 [▼ // app/Services/HhService.php:82
//  "@workSchedule" => "remote"
//  "@showContact" => false
//  "@responseLetterRequired" => false
//  "vacancyId" => 132093817
//  "name" => "PHP Developer"
//  "company" => array:12 [▼
//    "@showSimilarVacancies" => true
//    "@trusted" => true
//    "@category" => "COMPANY"
//    "@countryId" => 4
//    "@state" => "APPROVED"
//    "id" => 1011638
//    "name" => "ДжазТим"
//    "visibleName" => "ДжазТим"
//    "logos" => array:2 [▼
//      "logo" => array:6 [▼
//        0 => array:2 [▼
//          "@type" => "ORIGINAL"
//          "@url" => "/employer-logo-original-round/684571.jpeg"
//        ]
//        1 => array:2 [▼
//          "@type" => "employerPage"
//          "@url" => "/employer-logo-round/684571.jpeg"
//        ]
//        2 => array:2 [▶]
//        3 => array:2 [▶]
//        4 => array:2 [▶]
//        5 => array:2 [▶]
//      ]
//      "@showInSearch" => true
//    ]
//    "employerOrganizationFormId" => 0
//    "companySiteUrl" => "http://джазцім.бел"
//    "accreditedITEmployer" => false
//  ]
//  "compensation" => array:5 [▼
//    "from" => 140000
//    "currencyCode" => "RUR"
//    "gross" => false
//    "perModeFrom" => 140000
//    "mode" => "MONTH"
//  ]
//  "publicationTime" => array:2 [▼
//    "@timestamp" => 1776091997
//    "$" => "2026-04-13T17:53:17.218+03:00"
//  ]
//  "area" => array:3 [▼
//    "@id" => 1002
//    "name" => "Минск"
//    "path" => ".16.1002."
//  ]
//  "acceptTemporary" => false
//  "address" => array:12 [▼
//    "@id" => 229343
//    "@disabled" => false
//    "@wrong" => false
//    "rawAddress" => ""
//    "metroStations" => array:3 [▶]
//    "city" => "Минск"
//    "street" => "улица Платонова"
//    "building" => "43"
//    "displayName" => "Минск, улица Платонова, 43"
//    "mapData" => "{"points":{"center":{"lat":53.91237795619425,"lng":27.59770100936296,"zoom":16},"marker":{"lat":53.912378,"lng":27.597701}},"manualMetro":false}"
//    "marker" => array:2 [▼
//      "@lat" => 53.912378
//      "@lng" => 27.597701
//    ]
//    "manager" => array:1 [▼
//      "@id" => 1217612
//    ]
//  ]
//  "creationSite" => "rabota.by"
//  "creationSiteId" => 17
//  "displayHost" => "hh.ru"
//  "lastChangeTime" => array:2 [▼
//    "@timestamp" => 1776097755
//    "$" => "2026-04-13T19:29:15.733+03:00"
//  ]
//  "creationTime" => "2026-04-13T17:53:17.218+03:00"
//  "canBeShared" => true
//  "employerManager" => array:1 [▼
//    "latestActivity" => "offline"
//  ]
//  "inboxPossibility" => true
//  "chatWritePossibility" => "ENABLED_AFTER_INVITATION"
//  "notify" => false
//  "links" => array:2 [▼
//    "desktop" => "https://hh.ru/vacancy/132093817"
//    "mobile" => "https://m.hh.ru/vacancy/132093817"
//  ]
//  "acceptIncompleteResumes" => false
//  "driverLicenseTypes" => array:1 [▼
//    0 => []
//  ]
//  "languages" => array:1 [▶]
//  "workingDays" => array:1 [▼
//    0 => []
//  ]
//  "workingTimeIntervals" => array:1 [▶]
//  "workingTimeModes" => array:1 [▶]
//  "vacancyProperties" => array:2 [▶]
//  "vacancyPlatforms" => array:1 [▶]
//  "professionalRoleIds" => array:1 [▶]
//  "workExperience" => "between3And6"
//  "employment" => array:1 [▼
//    "@type" => "PROJECT"
//  ]
//  "closedForApplicants" => false
//  "userTestPresent" => false
//  "employmentForm" => "SIDE_JOB"
//  "flyInFlyOutDurations" => array:1 [▼
//    0 => []
//  ]
//  "internship" => false
//  "nightShifts" => false
//  "workFormats" => array:1 [▼
//    0 => array:1 [▼
//      "workFormatsElement" => array:1 [▼
//        0 => "REMOTE"
//      ]
//    ]
//  ]
//  "workScheduleByDays" => array:1 [▼
//    0 => array:1 [▼
//      "workScheduleByDaysElement" => array:1 [▼
//        0 => "FLEXIBLE"
//      ]
//    ]
//  ]
//  "workingHours" => array:1 [▼
//    0 => array:1 [▼
//      "workingHoursElement" => array:1 [▼
//        0 => "FLEXIBLE"
//      ]
//    ]
//  ]
//  "experimentalModes" => array:1 [▼
//    0 => array:1 [▼
//      "experimentalMode" => array:2 [▼
//        0 => "newEmploymentTerms"
//        1 => "newCompensationModes"
//      ]
//    ]
//  ]
//  "acceptLaborContract" => false
//  "civilLawContracts" => array:1 [▼
//    0 => []
//  ]
//  "autoResponse" => array:1 [▼
//    "acceptAutoResponse" => false
//  ]
//  "contactInfo" => null
//  "userLabels" => []
//  "snippet" => array:5 [▼
//    "req" => "2+ лет коммерческого опыта разработки - Java / PHP. Уровень английского не ниже Intermediate. PHP. GIT. MySql."
//    "resp" => "Платформа - это гибкая система для автоматизации работы компаний: CRM, управление проектами, документооборот, финансы, отчётность и многое другое в едином веб.. ▶"
//    "cond" => null
//    "skill" => "Английский язык, PHP, Git, Java, MySQL"
//    "desc" => null
//  ]
//  "responsesCount" => 456
//  "totalResponsesCount" => 538 // сколько откликнулось
//  "online_users_count" => 5
//  "show_question_input" => true
//  "allowChatWithManager" => false
//  "searchRid" => "1776596817377d4165bd391bd55ac025"

