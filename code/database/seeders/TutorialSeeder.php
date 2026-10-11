<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tutorial;
use App\Models\Category;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ///////////////////////////Art///////////////////////////
        Tutorial::create([
            'title'       => 'Foundations for Solid Drawing [Character Drawing Basics Pt 1]',
            'description' => 'Learn about shapes and forms to build up your characters!',
            'video_url'   => 'https://youtu.be/aMlTKtmczzM?si=URYubZOgjv8x2KFa',
            'difficulty'  => 'beginner',
            'category_id' => Category::where('name', 'Art')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'How to Draw Faces & Heads for Beginners - BNG Studio',
            'description' => 'Draw Face & Head: Easy Ways to Improve Your Digital Drawing Skills! ',
            'video_url'   => 'https://youtu.be/T9pXoQNqBB4?si=oX99vo4TedO9gfbS',
            'difficulty'  => 'intermediate',
            'category_id' => Category::where('name', 'Art')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'Draw with me🌞🍎T r a v e l e r // Photoshop speedpaint',
            'description' => '【Instagram】   / yeej.chan. What I used: Kamvas Pro 24 Tourbox Neo',
            'video_url'   => 'https://youtu.be/SjbV0JYRIQg?si=Z5Gc9bG_4AGMdSKd',
            'difficulty'  => 'difficult',
            'category_id' => Category::where('name', 'Art')->first()->id,
        ]);

        ///////////////////////////Baking///////////////////////////
        Tutorial::create([
            'title'       => 'Fluffy Chocolate Chip Smore Cookies',
            'description' => 'These are the thickest gooiest cookies you will ever have! You can find the recipe in cups and in grams ;).',
            'video_url'   => 'https://youtu.be/XDfFH-nUrUM?si=V3G6bRuG5j0wMQw0',
            'difficulty'  => 'beginner',
            'category_id' => Category::where('name', 'Baking')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'Easy Lemon Blueberry Cake Recipe',
            'description' => 'My lemon blueberry cake is bursting with beautiful natural flavors and so refreshing! This moist, easy to make cake is filled with delicious blueberry and lemon buttercream. It is one of my most popular cakes and a personal favorite so I hope you get a chance to bake one up!
It is soft, melt-in-your-mouth and full of zingy flavors. .',
            'video_url'   => 'https://youtu.be/HNjVhieip7Q?si=xVvo6y1nKNXX96Se',
            'difficulty'  => 'intermediate',
            'category_id' => Category::where('name', 'Baking')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'Raspberry Pistachio Cake',
            'description' => 'This raspberry pistachio cake is made with soft pistachio cake layers sandwiching homemade raspberry jam and all covered with raspberry buttercream.
            It  is a delicious flavour combination with all-natural colouring!',
            'video_url'   => 'https://youtu.be/ca91nxIRRyU?si=VxA08knKt6ZCFbWt',
            'difficulty'  => 'difficult',
            'category_id' => Category::where('name', 'Baking')->first()->id,
        ]);
        ///////////////////////////Coding///////////////////////////
        Tutorial::create([
            'title'       => 'Learn To Code Like a GENIUS and Not Waste Time',
            'description' => 'Learning to code is pretty overwhelming so this video should break down the essential steps and resources you need to start coding as a beginner. No prior experience required. I wont lie this probably is not everything, but it is enough to get you started with coding.
            This is not to get you a job, it is just a quick guide so you can start making your fun projects.',
            'video_url'   => 'https://www.youtube.com/watch?v=q-_ezD9Swz4',
            'difficulty'  => 'beginner',
            'category_id' => Category::where('name', 'Coding')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'HTML & CSS Full Course for free',
            'description' => 'Learning to code is pretty overwhelming so this video should break down the essential steps and resources you need to start coding as a beginner. No prior experience required. I wont lie this probably is not everything, but it is enough to get you started with coding.
            This is not to get you a job, it is just a quick guide so you can start making your fun projects.',
            'video_url'   => 'https://youtu.be/HGTJBPNC-Gw?si=DKE9u3mt6VcpspYU',
            'difficulty'  => 'beginner',
            'category_id' => Category::where('name', 'Coding')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'React Full Course (FREE)',
            'description' => 'This is a beginners React JS course that should be enough to get you started using the React Library.
            There are still many more hooks and concepts that are beyond the scope of the beginner level. This video should at least give you a solid foundation.',
            'video_url'   => 'https://youtu.be/CgkZ7MvWUAA?si=KsEhIRAZKQqiUXIT',
            'difficulty'  => 'difficult',
            'category_id' => Category::where('name', 'Coding')->first()->id,
        ]);
        ///////////////////////////Writing///////////////////////////
        Tutorial::create([
            'title'       => 'I’m begging you to write essays',
            'description' => 'Supercharge your productivity with Akiflow! https://akiflow.pro/Odysseas',
            'video_url'   => 'https://youtu.be/DO5MflX_eik?si=fYkwKhlVfwUNk91s',
            'difficulty'  => 'beginner',
            'category_id' => Category::where('name', 'Writing')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'HARSH WRITING ADVICE! (mostly for newer writers)',
            'description' => 'DISCLAIMER: this is just a bit of fun! While the core advice is 100% true, Im dressing it up with a bit of exaggerated affect. I am nice and I believe in you!
            And do note, as I say in the video: SELF CARE IS IMPORTANT! Harsh writing advice is not helpful if you are in a really rough spot and need to take care of yourself. There is a thin line between excuses and genuinely being in a bad place for writing.
            Take breaks if you need them and do not be too hard on yourself.(Also first books dont always suck, but they usually need a LOT of work.)',
            'video_url'   => 'hhttps://youtu.be/rYqZjCsAJeg?si=Q1Xwo3-P96dtoOUT',
            'difficulty'  => 'intermediate',
            'category_id' => Category::where('name', 'Writing')->first()->id,
        ]);
        ///////////////////////////3D///////////////////////////
        Tutorial::create([
            'title'       => 'ABSOLUTE Beginner Basics.. Blender For Noobs 2025',
            'description' => '🏍️IamGolden (Vlog Channel!):    / @iamgoldenyt  ',
            'video_url'   => 'https://youtu.be/peSv5IT5Ve4?si=pZ3Gpycr6cFFyiNZ',
            'difficulty'  => 'beginner',
            'category_id' => Category::where('name', '3D')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'Beginner Blender Tutorial (2026)',
            'description' => 'The complete Beginner Donut Tutorial, uploaded in one video :)',
            'video_url'   => 'https://youtu.be/z-Xl9tGqH14?si=TJVld5nJ0_8KsCy7',
            'difficulty'  => 'intermediate',
            'category_id' => Category::where('name', '3D')->first()->id,
        ]);
        Tutorial::create([
            'title'       => 'Model a Lowpoly Toon Head in 10 Minutes-Tips From An ex- bungie AAA dev',
            'description' => 'This is a brand new series I am creating that focuses on the modeling, texturing, and rendering of my newest model, Princess Peach. I created her in my style and developed my own special toon shader set up, and I wanted to share those tips with you!
            This video features the base head modeling, sped up. I try to explain some of my thoughts as I model. This head is animation ready! I hope it helps, let me know your thoughts or suggestions in the comments!
            Next video is all about texture painting, a super hot topic I have been asked about many times. Stay tuned! ',
            'video_url'   => 'https://youtu.be/1Npof3WuxYM?si=3EmOOexIiP2cVSIG',
            'difficulty'  => 'difficult',
            'category_id' => Category::where('name', '3D')->first()->id,
        ]);

    }
}
