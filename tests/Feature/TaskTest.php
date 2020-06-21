<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use  RefreshDatabase;


    /** @test */
    function guests_may_not_create_task()
    {

        $this->get('/')
            ->assertRedirect('/login');

        $this->post('/store')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function a_user_can_see_add_modal()
    {

        $this->signIn();

        $response = $this->json('GET', '/add-task-form');
        $response->assertStatus(200);
    }


    /** @test */
    public function a_task_requires_a_name(){

        $this->signIn();

        $task = factory('App\Task')->make(['name' => null]);

        $this->post('/store',$task->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_task_requires_a_description(){

        $this->signIn();

        $task = factory('App\Task')->make(['description' => null]);

        $this->post('/store',$task->toArray())
            ->assertSessionHasErrors('description');
    }

    /** @test */
    function an_authenticated_user_may_create_new_task()
    {

        $this->signIn();

        $task = factory('App\Task')->create();

        $this->post('/store');

        $this->get('/')
            ->assertSee($task->name);
    }

    /**
     * @test
     */
    public function a_user_can_see_edit_modal()

    {

        $this->signIn();

        $task = factory('App\Task')->create();
        $response = $this->json('GET', route('edit-task-form', $task->id));
        $response->assertStatus(200);
    }

    /** @test */
    function an_authenticated_user_may_edit_new_task()
    {

        $this->signIn();

        $task = factory('App\Task')->create();

        $this->post('/edit/'.$task->id);

        $this->get('/')
            ->assertSee($task->name);
    }

    /**
     * @test
     */
    public function a_user_can_see_delete_modal()

    {

        $this->signIn();

        $task = factory('App\Task')->create();
        $response = $this->json('GET', route('delete-modal', $task->id));
        $response->assertStatus(200);
    }


    protected function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->create();

        $this->actingAs($user);

        return $this;
    }


}
