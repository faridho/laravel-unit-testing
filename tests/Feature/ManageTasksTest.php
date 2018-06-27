<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;

class ManageTasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_create_task(){
        //this is default --> $this->assertTrue(true);

        //user buka halaman daftar task
        $this->visit('/tasks');

        //isi form name dan description kemudian submit
        $this->submitForm('Create Task', [
            'name'          => 'My First Task',
            'description'   => 'This is my first task on my job'
        ]);

        //lihat record tersimpan ke database
        $this->seeInDatabase('tasks', [
            'name'          => 'My First Task',
            'description'   => 'This is my first task on my job',
            'is_done'       => 0
        ]);

        //redirect ke halaman daftar task
        $this->seePageIs('/tasks');

        //tampil hasil task yang telah diinput
        $this->see('My First Task');
        $this->see('This is my first task on my job');
    }

    /** @test */
    public function user_can_browser_tasks_index_page(){
        //Generate 3 record task pad ataable 'tasks'
        $tasks = factory(Task::class, 3)->create();

        //User membua halaman daftar tasks
        $this->visit('/tasks');
        
        //User melihat ketiga task tampil pada halaman
        $this->see($tasks[0]->name);
        $this->see($tasks[1]->name);
        $this->see($tasks[2]->name);

        //user melihat link untuk edit task pada masing-masing item task
        $this->seeElement('a', [
            'id'    => 'edit_task_'.$tasks[0]->id,
            'href'  => url('tasks?action=edit&id='.$tasks[0]->id)
        ]);

        $this->seeElement('a', [
            'id'    => 'edit_task_'.$tasks[1]->id,
            'href'  => url('tasks?action=edit&id='.$tasks[1]->id)
        ]);

        $this->seeElement('a', [
            'id'    => 'edit_task_'.$tasks[2]->id,
            'href'  => url('tasks?action=edit&id='.$tasks[2]->id)
        ]);
    }

    /** @test */
    public function user_can_edit_an_existing_task(){
        $this->assertTrue(true);
    }

    /** @test */
    public function user_can_delete_an_existing_task(){
        $this->assertTrue(true);
    }

    /** @test */
    public function task_entry_must_pass_validation(){
        //submit form untuk membuat task baru  dengan field name dan description kosong
        $this->post('/tasks', [
            'name'          => '',
            'description'   => '', 
        ]);

        //cek pada session apakah ada error untuk field nama dan description
        $this->assertSessionHasErrors(['name', 'description']);
    }
}
