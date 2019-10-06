<?php

namespace Tests\Browser;

use App\CmsApplication;
use App\User;
use Tests\Browser\Pages\CmsApplications\CmsApplicationCreatePage;
use Tests\Browser\Pages\CmsApplications\CmsApplicationsPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CmsAppFeatureTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user;

    /**
     * Проверка наличия надписи об отсутствии данных
     *
     * @throws \Throwable
     */
    public function testEmptyListOfCmsApps(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit(new CmsApplicationsPage)
                ->waitForText('Нет данных')
                ->screenshot('cms-apps/empty-01')
                ->assertSee('Нет данных')
                ->clickLink('Добавить')
                ->screenshot('cms-apps/empty-02');
        });
    }

    /**
     * Добавление нового CMS приложения
     *
     * @throws \Throwable
     */
    public function testCreateNewCmsApplication(): void
    {
//        $this->markTestSkipped('Local testing only');

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit(new CmsApplicationsPage)
                ->screenshot('cms-apps/true/create-01')
                ->clickLink('Добавить')
                ->on(new CmsApplicationCreatePage)
                ->type('@name', 'TestApp')
                ->type('@url', 'http://instance1.press-start-cms.test')
                ->type('@key', 'qwe47asd59q!w8')
                ->screenshot('cms-apps/true/create-02')
                ->click('@submit')
                ->on(new CmsApplicationsPage)
                ->screenshot('cms-apps/true/create-03')
                ->waitUntilVue('loading', false, '@cms-app-status')
                ->assertVue('statusType', 'active', '@cms-app-status')
                ->screenshot('cms-apps/true/create-04');
        });
    }

    /**
     * Добавление нового CMS приложения с непраивльным url
     *
     * @throws \Throwable
     */
    public function testCreateNewCmsApplicationWrongUrl(): void
    {
//        $this->markTestSkipped('Local testing only');
        $cmsApp = factory(CmsApplication::class)->create([
            'name' => 'Instance Test',
            'url' => 'http://instance1.press-start-cms.test',
            'user_id' => $this->user->id
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(new CmsApplicationsPage)
                ->screenshot('cms-apps/wrong-url/create-01')
                ->clickLink('Добавить')
                ->on(new CmsApplicationCreatePage)
                ->type('@name', 'TestApp')
                ->type('@url', 'http://instance1.press-start-cms.test')
                ->type('@key', 'qwe47asd59q!w8')
                ->screenshot('cms-apps/wrong-url/create-02')
                ->click('@submit')
                ->on(new CmsApplicationCreatePage)
                ->assertSee('CMS приложение с таким url уже существует')
                ->screenshot('cms-apps/wrong-url/create-03');
        });
    }

    /**
     * Добавление нового CMS приложения с непраивльным названием
     *
     * @throws \Throwable
     */
    public function testCreateNewCmsApplicationWrongName(): void
    {
//        $this->markTestSkipped('Local testing only');
        $cmsApp = factory(CmsApplication::class)->create([
            'name' => 'Instance Test',
            'url' => 'http://instance0.press-start-cms.test',
            'user_id' => $this->user->id
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(new CmsApplicationsPage)
                ->screenshot('cms-apps/wrong-name/create-01')
                ->clickLink('Добавить')
                ->on(new CmsApplicationCreatePage)
                ->type('@name', 'Instance Test')
                ->type('@url', 'http://instance1.press-start-cms.test')
                ->type('@key', 'qwe47asd59q!w8')
                ->screenshot('cms-apps/wrong-name/create-02')
                ->click('@submit')
                ->on(new CmsApplicationCreatePage)
                ->assertSee('CMS приложение с таким названием уже существует')
                ->screenshot('cms-apps/wrong-name/create-03');
        });
    }

    /**
     * Добавление нового CMS приложения с непраивльным ключом приложения
     *
     * @throws \Throwable
     */
    public function testCreateNewCmsApplicationWrongKey(): void
    {
//        $this->markTestSkipped('Local testing only');

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(new CmsApplicationsPage)
                ->screenshot('cms-apps/wrong-key/create-01')
                ->clickLink('Добавить')
                ->on(new CmsApplicationCreatePage)
                ->type('@name', 'TestApp')
                ->type('@url', 'http://instance1.press-start-cms.test')
                ->type('@key', '00000000')
                ->screenshot('cms-apps/wrong-key/create-02')
                ->click('@submit')
                ->on(new CmsApplicationCreatePage)
                ->assertSee('Неверный ключ CMS')
                ->screenshot('cms-apps/wrong-key/create-03');
        });
    }

    /**
     * Добавление нового CMS приложения с езаполненными полями
     *
     * @throws \Throwable
     */
    public function testCreateNewCmsApplicationEmptyValues(): void
    {
//        $this->markTestSkipped('Local testing only');

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(new CmsApplicationsPage)
                ->screenshot('cms-apps/empty-values/create-01')
                ->clickLink('Добавить')
                ->on(new CmsApplicationCreatePage)
                ->type('@name', '')
                ->type('@url', '')
                ->type('@key', '')
                ->screenshot('cms-apps/empty-values/create-02')
                ->click('@submit')
                ->on(new CmsApplicationCreatePage)
                ->assertSee('Необходимо заполнить поле "Название"')
                ->assertSee('Необходимо заполнить поле "URL приложения"')
                ->assertSee('Необходимо заполнить поле "Ключ приложения"')
                ->screenshot('cms-apps/empty-values/create-03');
        });
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Creating new user
        // Default password is 'password'. See database/factories/UserFactory.php for information
        $this->user = factory(User::class)->create([
            'email' => 'admin@platform.site',
        ]);
    }
}
