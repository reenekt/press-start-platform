<?php

namespace Tests\Unit;

use App\CmsApplication;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CmsAppCrudTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * Получение списка CMS приложений, подключенных к платформе
     *
     * @return void
     */
    public function testCmsAppList()
    {
        $response = $this->actingAs($this->user)->get('/cms-applications');
        $response->assertSee('Нет данных');

        $cmsApp = factory(CmsApplication::class)->create();

        $response = $this->actingAs($this->user)->get('/cms-applications');
        $response->assertDontSee('Нет данных')
            ->assertSee($cmsApp->name)
            ->assertSee($cmsApp->url);
    }

    /**
     * Добавление нового приложения
     *
     * @return void
     */
    public function testCmsAppStore()
    {
        $this->markTestSkipped('Local test');
        $response = $this->actingAs($this->user)->post('/cms-applications', [
            'name' => 'Instance Test',
            'url' => 'http://instance1.press-start-cms.test',
            'app_key' => 'qwe47asd59q!w8',
        ]);

        $response->assertRedirect(route('cms-applications.index'));

        $cmsApp = CmsApplication::where(['name' => 'Instance Test'])->get();

        $this->assertNotEmpty($cmsApp);
    }

    /**
     * Редактирование приложения
     *
     * @return void
     */
    public function testCmsAppEdit()
    {
        $cmsApp = factory(CmsApplication::class)->create([
            'name' => 'Instance Test2',
            'url' => 'http://instance1.press-start-cms.test',
            'app_key' => 'qwe47asd59q!w8',
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->put("/cms-applications/{$cmsApp->id}", [
            'name' => 'Instance Test2 Updated',
            'url' => $cmsApp->url,
            'app_key' => 'qwe47asd59q!w8',
        ]);
        $response->assertRedirect(route('cms-applications.index'));

        $cmsApp = CmsApplication::find($cmsApp->id);

        $this->assertNotEmpty($cmsApp, 'В базе данных нет такой записи');
        $this->assertEquals('Instance Test2 Updated', $cmsApp->name, 'Название не изменилось');
    }

    /**
     * Редактирование приложения с неправильными данными
     *
     * @return void
     */
    public function testCmsAppEditWithWrongData()
    {
        $cmsApp = factory(CmsApplication::class)->create([
            'name' => 'Instance Test3',
            'url' => 'http://instance1.press-start-cms.test',
            'app_key' => 'qwe47asd59q!w8',
            'user_id' => $this->user->id,
        ]);

        $wrong_app_key = '00000000000000';

        $response = $this->actingAs($this->user)->followingRedirects()->put("/cms-applications/{$cmsApp->id}", [
            'name' => 'Instance Test3',
            'url' => $cmsApp->url,
            'app_key' => $wrong_app_key,
        ], [
            'Referer' => route('cms-applications.edit', ['cms_application' => $cmsApp])
        ]);
        $response->assertSee('Неверный ключ CMS');

        $cmsApp = CmsApplication::find($cmsApp->id);

        $this->assertNotEmpty($cmsApp, 'В базе данных нет такой записи');
        $this->assertNotEquals($wrong_app_key, $cmsApp->app_key, 'Неправильный ключ приложения сохранен. Проверка ключа работает неправильно');
    }

    /**
     * Удаление записи
     *
     * @return void
     */
    public function testCmsAppDelete()
    {
        $cmsApp = factory(CmsApplication::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->get('/cms-applications');
        $response->assertDontSee('Нет данных');

        $response = $this->actingAs($this->user)->delete("/cms-applications/{$cmsApp->id}");
        $response->assertRedirect(route('cms-applications.index'));

        $response = $this->actingAs($this->user)->get('/cms-applications');
        $response->assertSee('Нет данных');
    }
}
