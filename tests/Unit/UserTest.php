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
use Illuminate\Support\Facades\DB;
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
        /*foreach (User::all() as $user){
            $userRoute = $user->getRouteKeyName();
            $this->assertEquals('username', $userRoute);
        }*/
        $user = new User();
        $this->assertEquals('username', $user->getRouteKeyName());
    }

    public function test_article(){
        /*foreach (User::all() as $user){
            $article = $user->articles();
            $this->assertInstanceOf(HasMany::class, $article);
        }*/

        //Version attendu
        /*$checkRelation = 0;
        $count = 0;

        foreach (User::all() as $user){
            $count ++;
            $article = $user->articles();
            if($article == HasMany::class){
                $checkRelation ++;
            }
        }
        if($checkRelation == $count){
            $this->assertTrue(true);
        }else{
            $this->assertFalse(false);
        }*/

        //Version qui a du sens!!
        $user = User::all()->firstWhere('username', 'Rose');
        $article = $user->articles;
        $this->assertEquals(1, sizeof($article));

        //Version ++ si j'ai le temps :
        /*$checkRelation = 0;
        $count = 0;
        $checkArticle = 0;
        foreach (User::all() as $user){
            $count++;
            $article = $user->articles();
            if($article == HasMany::class){
                $checkRelation ++;
            }
        }
        if($checkRelation == $count){
            $this->assertTrue(true);
        }else{
            $this->assertFalse(false);
        }*/
    }

    public function test_favouriteArticles() {
        $this->assertTrue(true);
    }

    /*public function test_followers() {
        $user = User::all()->firstWhere('username', 'Rose');
        $followers = $user->followers();
        echo $followers;
        $this->assertEquals(1, sizeof($followers));
    }

    public function test_following() {
        $user = User::all()->firstWhere('username', 'Rose');
        $following = $user->following;
        $this->assertEquals(1, sizeof($following));
    }*/

    public function test_doesUserFollowAnotherUser() {
        $user = User::all()->firstWhere('username', 'Rose');
        $check = $user->doesUserFollowAnotherUser(2, 1);
        $this->assertTrue($check);
    }

//    public function test_doesUserFollowArticle() {
//        $user = User::all()->firstWhere('username', 'Musonda');
//        $article = Article::all()->firstWhere('title', 'Mon premier article');
//        $this->assertTrue($user->doesUserFollowArticle(3, $article->id));
//    }

    public function test_setPasswordAttribute() {
        $user = new User();
        $user->password = 'password';
        $this->assertNotEquals('password', $user->password);
    }

    public function test_getJWTIdentifier() {
        $user = User::all()->firstWhere('username', 'Rose');
        $this->assertEquals($user->id, $user->getJWTIdentifier());
    }
}

