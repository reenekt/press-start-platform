<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест обновления данных пользователя через форму
     *
     * @return void
     */
    public function testUpdateProfileByForm()
    {
        $user = factory(User::class)->create([
            'name' => 'TestUser',
            'email' => 'test@platform.site',
            'vendor_name' => 'testVendor',
        ]);
        $response = $this->actingAs($user)->post('/profile', [
            'name' => 'TestUserUpdated',
            'email' => 'test_upd@platform.site',
            'vendor_name' => 'testVendorUpdated',
        ]);

        $response->assertRedirect(route('profile'));

        $user = User::find($user->id);

        // Проверка соответствия значений новым
        $this->assertEquals('TestUserUpdated' , $user->name);
        $this->assertEquals('test_upd@platform.site' , $user->email);
        $this->assertEquals('testVendorUpdated' , $user->vendor_name);

        // Проверка: старые значения были изменены
        $this->assertNotEquals('TestUser' , $user->name);
        $this->assertNotEquals('test@platform.site' , $user->email);
        $this->assertNotEquals('testVendor' , $user->vendor_name);
    }

    /**
     * Тест обновления данных пользователя через AJAX запрос (ожидающий JSON ответ)
     *
     * @return void
     */
    public function testUpdateProfileByJson()
    {
        $user = factory(User::class)->create([
            'name' => 'TestUser',
            'email' => 'test@platform.site',
            'vendor_name' => 'testVendor',
        ]);

        $response = $this->actingAs($user)->postJson('/profile', [
            'name' => 'TestUserUpdated',
            'email' => 'test_upd@platform.site',
            'vendor_name' => 'testVendorUpdated',
        ]);

        $user = User::find($user->id);

        // Проверка соответствия значений новым
        $this->assertEquals('TestUserUpdated' , $user->name);
        $this->assertEquals('test_upd@platform.site' , $user->email);
        $this->assertEquals('testVendorUpdated' , $user->vendor_name);

        // Проверка: старые значения были изменены
        $this->assertNotEquals('TestUser' , $user->name);
        $this->assertNotEquals('test@platform.site' , $user->email);
        $this->assertNotEquals('testVendor' , $user->vendor_name);

        // Проверка полученного ответа
        $response->assertJson([
            'result' => true,
            'user' => $user->toArray()
        ]);
    }
}
