<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppWorkingTest extends TestCase
{
    /**
     * Тест доступности главной страницы сайта
     *
     * @return void
     */
    public function testAppIsWorking()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
