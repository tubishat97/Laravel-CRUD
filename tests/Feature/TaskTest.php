<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use  RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_see_add_modal()
    {
        $response = $this->json('GET', '/add-task-form');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_user_can_see_edit_modal()

    {
        $task = factory('App\Task')->create();
        $response = $this->json('GET',route('edit-task-form',$task->id));
        $response->assertStatus(200);
    }
}
