<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    // Get all regular users (users with role 'user')
    $regularUsers = User::where('role', 'user')->get();

    // Get all posts
    $posts = Post::all();

    $comments = [
        'Unlocking the Secrets of Effective Time Management' => [
            'This is exactly what I needed to read! Time management is something I’ve struggled with for years.',
            'Great tips! I will definitely try the Pomodoro technique.',
            'I love the idea of time blocking! Can’t wait to implement this.'
        ],
        'The Future of AI: How It\'s Shaping Tomorrow’s World' => [
            'AI is going to change everything. I’m excited but also a little scared of the possibilities.',
            'Interesting perspective on AI. I think it’s a little overhyped though.',
            'This was an eye-opener! I never thought AI would have such an impact on healthcare.'
        ],
        '10 Hidden Travel Gems You Need to Visit Before You Die' => [
            'I’ve been to one of these places! It was amazing. You should really visit this list!',
            'Definitely adding these to my bucket list.',
            'Some of these gems look incredible. I’ve never heard of them before!'
        ],
        'The Psychology of Decision Making: What Drives Our Choices?' => [
            'This article is spot on! I make so many impulsive decisions.',
            'I always thought my choices were logical, but after reading this, I can see they’re more emotional.',
            'It’s interesting how much unconscious bias affects our decision-making.'
        ],
        'How to Build a Sustainable Home on a Budget' => [
            'Love this! I’ve been looking into affordable sustainable homes for years.',
            'Do you have tips on where to source eco-friendly materials on a budget?',
            'This article makes building green homes feel achievable for someone on a budget.'
        ],
        'Exploring the Science of Happiness: What Makes Us Truly Happy?' => [
            'Happiness is definitely more about experiences than material possessions.',
            'I’ve been learning about the science of happiness lately, and this article ties it all together nicely.',
            'Such an insightful read! I think about happiness in a completely different way now.'
        ],
        'The Rise of Electric Vehicles: Trends and Predictions for 2025' => [
            'Electric vehicles are the future! But we need more charging stations.',
            'I’m so ready for the electric car revolution, but I wonder about battery life over time.',
            'This article is very informative. I think the future of EVs looks promising!'
        ],
        'Mastering Social Media Marketing: Tips for 2024' => [
            'These tips are so helpful! I can definitely use this for my business.',
            'I love how this article breaks down the strategies. Great content!',
            'The trend of video marketing really is dominating right now, isn’t it?'
        ],
    ];

    foreach ($posts as $post) {
        if (isset($comments[$post->title])) {
            $postComments = $comments[$post->title];

            foreach ($postComments as $commentContent) {
                $user = $regularUsers->random();

                Comment::create([
                    'content' => $commentContent,
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
    }
}
