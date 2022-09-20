<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\User;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class UserTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_getRouteKeyNames(){
        foreach (User::all() as $user){
            $userRoute = $user->getRouteKeyName();
            $this->assertEquals('username', $userRoute);
        }
    }

    public function test_article(){
//        $user = User::all()->firstWhere('', '');
//        $article = $user->articles;
        /*
        foreach (User::all() as $user){
            $id = $user->getAttribute('id');
            if($user->articles() != null){
                foreach($user->articles() as $article){
                    $task = Article::factory(['user_id' => $id])
                        ->create();
                    $this->assertInstanceOf(Article::class , $article);
                }
            }else{
                $this->assertTrue(true);
            }
        }*/
        /*$user = User::factory()
            ->hasTasks(3)
            ->create();*/
        foreach (User::all() as $user){
            echo $user;
            $article = $user->articles();
//            $this->assertInstanceOf(HasMany::class, $user->article());
            $this->assertInstanceOf(HasMany::class, $article);
        }
        /*$allTasks = Article::all();
        $this->assertEquals($user->articles(), $allTasks);

        $this->assertInstanceOf(Task::class, $user->tasks->first());
        $this->assertInstanceOf(Task::class, $user->tasks()->first());
        $this->assertInstanceOf(Collection::class, $user->tasks);
        $this->assertInstanceOf(HasMany::class, $user->article());*/
    }

    public function test_favouriteArticles(){

    }

    public function test_followers(){

    }

    public function test_following(){

    }

    public function test_doesUserFollowAnotherUser(){

    }
}

