<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUsers = \App\Models\User::where('role', 'admin')->get();

        $posts = [
            [
                'title' => 'Unlocking the Secrets of Effective Time Management',
                'content' => 'Time management is an essential skill that can improve productivity and reduce stress. By mastering the art of planning and prioritizing tasks, individuals can manage their time efficiently and achieve personal and professional goals. In this article, we’ll explore practical techniques to help you stay on track and boost your productivity.

                1. Set Clear Goals
                Start by defining your short-term and long-term goals. Clear objectives give you a sense of direction and help you focus on what truly matters. Use the SMART criteria to ensure your goals are Specific, Measurable, Achievable, Relevant, and Time-bound.
                
                2. Prioritize Your Tasks
                Not all tasks are equally important. Use the Eisenhower Matrix to categorize tasks based on urgency and importance. Focus on high-priority tasks first and delegate or eliminate low-priority activities that do not contribute significantly to your goals.
                
                3. Plan Your Day
                Create a daily schedule or to-do list. Block out time for specific tasks and allocate extra time for unexpected interruptions. Tools like Google Calendar or task management apps such as Trello or Todoist can help you stay organized.
                
                4. Break Tasks into Smaller Steps
                Large tasks can be overwhelming, leading to procrastination. Break them down into manageable chunks and tackle them one at a time. This approach reduces stress and creates a sense of accomplishment as you complete each step.
                
                5. Eliminate Distractions
                Identify and minimize distractions in your environment. This could mean silencing notifications, working in a quiet space, or using apps like Focus@Will or Freedom to block distracting websites and apps.
                
                6. Learn to Say No
                Overcommitting can lead to burnout and reduced productivity. Respectfully decline tasks or requests that do not align with your priorities. Remember, saying no to unnecessary obligations is saying yes to your goals.
                
                7. Utilize Time Management Techniques
                Experiment with time management methods to find what works best for you:
                
                Pomodoro Technique: Work for 25 minutes, then take a 5-minute break.
                Time Blocking: Allocate specific blocks of time for different activities.
                80/20 Rule (Pareto Principle): Focus on the 20% of tasks that yield 80% of the results.
                8. Take Regular Breaks
                Continuous work without breaks can lead to mental fatigue. Incorporate short breaks into your schedule to recharge your energy and improve focus. Techniques like the Pomodoro Method can help ensure you take regular intervals.
                
                9. Review and Reflect
                At the end of each day, review what you accomplished and identify areas for improvement. Regular reflection helps you adjust your strategies and make better use of your time in the future.
                
                10. Practice Self-Care
                Time management is not just about productivity; it’s about balance. Ensure you make time for exercise, proper nutrition, sleep, and leisure activities. A healthy mind and body are essential for sustained productivity.
                
                Conclusion
                Effective time management is a journey, not a destination. It requires practice, discipline, and occasional adjustments. By implementing these techniques, you can take control of your schedule, reduce stress, and achieve your goals with greater efficiency. Start small, be consistent, and watch your productivity soar.',
                'slug' => 'unlocking-the-secrets-of-effective-time-management',
            ],
            [
                'title' => 'The Future of AI: How It\'s Shaping Tomorrow’s World',
                'content' => 'Artificial Intelligence (AI) has come a long way in recent years, and its future looks even more promising. AI is set to transform industries from healthcare to transportation, creating smarter systems and improving quality of life. But what challenges lie ahead as we continue to push the boundaries of AI development?',
                'slug' => 'the-future-of-ai-how-its-shaping-tomorrows-world',
            ],
            [
                'title' => '10 Hidden Travel Gems You Need to Visit Before You Die',
                'content' => 'While popular destinations like Paris and New York City are always worth visiting, some of the world’s most beautiful locations remain off the beaten path. This article uncovers ten lesser-known travel destinations that offer unique experiences and breathtaking views for the adventurous traveler.',
                'slug' => '10-hidden-travel-gems-you-need-to-visit-before-you-die',
            ],
            [
                'title' => 'The Psychology of Decision Making: What Drives Our Choices?',
                'content' => 'Every day, we make decisions, from what to eat for breakfast to major life choices. But what influences these decisions? Understanding the psychology behind decision-making can help individuals make better choices, both in personal and professional contexts. This article delves into the factors that shape our decisions.',
                'slug' => 'the-psychology-of-decision-making-what-drives-our-choices',
            ],
            [
                'title' => 'How to Build a Sustainable Home on a Budget',
                'content' => 'Building a sustainable home doesn’t have to be expensive. By incorporating eco-friendly materials and energy-efficient designs, anyone can create a home that’s both budget-friendly and environmentally responsible. This guide will walk you through the steps to build your dream sustainable home without breaking the bank.',
                'slug' => 'how-to-build-a-sustainable-home-on-a-budget',
            ],
            [
                'title' => 'Exploring the Science of Happiness: What Makes Us Truly Happy?',
                'content' => 'What makes us happy? Is it wealth, success, relationships, or something else entirely? Research in positive psychology has uncovered many interesting insights into the science of happiness. This article explores these findings and offers practical tips for living a happier and more fulfilling life.',
                'slug' => 'exploring-the-science-of-happiness-what-makes-us-truly-happy',
            ],
            [
                'title' => 'The Rise of Electric Vehicles: Trends and Predictions for 2025',
                'content' => 'Electric vehicles (EVs) are changing the automotive landscape. With advancements in technology and a growing emphasis on sustainability, EVs are expected to dominate the market in the coming years. This article looks at the latest trends and offers predictions for the future of electric vehicles by 2025.',
                'slug' => 'the-rise-of-electric-vehicles-trends-and-predictions-for-2025',
            ],
            [
                'title' => 'Mastering Social Media Marketing: Tips for 2024',
                'content' => 'In 2024, social media marketing is more important than ever. To stand out in a crowded digital space, businesses need to craft effective strategies that engage audiences and drive results. This article shares the latest tips and tricks for mastering social media marketing in the new year.',
                'slug' => 'mastering-social-media-marketing-tips-for-2024',
            ]
        ];
    
        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'content' => $post['content'],
                'slug' => $post['slug'],
                'author' => $adminUsers->random()->id,
            ]);
        }

    }
}
