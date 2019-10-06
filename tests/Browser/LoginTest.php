<?php

namespace Tests\Browser;

use App\User;
use Tests\Browser\Pages\Auth\LoginPage;
use Tests\Browser\Pages\HomePage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Тест наличия кнопки Login на главной странице
     *
     * @return void
     * @throws \Throwable
     */
    public function testIndexPageForLoginButton()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new HomePage)
                ->assertSee('Laravel')
                ->assertSee('ВХОД');
        });
    }

    /**
     * Тест страницы авторизации с неверными данными
     *
     * @throws \Throwable
     */
    public function testLoginPageWrong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage)
                ->screenshot('login/login-page-wrong-01-before')
                ->type('@email', 'wrong_user123@mail.mail')
                ->type('@password', 'qwqwqwqw')
                ->screenshot('login/login-page-wrong-02-after')
                ->click('@login')
                ->assertDontSee('Dashboard')
                ->screenshot('login/login-page-wrong-03-result')
                ->assertSee(trans('auth.failed'));
        });
    }

    /**
     * Тест страницы авторизации с правильными данными
     *
     * @throws \Throwable
     */
    public function testLoginPage()
    {
        // Creating new user
        // Default password is 'password'. See database/factories/UserFactory.php for information
        factory(User::class)->create([
            'email' => 'admin@platform.site',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage)
                ->screenshot('login/login-page-01-before')
                ->type('@email', 'admin@platform.site')
                ->type('@password', 'password')
                ->screenshot('login/login-page-02-after')
                ->click('@login')
                ->assertSee('Сводка')
                ->screenshot('login/login-page-03-result');
        });
    }
}
