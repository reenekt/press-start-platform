<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PluginUploadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тестирование загрузки плагина для CMS в систему
     *
     * @return void
     */
    public function testPluginUpload()
    {
        Storage::fake();

        $file = UploadedFile::createFromBase(new UploadedFile(dirname(__DIR__) . '/data/feature/ExampleOne.zip', 'ExampleOne.zip'));

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson('/cms-plugins', [
            'file' => $file
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'scheme' => [
                    'scheme' => [
                        'version' => '0.1.0',
                        'components' => [
                            'ExampleSidebarWidget.php'
                        ],
                    ]
                ],
                'valid' => true,
                'vendor' => 'testVendor',
                'package' => 'ExampleOne',
                'version' => '0.1.0',
                'components' => [
                    'ExampleSidebarWidget.php'
                ],
                'saved' => true,
            ]);
    }
}
