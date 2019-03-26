<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTasksTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   public function a_project_can_have_tasks()
   {
        $project = ProjectFactory::create();

        $this->ActingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())
            ->assertSee('Test Task');
   }

   /** @test */
   function a_task_can_be_updated()
   {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
   }

   /** @test */
   public function only_the_owner_of_a_project_may_add_tasks()
   {
        $this->signIn();

        $project = factory('App\Project')->create();
        
        $this->post($project->path() . '/tasks', ['body' => 'Test Task'])
            ->assertStatus(403);
        
        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
   }

   /** @test */
   public function only_the_owner_of_a_project_may_update_a_task()
   {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
            ->assertStatus(403);
        
        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
   }

   /** @test */
   public function a_task_requires_a_body()
   {
        $project = ProjectFactory::create();


        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->ActingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
   }
}
