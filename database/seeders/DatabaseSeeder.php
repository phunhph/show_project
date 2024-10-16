<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\domains;
use App\Models\level;
use App\Models\technicals;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('technicals')->insert([[
            'name' => 'PHP',
        ],[
            'name' => 'RUBY',
        ],[
            'name' => 'GOLANG',
        ],[
            'name' => 'JAVA',
        ],[
            'name' => 'Javascript',
        ],[
            'name' => 'C#',
        ]]);

        DB::table('domains')->insert([[
            'name' => 'marketing',
            'is_active' => 0
        ],[
            'name' => 'Công nghệ thông tin',
            'is_active' => 0
        ],[
            'name' => 'Thiết kế đồ họa',
            'is_active' => 0
        ],[
            'name' => 'Chăm sóc sắc đẹp',
            'is_active' => 0
        ]]);

        DB::table('levels')->insert([[
            'name' => 'Cấp 1',
            'description' => 'Mô tả cấp độ',
        ],[
            'name' => 'Cấp 2',
            'description' => 'Mô tả cấp độ',
        ],[
            'name' => 'Cấp 3',
            'description' => 'Mô tả cấp độ',
        ],[
            'name' => 'Cấp 4',
            'description' => 'Mô tả cấp độ',
        ]]);


        DB::table('settings')->insert([
            [
            'key' => 'business_logo_1',
            'title' => 'Ảnh logo doanh nghiệp 1',
            'content' => 'https://demo.exptheme.com/serenite/wp-content/uploads/2022/08/img-client5.png',
            'type' => 1,
                'created_at' => Carbon::now()
        ],
            [
                'key' => 'business_logo_2',
                'title' => 'Ảnh logo doanh nghiệp 2',
                'content' => 'https://demo.exptheme.com/serenite/wp-content/uploads/2022/08/img-client6.png',
                'type' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'key' => 'business_logo_3',
                'title' => 'Ảnh logo doanh nghiệp 3',
                'content' => 'https://demo.exptheme.com/serenite/wp-content/uploads/2022/08/img-client1.png',
                'type' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'key' => 'business_logo_4',
                'title' => 'Ảnh logo doanh nghiệp 4',
                'content' => 'https://demo.exptheme.com/serenite/wp-content/uploads/2022/08/img-client2.png',
                'type' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'key' => 'business_logo_5',
                'title' => 'Ảnh logo doanh nghiệp 5',
                'content' => 'https://demo.exptheme.com/serenite/wp-content/uploads/2022/08/img-client3.png',
                'type' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'business_logo_6',
                'title' => 'Ảnh logo doanh nghiệp 6',
                'content' => 'https://demo.exptheme.com/serenite/wp-content/uploads/2022/08/img-client4.png',
                'type' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'content_business',
                'title' => 'Nội dung content',
                'content' => '<div class="section-title text-start mb-4"><span>Planning on Developing a Product</span>
                            <h2 class="wow">Popular Features that your <strong>Business Needs</strong></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                                accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor
                                sit amet, consectetur adipiscing.</p>
                        </div>
                        <ul class="list-unstyled icons-listing theme-primary mb-4 w-half check">
                            <li>Intregrations</li>
                            <li>Business Strategy</li>
                            <li>Business Setup</li>
                            <li>Easy Documentation</li>
                        </ul>',
                        'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'business_image',
                'title' => 'Ảnh Nội dung content',
                'content' => 'https://demo.exptheme.com/serenite/wp-content/uploads/2022/08/tabbing_img-1.png',
                'type' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'title_question_case',
                'title' => 'Tiêu đề Everything You Need To Know To Work Better',
                'content' => '<h2 class="wow">Everything you need to <strong>Know to work better</strong></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                                accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor
                                sit amet, consectetur adipiscing.</p>',
                                'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'question_case_1',
                'title' => 'Câu hỏi và trả lời<< Phải có keyword "Question" và "Answer" để phân biệt',
                'content' => 'Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.
                            Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.',
                            'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'question_case_2',
                'title' => 'Câu hỏi và trả lời<< Phải có keyword "Question" và "Answer" để phân biệt',
                'content' => 'Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.
                            Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.',
                            'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'question_case_3',
                'title' => 'Câu hỏi và trả lời<< Phải có keyword "Question" và "Answer" để phân biệt',
                'content' => 'Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.
                            Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.',
                            'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'question_case_4',
                'title' => 'Câu hỏi và trả lời<< Phải có keyword "Question" và "Answer" để phân biệt',
                'content' => 'Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.
                            Question: First and foremost, you never want to go?
                            Answer: Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna lectus, mattis non
                            accumsan in, tempor dictum neque. In hac habitasse platea dictumst. Lorem ipsum dolor sit
                            amet, consectetur adipiscing.',
                            'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'title_our_team',
                'title' => 'Tiêu đề our team',
                'content' => "Our Buddy's Always Ready
    <strong>To Solve Your Issues</strong>",
    'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'des_our_team',
                'title' => 'mô tả our team',
                'content' => "  <p>
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. In urna lectus, mattis non
                                accumsan in, tempor dictum neque. In hac
                                habitasse platea dictumst. Lorem ipsum dolor
                                sit amet, consectetur adipiscing.
                            </p>",
                            'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'title_project',
                'title' => 'Tiêu đề Project',
                'content' => "Our Buddy's Always Ready
    <strong>To Solve Your Issues</strong>",
    'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'des_project',
                'title' => 'Mô tả project',
                'content' => "  <p>
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. In urna lectus, mattis non
                                accumsan in, tempor dictum neque. In hac
                                habitasse platea dictumst. Lorem ipsum dolor
                                sit amet, consectetur adipiscing.
                            </p>",
                            'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'footer_1',
                'title' => 'Cột footer số 1',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                    urna lectus, mattis non accumsan in, tempor dictum neque.',
                'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'footer_2',
                'title' => 'Cột footer số 2',
                'content' => '<li><a href="javascript:">About</a></li>
                                    <li><a href="javascript:">Contact Us</a></li>
                                    <li><a href="javascript:">Blog</a></li>
                                    <li><a href="javascript:">Culture</a></li>
                                    <li><a href="javascript:">Jobs</a></li>',
                'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'footer_3',
                'title' => 'Cột footer số 3',
                'content' => '       <li><a href="javascript:">Pricing</a></li>
                                    <li><a href="javascript:">Support</a></li>
                                    <li><a href="javascript:">Sales and Refunds</a></li>
                                    <li><a href="javascript:">Legal</a></li>
                                    <li><a href="javascript:">Testimonials & Faq’s</a></li>',
                'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'footer_4',
                'title' => 'Cột footer số 4',
                'content' => '         <li>
                                            <div><i class="bi bi-geo-alt"></i></div>
                                            <div>4789 Melmorn Street,Zakila Ton Mashintron Town</div>
                                        </li>
                                        <li>
                                            <div><i class="bi bi-phone"></i></div>
                                            <div><a href="tel:+1234567899">(+01) 123 456 7890</a></div>
                                        </li>
                                        <li>
                                            <div><i class="bi bi-envelope"></i></div>
                                            <div><a
                                                    href="https://mannatstudio.com/cdn-cgi/l/email-protection#4e262b223e0e3d2b3c2b20273a2b3a602d2123"><span
                                                        class="__cf_email__"
                                                        data-cfemail="d0b8b5bca090a3b5a2b5beb9a4b5a4feb3bfbd">[email&#160;protected]</span></a>
                                            </div>
                                        </li>',
                'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'footer_1_link_1',
                'title' => 'Link facebook',
                'content' => 'https://www.facebook.com/fpt.poly',
                'type' => 2,
                'created_at' => Carbon::now(),
            ]
            ,
            [
                'key' => 'footer_1_link_2',
                'title' => 'Link youtube',
                'content' => 'https://www.facebook.com/fpt.poly',
                'type' => 2,
                'created_at' => Carbon::now(),
            ]
            ,
            [
                'key' => 'footer_1_link_3',
                'title' => 'Link Instagram',
                'content' => 'https://www.facebook.com/fpt.poly',
                'type' => 2,
                'created_at' => Carbon::now(),
            ] ,
            [
                'key' => 'footer_1_title_1',
                'title' => 'Tiêu đề cột 1',
                'content' => 'About Us',
                'type' => 2,
                'created_at' => Carbon::now(),
            ] , [
                'key' => 'footer_1_title_2',
                'title' => 'Tiêu đề cột 2',
                'content' => 'Company',
                'type' => 2,
                'created_at' => Carbon::now(),
            ], [
                'key' => 'footer_1_title_3',
                'title' => 'Tiêu đề cột 3',
                'content' => 'Services',
                'type' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'key' => 'footer_1_title_4',
                'title' => 'Tiêu đề cột 4',
                'content' => 'Contact Us',
                'type' => 2,
                'created_at' => Carbon::now(),
            ]
        ]);


    }
}
