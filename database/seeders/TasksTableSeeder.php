<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'name' => 'Social Media Post Engagement',
                'description' => 'Like, comment, and share our latest social media post. Must provide screenshot proof of engagement.',
                'earning' => 50.00,
                'category_id' => 1,
            ],
            [
                'name' => 'YouTube Video Watch & Comment',
                'description' => 'Watch our full YouTube video (minimum 5 minutes) and leave a genuine comment. Include your YouTube username.',
                'earning' => 75.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Product Review Writing',
                'description' => 'Write a detailed product review (minimum 200 words) based on the provided guidelines. Must be original content.',
                'earning' => 100.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Website Testing & Feedback',
                'description' => 'Test our new website features and provide detailed feedback on user experience, bugs, and suggestions.',
                'earning' => 120.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Instagram Story Sharing',
                'description' => 'Share our promotional content to your Instagram story and keep it live for 24 hours. Minimum 500 followers required.',
                'earning' => 80.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Email Newsletter Signup',
                'description' => 'Subscribe to our newsletter and confirm your email address. Provide screenshot of confirmation.',
                'earning' => 30.00,
                'category_id' => 1,
            ],
            [
                'name' => 'App Beta Testing',
                'description' => 'Download and test our mobile app beta version. Submit a bug report or feature suggestion with screenshots.',
                'earning' => 150.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Facebook Group Join & Post',
                'description' => 'Join our Facebook community group and make an introductory post. Stay active for at least 1 week.',
                'earning' => 60.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Survey Completion',
                'description' => 'Complete our comprehensive market research survey (15-20 minutes). Honest and thoughtful responses required.',
                'earning' => 90.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Content Translation',
                'description' => 'Translate our blog article (500 words) from English to your native language. Must be accurate and natural.',
                'earning' => 180.00,
                'category_id' => 3,
            ],
            [
                'name' => 'Logo Design Contest',
                'description' => 'Submit an original logo design concept for our new product line. Include 3 color variations.',
                'earning' => 200.00,
                'category_id' => 3,
            ],
            [
                'name' => 'Twitter Retweet Campaign',
                'description' => 'Retweet our pinned tweet and add your own comment. Must have at least 200 followers.',
                'earning' => 45.00,
                'category_id' => 1,
            ],
            [
                'name' => 'LinkedIn Article Share',
                'description' => 'Share our LinkedIn article with your network and write a brief professional comment about it.',
                'earning' => 70.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Video Testimonial Recording',
                'description' => 'Record a 1-2 minute video testimonial about your experience with our service. Must be genuine and clear.',
                'earning' => 150.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Blog Article Writing',
                'description' => 'Write an original 1000-word blog article on the given topic. Must pass plagiarism check.',
                'earning' => 220.00,
                'category_id' => 3,
            ],
            [
                'name' => 'Pinterest Pin Creation',
                'description' => 'Create and pin 5 attractive pins featuring our products to your Pinterest board.',
                'earning' => 55.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Customer Support Chat Test',
                'description' => 'Engage with our customer support chatbot and rate the experience. Provide detailed feedback.',
                'earning' => 85.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Podcast Review & Rating',
                'description' => 'Listen to our latest podcast episode and leave a 5-star review on your preferred platform.',
                'earning' => 65.00,
                'category_id' => 1,
            ],
            [
                'name' => 'SEO Keyword Research',
                'description' => 'Research and provide 50 relevant SEO keywords for our niche with search volume data.',
                'earning' => 190.00,
                'category_id' => 3,
            ],
            [
                'name' => 'TikTok Video Creation',
                'description' => 'Create a creative TikTok video featuring our product. Must be at least 30 seconds and tag our account.',
                'earning' => 130.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Forum Discussion Participation',
                'description' => 'Join our community forum and participate in 3 different discussion threads with meaningful contributions.',
                'earning' => 75.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Email Marketing Campaign Test',
                'description' => 'Review our email marketing campaign and provide feedback on design, copy, and call-to-action effectiveness.',
                'earning' => 110.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Competitive Analysis Report',
                'description' => 'Research and create a detailed competitive analysis report comparing 5 competitors in our industry.',
                'earning' => 250.00,
                'category_id' => 4,
            ],
            [
                'name' => 'WhatsApp Group Invitation',
                'description' => 'Join our WhatsApp community group and invite 10 active members. Provide proof of invitations sent.',
                'earning' => 95.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Infographic Design',
                'description' => 'Design an informative infographic based on our data set. Must be high-quality and visually appealing.',
                'earning' => 200.00,
                'category_id' => 3,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
